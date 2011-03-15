<?php
App::import('Model', 'Child');
App::import('Model', 'Theme');
App::import('Model', 'Present');
App::import('Model', 'Month');
class Diary extends AppModel {
	var $name = 'Diary';
	var $validate = array(
		'child_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'theme_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'hash' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'has_image' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Child' => array(
			'className' => 'Child',
			'foreignKey' => 'child_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Month' => array(
			'className' => 'Month',
			'foreignKey' => '',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Theme' => array(
			'className' => 'Theme',
			'foreignKey' => 'theme_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Present' => array(
			'className' => 'Present',
			'foreignKey' => 'present_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	//メールから登録
	function importMail($data) {

		if (empty($data)) {
			return false;
		}
		
		//メール有効判定
		if (empty($data['to'])) {
			return false;
		}
		
		//メールプレフィックス除去
		$to = $data['to'];
		if (!ereg("^".Configure::read('Defaults.receive_mail_prefix'), $to)) {
			return false;
		}
		$to = ereg_replace("^".Configure::read('Defaults.receive_mail_prefix'), "", $to);
		
		//@以降除去
		$to = ereg_replace("@.*", "", $to);
		
		//宛先アドレス有効判定
		$to_splits = split('\.', $to);
		if (count($to_splits) != 4) {//user_id, child_id, theme_id, hash
			return false;
		}
		
		//add
		$request = array(
			'user_id' => $to_splits[0],
			'child_id' => $to_splits[1],
			'theme_id' => $to_splits[2],
			'hash' => $to_splits[3],
		);
		if (!empty($data['subject'])) {
			$request['title'] = $data['subject'];
		}
		if (!empty($data['body'])) {
			$request['body'] = $data['body'];
		}
		if (!empty($data['image'])) {
			$request['image'] = $data['image'];
		}
		
		return $this->add($request);
	}
	
	//思い出登録
	function add($data) {
		
		if (empty($data)) {
			return false;
		}
		
		//user_id & child_id
		$child = ClassRegistry::init('Child');
		$child->contain('User');
		$child_data = $child->find('first', array('conditions' => array('User.id' => $data['user_id'], 'Child.id' => $data['child_id'])));
		if (empty($child_data)) {
			return false;
		}
		
		//theme_id
		$theme = ClassRegistry::init('Theme')->find('first', array('conditions' => array('Theme.id' => $data['theme_id'])));
		if (empty($theme)) {
			return false;
		}
		
		//month_id
		$data['month_id'] = $theme['Theme']['month_id'];
		
		//hash
		if (strlen($data['hash']) != Configure::read('Diary.hash_length')) {
			return false;
		}
		
		//has_image
		$data['has_image'] = !empty($data['image']);
		
		//present_id:テーマの月に紐づくプレゼントを取得しなければいけない！
		$data['present_id'] = $this->__getNextPresentId($data['child_id'], $theme['Month']['year'], $theme['Month']['month']);
		
		$this->create();
		if (!$this->save($data)) {
			return false;
		}
		$diary_id = $this->getLastInsertId();
		
		//child_present
		if (!empty($data['present_id'])) {
			$request = array();
			$request['child_id'] = $data['child_id'];
			$request['present_id'] = $data['present_id'];
			$ChildPresent =& ClassRegistry::init('ChildPresent');
			$ChildPresent->save($request);
		}
		
		//image file
		if (!empty($data['image'])
				&& strlen($data['image']) < Configure::read('Diary.image_filesize_max')) {
			
			//画像保存(オリジナル)
			$image_path_original = sprintf(Configure::read('Diary.image_path_original'), $data['child_id'], $diary_id);
			$this->__mkdir($image_path_original);
			$fp = fopen( $image_path_original, "w" );
			fwrite( $fp, $data['image'], strlen($data['image']) );
			fclose( $fp );
			$info = getimagesize($image_path_original);
			
			if (!empty($info)
					&& $info[2] == IMAGETYPE_JPEG) {

				//画像保存(比率保持)
				$image_path_thumb = sprintf(Configure::read('Diary.image_path_thumb'), $data['child_id'], $diary_id);
				$this->__mkdir($image_path_thumb);
				$fp = fopen( $image_path_thumb, "w" );
				fwrite( $fp, $data['image'], strlen($data['image']) );
				fclose( $fp );
				$this->__resize_image($image_path_thumb, Configure::read('Diary.image_thumb_size'), false);
				
				//画像保存(正方形)
				$image_path_rect = sprintf(Configure::read('Diary.image_path_rect'), $data['child_id'], $diary_id);
				$this->__mkdir($image_path_rect);
				$fp = fopen( $image_path_rect, "w" );
				fwrite( $fp, $data['image'], strlen($data['image']) );
				fclose( $fp );
				$this->__resize_image($image_path_rect, Configure::read('Diary.image_rect_size'), true);
			}
			
			//画像削除(オリジナル)
			unlink($image_path_original);
		}
		
		return true;
	}
	
	function __getNextPresentId($child_id, $year, $month) {
		
		//テーマ月のプレゼント一覧
		$presents = ClassRegistry::init('Present')->find('month', array(
			'year' => $year,
			'month' => $month,
			'order' => 'Present.present_type ASC'
		));
		
		//テーマ月に獲得したプレゼント一覧
		$child_presents = ClassRegistry::init('Child')->find('present', array(
			'conditions' => array(
				'Child.id' => $child_id,
				'Month.year' => $year,
				'Month.month' => $month,
			)
		));
		
		if (count($presents) <= count($child_presents)) {
			return null;
		}
		
		//テーマ月に投稿した思い出一覧
		$diaries = ClassRegistry::init('Child')->find('diary', array(
			'conditions' => array(
				'Child.id' => $child_id,
				'Month.year' => $year,
				'Month.month' => $month,
			)
		));
		
		$next_present_idx = count($child_presents);
		return $presents[$next_present_idx]['Present']['id'];
	}

	function __resize_image($filepath, $size, $is_rect=false) {
		
		$type = exif_imagetype($filepath);
		if ($type == 2) {
			#-------------------------------------------------------
			# 画像リサイズ
			#-------------------------------------------------------
			$this->__smart_resize_image(
				$filepath,		//file
				$size,			//width
				$size,			//height
				true,			//proportional
				'out',			//fit_type
				'file',			//output
				true,			//delete_original
				false			//use_linux_commands
			);
			
			#-------------------------------------------------------
			# 画像を中心から正方形にカット
			#-------------------------------------------------------
			if ($is_rect) {
				require_once APP.'vendors/class.image.php';
				
				$info = getimagesize($filepath);//サイズ取得
				$thumb = new Image($filepath);
				$thumb->width($size); 
				$thumb->height($size); 
				$thumb->crop(($info[0] - $size) / 2, ($info[1] - $size) / 2);
				$thumb->save();
			}
		}
	}

	#*******************************************************************************
	#	画像リサイズ
	#	https://github.com/maxim/smart_resize_image
	#	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	#*******************************************************************************
	function __smart_resize_image($file,
	                            $width              = 0, 
	                            $height             = 0, 
	                            $proportional       = false, 
	                            $fit_type           = 'in', 
	                            $output             = 'file', 
	                            $delete_original    = true, 
	                            $use_linux_commands = false ) {
	    
	  if ( $height <= 0 && $width <= 0 ) return false;

	  # Setting defaults and meta
	  $info                         = getimagesize($file);
	  $image                        = '';
	  $final_width                  = 0;
	  $final_height                 = 0;
	  list($width_old, $height_old) = $info;

	  # Calculating proportionality
	  if ($proportional) {
	    if      ($width  == 0)  $factor = $height/$height_old;
	    elseif  ($height == 0)  $factor = $width/$width_old;
	//	    else                    $factor = min( $width / $width_old, $height / $height_old );
		#-------------------------------------------------------
		# mod by w.iida
		else {
			# Whether image fit in / out the target size
			if ($fit_type == 'in') {
				$factor = min( $width / $width_old, $height / $height_old );
			} else {
				$factor = max( $width / $width_old, $height / $height_old );
			}
		}
		#-------------------------------------------------------
		
	    $final_width  = round( $width_old * $factor );
	    $final_height = round( $height_old * $factor );
	  }
	  else {
	    $final_width = ( $width <= 0 ) ? $width_old : $width;
	    $final_height = ( $height <= 0 ) ? $height_old : $height;
	  }

	  # Loading image to memory according to type
	  switch ( $info[2] ) {
	    case IMAGETYPE_GIF:   $image = imagecreatefromgif($file);   break;
	    case IMAGETYPE_JPEG:  $image = imagecreatefromjpeg($file);  break;
	    case IMAGETYPE_PNG:   $image = imagecreatefrompng($file);   break;
	    default: return false;
	  }
	  
	  
	  # This is the resizing/resampling/transparency-preserving magic
	  $image_resized = imagecreatetruecolor( $final_width, $final_height );
	  if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
	    $transparency = imagecolortransparent($image);

	    if ($transparency >= 0) {
	      $transparent_color  = imagecolorsforindex($image, $trnprt_indx);
	      $transparency       = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
	      imagefill($image_resized, 0, 0, $transparency);
	      imagecolortransparent($image_resized, $transparency);
	    }
	    elseif ($info[2] == IMAGETYPE_PNG) {
	      imagealphablending($image_resized, false);
	      $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
	      imagefill($image_resized, 0, 0, $color);
	      imagesavealpha($image_resized, true);
	    }
	  }
	  imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
	  
	  # Taking care of original, if needed
	  if ( $delete_original ) {
	    if ( $use_linux_commands ) exec('rm '.$file);
	    else @unlink($file);
	  }

	  # Preparing a method of providing result
	  switch ( strtolower($output) ) {
	    case 'browser':
	      $mime = image_type_to_mime_type($info[2]);
	      header("Content-type: $mime");
	      $output = NULL;
	    break;
	    case 'file':
	      $output = $file;
	    break;
	    case 'return':
	      return $image_resized;
	    break;
	    default:
	    break;
	  }
	  
	  # Writing image according to type to the output destination
	  switch ( $info[2] ) {
	    case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
	    case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output);   break;
	    case IMAGETYPE_PNG:   imagepng($image_resized, $output);    break;
	    default: return false;
	  }

	  return true;
	}
	
	function __mkdir($path) {
		$dir = dirname($path);
		if (!file_exists($dir)) {
			system("mkdir -p $dir");
		}
	}
	
}
?>