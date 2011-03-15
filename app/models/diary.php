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
	
	//思い出登録
	function addByEmail($data) {

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
			$request['subject'] = $data['subject'];
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
		
		pr($data);
		
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
		echo $data['present_id'];
		
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
		
		//画像保存
		
		
		
		
		
		
		return true;
	}
	
	function __getNextPresentId($child_id, $year, $month) {
		
		//テーマ月のプレゼント一覧
		$presents = ClassRegistry::init('Present')->find('month', array(
			'year' => $year,
			'month' => $month,
			'order' => 'Present.present_type ASC'
		));
		pr($presents);
		
		//テーマ月に獲得したプレゼント一覧
		$child_presents = ClassRegistry::init('Child')->find('present', array(
			'conditions' => array(
				'Child.id' => $child_id,
				'Month.year' => $year,
				'Month.month' => $month,
			)
		));
		pr($child_presents);
		
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
		pr($diaries);
		
		$next_present_idx = count($child_presents);
		return $presents[$next_present_idx]['Present']['id'];
	}

	#*******************************************************************************
	#	画像リサイズ
	#	https://github.com/maxim/smart_resize_image
	#	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	#*******************************************************************************
	function smart_resize_image($file,
	                            $duplicate_file,//add by w.iida
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
	    #-------------------------------------------------------
	    # add by w.iida
	    #
	    case 'duplicate':
	      $output = $duplicate_file;
	    break;
	    #-------------------------------------------------------
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
}
?>