<?php

//ktaiライブラリインポート
App::import('Controller', 'KtaiApp');

class UsersController extends KtaiAppController {

	public $name = 'Users';
	public $uses = array('User');

	//forward設定
	public $forward_index = 'index';

	function beforeFilter() {
            $this->Auth->fields = array(
                'username' => 'loginid',
                'password' => 'password'
            );
            $this->Auth->allow('register','register_confirm','register_complete','logout');
            $this->Auth->redirect('/Children/');

            parent::beforeFilter();
	}

        function beforeRender() {
            parent::beforeRender();
        }

        function login(){
            $this->set('login_user',$this->Auth->user());
            $this->User->recursive = 0;
            $this->set('users', $this->paginate());
        }

	// 明示的にログアウト
	public function logout(){
		$redirectTo = $this->Auth->logout();
		$this->Session->setFlash('ログアウトしました');
		$this->render('/pages/top/');
	}

	function index() {
		$this->render('login');
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
            $this->pageTitle = '会員登録情報入力';
            
            if (!empty($this->data)) {
                $this->data = $this->covData();
            }

            //if ($this->User->validates()) {
                $this->Transition->checkData(array('register_confirm'));
            //}

            pr($this->data);

	}

        function register_confirm(){
            $this->pageTitle = '会員入力情報確認';
            $this->Transition->automate('register_complete', false, 'register');
            $this->data = $this->Transition->mergedData();
            $this->render('/pages/top/');
        }

        function register_complete() {
            $this->pageTitle = '会員登録完了';
            $this->Transition->checkPrev('register_confirm');

            //uid設定
            $request = array();
            $request = $this->Transition->mergedData();
            if($this->Ktai->is_ktai()) {
                $request['User']['uid'] = $this->Ktai->get_uid();
            }
            TransactionManager::begin();
            try {
               if( $this->User->register($request)){
                  TransactionManager::commit();
                  $this->render('register_complete');
               } else {
                  TransactionManager::rollback();
                  $this->render('register');
               }
            } catch(Exception $e) {
                  TransactionManager::rollback();
                  $this->render('register');
            }
        }

        function covData(){
            $data = $this->data;
            $request = array();
            $request = $data;
            $request['User']['loginid'] = $data['User']['new_loginid'];
            //ハッシュ化
            $request['User']['password'] = AuthComponent::password( $data['User']['new_password'] );
            unset ($request['User']['new_loginid']);
            unset ($request['User']['new_password']);
            unset ($request['User']['row_password']);
            $this->data = $request;
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