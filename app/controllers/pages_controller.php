<?php

class PagesController extends AppController {
	public $name = 'Pages';
	public $uses = array();
	public $helpers = array('Wikiformat.Wikiformat');

	/*
	public $allow_android = array(
		'list_model', 'charge', 'help', 'rule',
	);
	 */
	public $allow_android = true;
	public $view_prefix = '';

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('*');

		if ($this->Ktai->is_android()) {
			$this->layout = 'android';
			$this->view_prefix = 'android_';
		}
	}

    function renewal() { }

	function display() {

		if ($this->Ktai->is_android()) {
			
			$Content =& ClassRegistry::init('Content');
			$Content->contain();
            $contentData = $Content->find( 'all' , array( 'conditions' => array( 'Content.android_flag' => 1 ) ) );
			if (isset($contentData[0]) && (count( $contentData[0] ) > 0 )) {
                $lineFlag = array();
				foreach ( $contentData as $key => $value ) {
					$lineFlag[$value['Content']['line_id']] = 1;
				}
			}
			$Line =& ClassRegistry::init('Line');
			$Line->contain();
			$lineData = $Line->find( 'all' );
			$this->set( compact( 'contentData' , 'lineData' , 'lineFlag' ) );
			$this->render( 'android_top' );
			return;
		} else {
            $this->redirect('/');
        }

		//ログイン済みならマイページへ遷移
		if($this->Auth->user()) {
			$this->set('login_user',$this->Auth->user());
			//$this->redirect('/children/');
			echo $this->requestAction('/children/index', array('return'));
			$this->autoRender = false;
			return;
		}

		//ログイン済みじゃない場合、uidを取得
		$uid = $this->EasyLogin->_getUid();
		if(!empty($uid)) {
			$User =& ClassRegistry::init('User');
			$User->contain();
			$userdata = $User->find('first',array('conditions' => array('uid' => $uid)));
			//uidが存在する場合、自動ログイン実行
			if(!empty($userdata)){
				//取得したユーザー情報でログイン
				if($this->Auth->login($userdata)) {
					//ユーザー情報設定
					unset ($userdata['User']['uid']);
					unset ($userdata['User']['created']);
					unset ($userdata['User']['modified']);
					$this->set('login_user_data',$userdata);
					//$this->redirect('/children/');
					echo $this->requestAction('/children/index', array('return'));
					$this->autoRender = false;
					return;
				}
			}
		}

		//ニュース取得
		$news =& ClassRegistry::init('news');
		$newslist = $news->find('all',array('conditions' =>
			array('start_at <= "'.date('Y-m-d H:i:s').'"','finish_at >= "'.date('Y-m-d H:i:s').'"' )));

		$this->set(compact('newslist'));

		//それ以外はトップページを表示する
		$this->render('/pages/index');
	}

	/**
	 * 端末からuidを取得する。
	 */
	function _getUid(){
		//UID取得
		if($this->Ktai->is_ktai()) {
			$result = $this->_getCareer();
			if( $result == 0 or $result == 1 or $result == 2 ){
				return $this->Ktai->get_uid();
			}
		}
		return 0;
	}

	/**
	 * キャリア判定
	 */
	function _getCareer(){
		if ($this->Ktai->is_imode()) {
			return 0;
		} else if ($this->Ktai->is_ezweb()) {
			return 1;
		} else if ($this->Ktai->is_softbank()) {
			return 2;
		} else if ($this->Ktai->is_iphone()) {
			return 3;
		} else if ($this->Ktai->is_android()) {
			return 4;
		} else {
			return 5;
		}
	}


	function charges() { 
	}
	function contact() { 
		$this->render($this->view_prefix.$this->params['action']);   
	}
	function help() {
		$this->render($this->view_prefix.$this->params['action']);   
   	}
	function help2() {
		$this->render($this->view_prefix.$this->params['action']);   
   	}
	function list_models() {
		$this->render($this->view_prefix.$this->params['action']);   
   	}
	function maintenance() { 
    }

    function appli() {
		$this->render($this->view_prefix.$this->params['action']);   
    }

	function rules() {
		$this->render($this->view_prefix.$this->params['action']);   
   	}

        //uid取得不可時にエラーページを表示させる処理
        function errorMobileId(){
            $resultCareer = $this->_getCareer();
            if( $resultCareer == 0) {
                $career = 'dc';
            } else if ($resultCareer == 1 ) {
                $career = 'ez';
            } else if ($resultCareer == 2 ){
                $career = 'sb';
            } else {
                return;
            }
            
            //セッションギレのUID取得エラー端末は別画面へ遷移
            $uid = $this->_getUid();
            if(!empty($uid) && isset($uid)) {
                $this->Session->write('sessionTimeOutError01',1);
                $this->redirect('/');
            }
            
            $this->set('messege',Configure::read('Error.nothingUid.'.$career));
            return;
        }
	
	/*
	 * Release: 2011/7/15 
	 * Editor : takashi tadokoro
	 * outline: 水族館キャンペーンにて追加。
	 * QRコードからの直接アクセス専用のランディングページです。
	 */
	function aquarium(){ 
	    $this->layout = 'aquarium_base';
    }

    function release0812() {
		$this->render($this->view_prefix.$this->params['action']);   
    }

    function release0812_2() {
		$this->render($this->view_prefix.$this->params['action']);   
    }
}
?>
