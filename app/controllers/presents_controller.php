<?php
class PresentsController extends AppController {

	var $name = 'Presents';

	var $components = array('Qdmail');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('print_postcard', 'api_create_incentive');
	}

	function index($year = null, $month = null) {

		if(empty($year)){
			$year = date('Y');
		}
		if(empty($month)){
			$month = date('m')+0;
		}

		$opt = array();
		if ($year) {
			$opt['year'] = $year;
		}
		if ($month) {
			$opt['month'] = $month;
		}

		//手入力防止（未来年月チェック）
		if ($year > date('Y') or 
			($year == date('Y') and $month > (date('m')+0))) {
				//未来月のページを表示時リダイレクト
				$this->redirect('/presents/');
			}

		//手入力防止（過去年月チェック）
		$monthModel =& ClassRegistry::init('month');
		$beforeOptions['order'] = array(
			'(month.year+0), (month.month+0) ASC'
		);
		$monthModel->contain();
		$beforeFlag = $monthModel->find('first',$beforeOptions);
		if ($year < $beforeFlag['month']['year'] or
			($year == $beforeFlag['month']['year'] and $month < $beforeFlag['month']['month'])) {
				//過去年月のページを表示時リダイレクト
				$this->redirect('/presents/');
			}
		$this->set('beforeFlag',$beforeFlag);

		//年月を設定
		$setOptions['year'] = $year;
		$setOptions['month'] = $month;
		//思い出投稿時用にセッションに設定
		$this->Session->write('setOptions', $setOptions);

		$opt['order'] = array('Present.present_type');
		$presents = $this->Present->find('month', $opt);

		$this->set(compact('presents', 'year', 'month'));
	}

	function present_list($type = null) {

		// 0＝壁紙、1＝デコメ絵文字、2＝待受けflash、3＝ポストカード	

		$child_id = $this->Tk->_getLastChild();

		if ($type === null) {
			//$this->Session->setFlash('プレゼントの種類を指定してください');
			$this->redirect(array('action' => 'index'));
		} else {
			if ($type >= 0) {

				$cond = array('Present.present_type' => $type);
		
				if ($child_id) {
					$ChildPresent =& ClassRegistry::init('ChildPresent');
					$ChildPresent->contain();
					$present_ids = $ChildPresent->find('all', array(
						'fields' => array('id', 'present_id'), 
						'conditions' => array('child_id' => $child_id),
						'order' => array('ChildPresent.id DESC'),
					));
					
					if (is_array($present_ids)) {
						$cond["Present.id"] = Set::combine($present_ids, '{n}.ChildPresent.id', '{n}.ChildPresent.present_id');
					}
				}

				$this->Present->contain(array('Month'));
				$items = $this->paginate('Present', $cond, array('limit' => 10));

				//アイテムを逆順にソート
				rsort($items);
				
				$this->set(compact('items'));
				
				$this->render("present_list_{$type}");		
			} else {
				// 会員限定コンテンツ
				$this->render("present_list_member");
			}
		}
	}

	function select($type = null, $template_id = null, $new_page = 0) {

		$data = $this->data;

		if($type == 'flash') {
			$max_count = 3;
		} else {
			$max_count = 4;
		}

		$page = 1;
		if ($new_page > 0) {
			$page = $new_page;
		}

		if ($data && isset($data['Present']['page'])) {
			$page = $data['Present']['page'];
			$pageCount = $data['Present']['pageCount'];

			if (!isset($data['select_photo'])) {
				$data['select_photo'] = array();
			}

			$this->Session->write("Present.{$page}.selection", $data['select_photo']);

			$selection = array();
			if (isset($this->params['form']['create'])) {
				for($i = 1; $i < $pageCount + 1; $i++) {
					$sel = $this->Session->read("Present.{$i}.selection");
					if (!is_array($sel)) {
						continue;
					}
					foreach($sel as $key => $value) {
						if ($value == 1) {
							$selection[] = $key;
						}
					}
				}

				if (count($selection) == $max_count) {
					$this->Session->write('Present.data', $data['Present']);
					$this->Session->write('Present.data.selection', $selection);
					$this->Session->write('Present.data.type', $type);
					$this->redirect("/presents/complete/");
				} else {
					$this->Session->delete('Present');
					$this->Session->write('Present.error.type', $type);
					$this->Session->write('Present.error.template_id', $template_id);
					$this->redirect("/presents/error_photo/");
				}
			}
			if (isset($this->params['form']['prev'])) {
				$page--;
				if ($page < 1) {
					$page = 1;
				}
			}
			if (isset($this->params['form']['next'])) {
				$page++;
				if ($page > $pageCount) {
					$page = $pageCount;
				}
			}
			$this->data['select_photo'] = $this->Session->read("Present.{$page}.selection");
		}

		$this->Diary =& ClassRegistry::init('Diary');
		$this->Diary->contain();

		$cond = array(
			'child_id' => $this->Tk->_getLastChild(),
			'has_image' => 1,
		);


		$this->paginate = array('conditions' => $cond, 'order' => 'Diary.created DESC', 'limit' => 10, 'page' => $page);

		$items = $this->paginate('Diary', $cond);

		$count = $this->Diary->find('count', array('conditions' => $cond));

		//思い出の投稿すうがプレゼント作成に必要な枚数以下の場合エラー
		if ($count < $max_count) {
			$this->redirect("/presents/error_present/");
		}

		$this->set(compact('items', 'data', 'type', 'template_id', 'max_count'));
	}

	function complete() {
            
		$data = $this->Session->read('Present.data');
		if(empty($data)){
			$this->cakeError('error404');
			$this->Session->delete('Present');
			return;
		}

		$selected = array(
			'diary_id' => $data['selection'],
			'present_id' => $data['template'],
			'child_id' => $this->Tk->_getLastChild(),
		);

		$render = "";

		$type = $this->Session->read('Present.data.type');
		if(empty($type)){
			$this->cakeError('error404');
			$this->Session->delete('Present');
			return;
		}

		if ($type === "flash") {
			$this->CreatePresent->createFlash($selected);

			$urlItem = split('\/',$_SERVER["SCRIPT_NAME"]);

			$this->set(compact('selected','urlItem'));
			$render = 'complete_flash';
		} else if ($type === "postcard") {
			$token = $this->CreatePresent->createPostcard($selected);
			if ($token === false) {
				$this->cakeError('error502');
				$this->Session->delete('Present');
				return;
			}
			$render = 'complete_postcard';
		} else {
			$this->cakeError('error404');
			$this->Session->delete('Present');
			return;
		}

		$this->Session->delete('Present');

                if($type == 'postcard') {
                    //メールアドレス設定
                    $url = Router::url('/'.'presents/print_postcard/'.$token.'/', true);
                    $mailSubject = "ポストカード印刷用URL";

		    if($this->Ktai->is_imode()){
			$mailBody ="{$url}%0D%0A※PCからアクセスし、プリントアウトしてください%0D%0A※URLの有効期限は3日間です";
		    } else {
			$mailBody ="{$url}\r\n※PCからアクセスし、プリントアウトしてください\r\n※URLの有効期限は3日間です";
		    }


		    $this->Session->delete('Present');
		    $present_id = $data['template'];

		    $this->set(compact('mailSubject','mailBody','token','present_id'));
		}

		$this->render($render);
	}

	function error_present() {
		
	}

	function error_photo() {

            $type=$this->Session->read('Present.error.type');
            $template_id=$this->Session->read('Present.error.template_id');

		if($type == 'flash') {
			$max_count = 3;
		} else if ($type === "postcard") {
			$max_count = 4;
		} else {
			$this->cakeError('error404');
			return;
                }

                if(empty($template_id)){
			$this->cakeError('error404');
			return;
                }

		$this->set(compact('type', 'template_id', 'max_count'));
		
	}

	function print_postcard($token = null) {
		if ($token === null) {
			$this->cakeError('error404');
			return;
		}
		$this->layout = null;

		$PostcardUrl =& ClassRegistry::init('PostcardUrl');
		$this->set(compact('token'));
		if (!$PostcardUrl->isValiable($token)) {
			$this->render('print_postcard_error');
		}
	}
    /** 
     * 待受けまたはポストカードを作成する。
     * 作成結果とトークンを返す。
     * リサイズしたファイルのパスを返す。
     * 
     * @param  int      $present_id     : プレゼントID
     * @param  int      $child_id       : 子供ID
     * @param  int      $type           : インセンティブタイプ
     * @param  int      $diary1～4      : ダイアリーID
     * @return string   $result         : 結果
     * @return string   $path           : 作成されたインセンティブパス
    **/
    function api_create_incentive (
        $present_id = null, $child_id = null, $type = null, 
        $diary1 = null, $diary2 = null, $diary3 = null, $diary4 = null){

        //ｵｰﾄﾚﾝﾀﾞｰ解除
        $this->autoRender = false;

        //
        $retval_false = '"false",""';
        //
        $url_params = array('present_id', 'child_id', 'type', 'diary1', 'diary2', 'diary3', 'diary4');
        $api_args = array();
	
	//ﾊﾟﾗﾒｰﾀ不正ﾁｪｯｸ
        foreach($url_params as $param){
            //引数ﾁｪｯｸ
	    if(!isset($this->params['url'][$param])){
                if(strcmp($param,'diary4') === 0){
                    continue;
                }else{
                    $this->log("[api_create_incentive]必須パラメータがありません:".$param, LOG_DEBUG);
                    return $retval_false;
                }
            }
	    $value = $this->params['url'][$param];
	    
	    if(empty($value)){
                $this->log("[api_create_incentive]値がありません:".$param, LOG_DEBUG);
                return $retval_false;
	    }
	    //ﾇﾙ文字対策
	    if (isset($value)) {
                $value = $this->check_invalid_code($value);
	    }
            //文字列長
            if(50 < strlen($value)){
                $this->log("[api_create_incentive]不正な文字列長値.len of ".$param.'='.strlen($value), LOG_DEBUG);
                return $retval_false;
            }
            //数値のみ
            if(!preg_match('/^[0-9]+$/', $value)){
                $this->log("[api_create_incentive]不正なパラメータ値:".$param.'='.$value, LOG_DEBUG);
                return $retval_false;
            }
            
            //api args
            if(strcmp($param,'diary1')===0)
                $api_args['diary_id'][0] = $value;
            if(strcmp($param,'diary2')===0)
                $api_args['diary_id'][1] = $value;
            if(strcmp($param,'diary3')===0)
                $api_args['diary_id'][2] = $value;
            if(strcmp($param,'diary4')===0)
                $api_args['diary_id'][3] = $value;
            else
                $api_args[$param] = $value;
        }
        
        // incentive作成
        $result = false;
        if($api_args['type'] == 1){
            //スマホ用待受け。
            $result = $this->CreatePresent->createWallpaper4SmartPhone($api_args);
        }else if($api_args['type'] == 2){
            //スマホ用ポストカード
            $result = $this->CreatePresent->createPostCard4SmartPhone($api_args);
        }else{
                $this->log("[api_create_incentive]不正なパラメータ値:type=".$api_args['type'], LOG_DEBUG);
                return $retval_false;            
        }
            
        if($result === false){
                return $retval_false;                                    
        }else{
                return '"true","'.$result.'"';                        
        }
    }
}
?>
