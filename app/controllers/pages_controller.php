<?php

class PagesController extends AppController {
	public $name = 'Pages';
        public $uses = array();

        function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('*');
	}

	function display() {

            //ログイン済みならマイページへ遷移
            if($this->Auth->user()) {
                $this->set('login_user',$this->Auth->user());
                $this->redirect('/children/');
            }

            //ログイン済みじゃない場合、uidを取得
            $uid = $this->_getUid();
            $user =& ClassRegistry::init('User');
            $user->contain();
            $users = $user->find('all',array('conditions' => array('uid' => $uid)));
            //uidが存在する場合、自動ログイン実行
            if(!empty($users)){
                $this->redirect('/children/');
            }

            //ニュース取得
            $news =& ClassRegistry::init('news');
            $newslist = $news->find('all',array('conditions' =>
            array('start_at <= "'.date('Y-m-d H:i:s').'"','finish_at >= "'.date('Y-m-d H:i:s').'"' )));

            $this->set(compact('newslist'));

            //それ以外はトップページを表示する
            $this->render('/pages/top/');
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


	function android_top() { } 
	function charges() { } 
	function contact() { } 
	function help() { } 
	function list_models() { } 
	function maintenance() { } 
	function rules() { } 
}
?>
