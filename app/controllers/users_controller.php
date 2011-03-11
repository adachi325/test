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
             $this->Session->setFlash(__('不正操作です。', true));
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
        $request['User']['carrier'] = $this->EasyLogin->_getCareer();
        unset ($request['User']['new_password']);
        unset ($request['User']['row_password']);
        $this->data = $request;
    }

    function edit() {
        $this->pageTitle = '登録情報変更';
        if (!empty($this->data)) {
            $this->_setEditData();
            if ($this->User->save($this->data, array('validate'=>'only'))) {
                //セッションにデータ保持
                $this->Session->write('userEditData', $this->data);
                //バリデーションにエラーがなければリダイレクト処理
                $this->redirect('/users/edit_confirm');
            }
        }
        //それでもデータが無ければデータベースから取得
        if(empty($this->data)){
            $userData = $this->Auth->user();
            $this->data = $this->User->read(null, $userData['User']['id']);
        }
    }

    function edit_confirm(){
        $this->pageTitle = '変更確認';
        //セッション情報回収
        $this->data = $this->Session->read('userEditData');
        if (empty($this->data)) {
            $this->Session->delete('userEditData');
            $this->Session->setFlash(__('不正操作です。', true));
            $this->redirect('/');
        }
        $this->_setline();
        $this->pageTitle = '会員入力情報確認';
    }
    
    function edit_complete(){
        $this->pageTitle = '変更完了';
        //セッション情報回収、削除
        $this->data = $this->Session->read('userEditData');
        $this->Session->delete('userEditData');

        //初回会員登録処理
        if (!empty($this->data)) {
            try {
               if( $this->User->save($this->data)){
                  $this->Session->setFlash(__('更新完了。', true));
               } else {
                  $this->Session->setFlash(__('更新失敗。', true));
               }
            } catch(Exception $e) {
                  $this->Session->setFlash(__('システムエラー。', true));
            }
        } else {
             $this->Session->setFlash(__('不正操作です。', true));
        }

    }

    function _setEditData(){
        $userData = $this->Auth->user();
        $editData = array();
        $editData = $this->data;
        $editData['User']['id'] = $userData['User']['id'];
        //ハッシュ化
        $editData['User']['password'] = AuthComponent::password( $editData['User']['new_password'] );
        unset ($editData['User']['new_password']);
        unset ($editData['User']['row_password']);
        $this->data = $editData;
    }

    //ライン情報取得
    function _setline(){
            $Line = ClassRegistry::init('Line');
            $Line = $Line->find('list');
            $this->set('lines', $Line);
    }
}
?>
