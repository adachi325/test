<?php

class UsersController extends AppController {

    public $name = 'Users';
    public $uses = array('User');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->fields = array(
            'username' => 'loginid',
            'password' => 'password'
        );
        $this->Auth->allow('register','register_confirm','register_complete');
    }

    function beforeRender() {
        parent::beforeRender();
    }

    function login(){
        //ログイン判定
        if($this->Auth->user()) {
            $this->redirect($this->Auth->redirect());
        }
        $this->Auth->loginError = 'パスワードが違います。';
        $this->Auth->authError =  'ログインしてください';
        $this->User->recursive = 0;
    }

    //明示的にログアウト
    public function logout(){
            $redirectTo = $this->Auth->logout();
            $this->Session->setFlash('ログアウトしました');
            $this->redirect('/pages/top');
    }

    function index() {
            $this->redirect('/users/login');
    }

    function view($id = null) {
            if (!$id) {
                    $this->Session->setFlash(__('Invalid User', true));
                    $this->redirect('/users/index');
            }
            $this->set('user', $this->User->read(null, $id));
    }

    function register(){
        $this->_setline();
        $this->pageTitle = '会員登録情報入力';
        if (!empty($this->data)) {
            if ($this->User->saveAll($this->data, array('validate'=>'only'))) {
                //セッションにデータ保持
                $this->Session->write('userRegisterData', $this->data);
                //バリデーションにエラーがなければリダイレクト処理
                $this->redirect('/users/register_confirm');
            } 
        }
        //セッション情報回収、削除
        $userRegisterData = $this->Session->read('userRegisterData');
        if(!empty($userRegisterData)){
            $this->data = $userRegisterData;
            $this->Session->delete('userRegisterData');
        }
    }

    function register_confirm(){
        //セッション情報回収
        $this->data = $this->Session->read('userRegisterData');
        if (empty($this->data)) {
            $this->Session->delete('userRegisterData');
            $this->Session->setFlash(__('不正操作です。', true));
            $this->redirect('/');
        }
        $this->_setline();
        $this->pageTitle = '会員入力情報確認';
    }

    function register_complete() {
        $this->pageTitle = '会員登録完了';

        //セッション情報回収、削除
        $this->data = $this->Session->read('userRegisterData');
        $this->Session->delete('userRegisterData');

        //初回会員登録処理
        if (!empty($this->data)) {
            try {
               TransactionManager::begin();
               $this->_setRegisterData();
               if( $this->User->_register($this->data)){
                  TransactionManager::commit();
                  $this->Session->setFlash(__('会員登録完了。', true));
               } else {
                  TransactionManager::rollback();
                  $this->Session->setFlash(__('会員登録失敗。', true));
                  $this->redirect('/pages/top/');
               }
            } catch(Exception $e) {
                  TransactionManager::rollback();
                  $this->Session->setFlash(__('システムエラー。', true));
                  $this->redirect('/pages/top/');
            }
        } else {
             $this->Session->setFlash(__('お不正操作です。', true));
             $this->redirect('/pages/top/');
        }
    }

    function _setRegisterData(){
        if($this->Ktai->is_ktai()) {
            $request['User']['uid'] = $this->Ktai->get_uid();
        }
        $request = array();
        $request = $this->data;
        //ハッシュ化
        $request['User']['password'] = AuthComponent::password( $request['User']['new_password'] );
        //uid取得
        $request['User']['uid'] = $this->EasyLogin->_getUid();
        unset ($request['User']['new_password']);
        unset ($request['User']['row_password']);
        $this->data = $request;
    }

    function edit($id = null) {
            if (!$id && empty($this->data)) {
                    $this->Session->setFlash(__('Invalid User', true));
                    $this->redirect('users/index');
            }
            if (!empty($this->data)) {
                    if ($this->User->save($this->data)) {
                            $this->Session->setFlash(__('The User has been saved', true));
                            $this->redirect('users/index');
                    } else {
                            $this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
                    }
            }
            if (empty($this->data)) {
                    $this->data = $this->User->read(null, $id);
            }
    }

    //ライン情報取得
    function _setline(){
            $Line = ClassRegistry::init('Line');
            $Line = $Line->find('list');
            $this->set('lines', $Line);
    }
}
?>