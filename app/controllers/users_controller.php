<?php

//ktaiライブラリインポート
App::import('Controller', 'KtaiApp');

class UsersController extends KtaiAppController {

    public $name = 'Users';
    public $uses = array('User');

    function beforeFilter() {
        $this->Auth->fields = array(
            'username' => 'loginid',
            'password' => 'password'
        );
        $this->Auth->allow('register','register_confirm','register_complete','logout');
        $this->Auth->redirect('/children/index');

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
            $this->redirect('/users/login');
    }

    function view($id = null) {
            if (!$id) {
                    $this->Session->setFlash(__('Invalid User', true));
                    $this->redirect('/users/index');
            }
            $this->set('user', $this->User->read(null, $id));
    }

    function register() {
        $this->setline();
        $this->pageTitle = '会員登録情報入力';
        if (!empty($this->data)) {
            if ($this->User->saveAll($this->data, array('validate'=>'only'))) {
                //バリデーションにエラーがなければリダイレクト処理
                pr('1');
                $this->render('/users/register_confirm');
            } 
        }
    }

    function register_confirm(){
        $this->pageTitle = '会員入力情報確認';
        pr($this->data);
        //$this->set('captcha',createCaptcha()); // 架空の画像認証「作成」関数
    }

    function register_complete() {
        $this->pageTitle = '会員登録完了';
        $this->Transition->checkPrev('register_confirm');

        //uid設定
        $this->Transition->mergedData();

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
        if($this->Ktai->is_ktai()) {
            $request['User']['uid'] = $this->Ktai->get_uid();
        }
        $request = array();
        $request = $this->data;
        //ハッシュ化
        $request['User']['password'] = AuthComponent::password( $data['User']['new_password'] );
        unset ($request['User']['new_password']);
        unset ($request['User']['row_password']);
        return $request;
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
    function setline(){
            $Line = ClassRegistry::init('Line');
            $Line = $Line->find('list');
            $this->set('lines', $Line);
    }

    //会員ID取得
    function getUserId(){
        $User = ClassRegistry::init('User');
        $user2 = $User->find('all');
        pr($user2);
    }
}
?>