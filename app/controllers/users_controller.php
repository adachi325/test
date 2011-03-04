<?php

//ktaiライブラリインポート
App::import('Controller', 'KtaiApp');

class UsersController extends KtaiAppController {

	//ktaiライブラリ設定
	public $ktai = array(
		'use_img_emoji' => true,
		'input_encoding' => 'UTF8',
		'output_encoding' => 'UTF8',
		'use_xml' => true,
	);
	public $name = 'Users';
	public $uses = array('User');
        public $helpers = array('Ktai','Session','Form','SelectOptions');
        public $components = array('Ktai','Session','Auth','Transition');

	//forward設定
	public $forward_index = 'index';

	function beforeFilter() {
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array(
            'username' => 'loginid',
            'password' => 'password'
        );
        $this->Auth->loginError = 'パスワードが違います。';
        $this->Auth->authError = '会員用のページです。';
        $this->Auth->allow('index','register','add','logout');
	}

        function login() {
                    //CTPにデータを渡す用
                    $this->set('login_user',$this->Auth->user());
                    $this->User->recursive = 0;
                    $this->set('users', $this->paginate());
            //suta/sutasuta
        }

	// 明示的にログアウト
	public function logout(){
		$redirectTo = $this->Auth->logout();
		$this->Session->setFlash('ログアウトしました');
		$this->redirect($redirectTo);
	}

	function index() {
		$this->pageTitle = 'トップページ';
		//↓絶対消しましょう
		//pr($this->Auth->user());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action' => $forward_index));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function register() {
                $this->setline();
                
                $this->pageTitle = '会員登録';
		TransactionManager::begin();
                try {
                   if( $this->User->register($this->data)){
                      TransactionManager::commit();
                      $this->render('register_complete');
                   } else {
                      TransactionManager::rollback();
                   }
                } catch(Exception $e) {
                      TransactionManager::rollback();
                }
	}

        function register_complete() {
            
        }

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action' => $forward_index));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action' => $forward_index));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}
        
        //ライン情報取得
        function setline(){         
                $Line = ClassRegistry::init('Line');
                $Line = $Line->find('list');
                $this->set('lines', $Line);
        }
}
?>