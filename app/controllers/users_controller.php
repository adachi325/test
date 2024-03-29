<?php

class UsersController extends AppController {

    public $name = 'Users';
    public $uses = array('User', 'Child');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('api_login', 'register','register_confirm','register_complete','remind','remindCheck','remind_password','remind_complete');
    }

    function beforeRender() {
        parent::beforeRender();
        $this->User->recursive = 0;
    }

    function login(){

        /* uidﾁｪｯｸ(SSL通信時のみ) */
        $this->Tk->uidCheck();

        //ログイン判定
        if($this->Auth->user()) {
            $this->redirect($this->Auth->redirect());
        }
    }

    //明示的にログアウト(基本ログアウトは不可能)
    public function logout(){
        $this->Session->destroy();
        $redirectTo = $this->Auth->logout();
        $this->redirect('/');
    }

    function index() {
        if ($this->Ktai->is_imode()) {
            $this->redirect('/users/login/?guid=ON');
        } else {
            $this->redirect('/users/login');
        }
    }

    function register(){

        /* uidﾁｪｯｸ */
        $this->Tk->uidCheck();

        //ログイン済みならマイページへ遷移
        if($this->Auth->user()) {
            $this->set('login_user',$this->Auth->user());
            $this->Session->setFlash(__('会員登録済みです。', true));
            $this->redirect('/children/');
        }

        //ログイン済みじゃない場合、uidを取得
        $uid = $this->Session->read('sslUid');
        $this->User->contain();
        $users = $this->User->find('all',array('conditions' => array('uid' => $uid)));
        //uidが存在する場合、自動ログイン実行
        if(!empty($users)){
            $this->Session->setFlash(__('会員登録済みです。', true));
            $this->redirect('/children/');
        }

        $this->_setline();

        if (!empty($this->data) && isset($this->data['User']['back'])) {
            return;
        }

        //制御文字対策
        $user_attrs = array('loginid', 'new_password', 'row_password', 'dc_user');
        foreach ($user_attrs as $attr){
            if (isset($this->data['User'][$attr])) {
                $this->data['User'][$attr] = $this->check_invalid_code($this->data['User'][$attr]);
            }
        }
        $child_attrs = array('nickname', 'sex', 'birth_year', 'birth_month', 'line_id', 'benesse_user');
        foreach ($child_attrs as $attr){
            if (isset($this->data['Child'][0][$attr])) {
                $this->data['Child'][0][$attr] = $this->check_invalid_code($this->data['Child'][0][$attr]);
            }
        }

        if (!empty($this->data)) {
            $request = array();
            $request = $this->data;
            if(empty($request['Child'][0]['sex'])){
                $request['Child'][0]['sex'] = null;
            }
            TransactionManager::begin();
            if ($this->User->saveAll($request, array('validate'=>'only'))) {

                if(isset($this->data['User']['comp'])) {

                    //初回会員登録処理
                    if (!empty($this->data)) {
                        try {
                            TransactionManager::begin();
                            $registData = $this->_setRegisterData();
                            if( $this->User->_register($registData)){
                                //初回登録プレゼント

                                $this->User->save_hashcode($this->User->getLastInsertId());
                                $this->User->Child->save_hashcode($this->User->Child->getLastInsertId());

                                $this->_initialRegistrationPresents($this->User->Child->getLastInsertId());
                                TransactionManager::commit();

                                //ログイン実行
                                $user = $this->User->find('first', array(
                                    'conditions' => array($this->User->name.'.uid' => $uid)
                                ));
                                //取得したユーザー情報でログイン
                                if(!$this->Auth->login($user[$this->User->name])) {
                                    TransactionManager::rollback();

                                    $this->log('会員登録に失敗01:'.date('Y-m-d h:n:s'),LOG_DEBUG);
                                    $this->log($this->data,LOG_DEBUG);
                                    $this->cakeError('error404');
                                    return;
                                }

                                //UID再取得のため、フルパスでリダイレクト
                                $urlItem = split('\/',$_SERVER["SCRIPT_NAME"]);
                                $this->redirect('http://'.$_SERVER["SERVER_NAME"].'/'.$urlItem[1].'/navigations/after1');
                            } else {
                                TransactionManager::rollback();

                                $this->log('会員登録に失敗01:'.date('Y-m-d h:n:s'),LOG_DEBUG);
                                $this->log($this->data,LOG_DEBUG);
                                $this->cakeError('error404');
                                return;
                            }
                        } catch(Exception $e) {
                            TransactionManager::rollback();

                            $this->log('会員登録に失敗02:'.date('Y-m-d h:n:s'),LOG_DEBUG);
                            $this->log($this->data,LOG_DEBUG);
                            $this->log($e,LOG_DEBUG);
                            $this->cakeError('error404');
                            return;
                        }
                    } else {
                        TransactionManager::rollback();

                        $this->log('会員登録に失敗03:'.date('Y-m-d h:n:s'),LOG_DEBUG);
                        $this->cakeError('error404');
                        return;
                    }
                }


                TransactionManager::rollback();

                //セッションにデータ保持
                //$this->Session->write('userRegisterData', $this->data);

                //バリデーションにエラーがなければリダイレクト処理
                $this->render('register_confirm');
                return;

            }
            //バリデーションエラー時
            $this->set('validerr',1);
            TransactionManager::rollback();
        }

    }

    function _initialRegistrationPresents($id){
        $presentIds = Configure::read('Child.Initial_registration_presents');
        $request = array();
        for ($i=0;$i<count($presentIds);$i++) {
            $request[$i]['ChildPresent']['child_id'] = $id;
            $request[$i]['ChildPresent']['present_id'] = $presentIds[$i];
        }
        $ChildPresent =& ClassRegistry::init('ChildPresent');
        $ChildPresent->saveAll($request);
    }

    function _setRegisterData(){

        $request = array();
        $request = $this->data;
        //ハッシュ化
        $request['User']['password'] = AuthComponent::password( $request['User']['new_password'] );
        //uid取得
        $request['User']['uid'] = $this->Session->read('sslUid');
        $request['User']['carrier'] = $this->EasyLogin->_getCareer();
        unset ($request['User']['new_password']);
        unset ($request['User']['row_password']);
        return $request;
    }

    function _check_code() {
        if (isset($this->data['User']['new_password'])) {
            $this->data['User']['new_password'] = $this->check_invalid_code($this->data['User']['new_password']);
        }
        if (isset($this->data['User']['row_password'])) {
            $this->data['User']['row_password'] = $this->check_invalid_code($this->data['User']['row_password']);
        }
    }

    function edit() {

        /* uidﾁｪｯｸ(SSL通信時のみ) */
        $this->Tk->uidCheck();	

        $this->pageTitle = '登録情報変更';

        if (!empty($this->data)) {

            $this->_check_code();

            //パスワード変更なしの場合は、設定しない。
            if(empty($this->data['User']['new_password']) || !isset($this->data['User']['new_password'])) {
                unset($this->data['User']['new_password']);
                if(empty($this->data['User']['row_password']) || !isset($this->data['User']['row_password'])) {
                    unset($this->data['User']['row_password']);
                } else {
                    $this->data['User']['new_password'] = '';
                }
            }

            $this->User->set($this->data);
            if ($this->User->validates()) {
                //セッションにデータ保持
                $this->Session->write('userEditData', $this->data);
                //バリデーションにエラーがなければリダイレクト処理
                $this->redirect('/users/edit_confirm');
            }
        }

        //セッッション回収と削除
        $data = $this->Session->read('userEditData');
        if(!empty($data)){
            $userData = $this->Auth->user();
            $data['User']['loginid'] = $userData['User']['loginid'];
            $this->data = $data;
            $this->Session->delete('userEditData');
        }

        //それでもデータが無ければデータベースから取得
        if(empty($this->data)){
            $userData = $this->Auth->user();
            $this->data = $this->User->read(null, $userData['User']['id']);
        }
    }

    function edit_confirm(){

        /* uidﾁｪｯｸ(SSL通信時のみ) */
        $this->Tk->uidCheck();

        $this->pageTitle = '変更確認';
        //セッション情報回収
        $this->data = $this->Session->read('userEditData');
        if (empty($this->data)) {
            $this->Session->delete('userEditData');
            $this->cakeError('error404');
            return;
        }

        $this->_check_code();

        $this->_setline();
    }

    function edit_complete(){

        /* uidﾁｪｯｸ */
        $this->Tk->uidCheck();

        $this->pageTitle = '変更完了';
        //セッション情報回収、削除
        $this->data = $this->Session->read('userEditData');
        $this->Session->delete('userEditData');

        if (!empty($this->data)) {
            $this->_check_code();

            try {
                $this->_setEditData();
                $this->User->whitelist = array('id', 'password');
                if( $this->User->save($this->data)){
                    return;
                } else {
                    $this->log('会員更新に失敗01:'.date('Y-m-d h:n:s'),LOG_DEBUG);
                    $this->log($this->data,LOG_DEBUG);
                    $this->cakeError('error404');
                }
            } catch(Exception $e) {
                $this->log('会員登録に失敗02:'.date('Y-m-d h:n:s'),LOG_DEBUG);
                $this->log($this->data,LOG_DEBUG);
                $this->log($e,LOG_DEBUG);
                $this->cakeError('error404');
            }
        } else {
            $this->cakeError('error404');
        }
        //ログアウト
        $this->Auth->logout();

        //セッション全削除
        $this->Session->destroy();
    }

    function _setEditData(){
        $userData = $this->Auth->user();
        $editData = array();
        $editData = $this->data;
        $editData['User']['id'] = $userData['User']['id'];
        //パスワード変更なしの場合は、設定しない。
        if(isset($this->data['User']['new_password'])) {
            //ハッシュ化
            $editData['User']['password'] = AuthComponent::password( $editData['User']['new_password'] );
            unset ($editData['User']['new_password']);
            unset ($editData['User']['row_password']);
        }
        $this->data = $editData;
    }

    //ライン情報取得
    function _setline(){
        $Line = ClassRegistry::init('Line');
        $Lines = $Line->find('list');
        $this->set('lines', $Lines);
    }

    //リマインド認証
    function remind () {

        /* uidﾁｪｯｸ(SSL通信時のみ) */
        $this->Tk->uidCheck();	

        //初回はNoCheck
        if (empty($this->data['User']['NoCheck']) || !isset($this->data['User']['NoCheck'])) {
            $this->data['User']['NoCheck'] = '1';
            return;
        } else {
            $this->data['User']['NoCheck'] = '1';
        }

        //ログイン済みならマイページへ遷移
        if($this->Auth->user()) {
            $this->set('login_user',$this->Auth->user());
            $this->redirect('/children/');
        }
        //ログイン済みじゃない場合、uidを取得
        $uid = $this->Session->read('sslUid');
        $this->User->contain();
        $users = $this->User->find('all',array('conditions' => array('uid' => $uid)));

        //uidが存在する場合、自動ログイン実行
        if(!empty($users)){
            $this->redirect('/children/');
        }

        $errorStr = "入力情報が正しくありません。";

        //入力データが存在しない場合
        if(empty($this->data)){
            $this->set(compact('errorStr'));
            return;
        }

        //バリデーションチェック
        $validateData = $this->data;
        unset ($validateData['User']['NoCheck']);
        $this->User->set($validateData);
        if (!$this->User->validates()) {
            $this->set(compact('errorStr'));
            return;
        }

        //会員情報検索
        $conditions = array();
        $conditions['User.loginid'] = $this->data['User']['remindId'];
        $conditions['Child.nickname'] = $this->data['User']['nickname'];
        $conditions['Child.birth_year'] = $this->data['User']['birth_year'];
        $conditions['Child.birth_month'] = $this->data['User']['birth_month'];
        $child =& ClassRegistry::init('Child');
        $child->contain('User');
        $children = $child->find('all',array('conditions' => $conditions));

        if(empty($children)){
            $this->set(compact('errorStr'));
            return;
        }

        $this->Session->write('user_data', $children);
        $this->redirect('/users/remind_password');
        //$urlItem = split('\/',$_SERVER["SCRIPT_NAME"]);
        //$this->redirect('https://'.$_SERVER["SERVER_NAME"].'/'.$urlItem[1].'/users/remind_password?guid=ON&csid='.session_id());
    }


    //パスワード再設定
    function remind_password () {

        /* uidﾁｪｯｸ(SSL通信時のみ) */
        $this->Tk->uidCheck();

        $errorStr = "入力情報が正しくありません。";

        $userData = $this->Session->read('user_data');
        if(empty($userData)){
            $this->cakeError('error404');
            return;
        }

        //入力データが存在しない場合
        if(empty($this->data)){
            return;
        }

        $this->data['User']['id'] = $userData['0']['User']['id'];
        $this->data['User']['loginid'] = $userData['0']['User']['loginid'];

        //バリデーションチェック
        $this->User->set($this->data);
        if (!$this->User->validates()) {
            $this->set(compact('errorStr'));
            return;
        }

        //バリデーションで問題なければ更新処理
        $this->Session->delete('user_data');

        //会員情報更新
        $request = array();
        $request['User']['id'] = $userData['0']['User']['id'];
        $request['User']['password'] = AuthComponent::password($this->data['User']['new_password']);
        $request['User']['uid'] = $this->Session->read('sslUid');

        try {
            if( $this->User->save($request)){
                //UID再取得のため、フルパスでリダイレクト
                $urlItem = split('\/',$_SERVER["SCRIPT_NAME"]);
                $this->redirect('http://'.$_SERVER["SERVER_NAME"].'/'.$urlItem[1].'/users/remind_complete');
            } else {
                $this->log('パスワード再設定に失敗01:'.date('Y-m-d h:n:s'),LOG_DEBUG);
                $this->log($request,LOG_DEBUG);
                $this->cakeError('error404');
            }
        } catch(Exception $e) {
            $this->log('パスワード再設定に失敗02:'.date('Y-m-d h:n:s'),LOG_DEBUG);
            $this->log($request,LOG_DEBUG);
            $this->cakeError('error404');
        }
    }

    function remind_complete () {
    }

    function delete(){
        if(!empty($this->data['User']['check'])){
            $this->Session->write('user_delete_check',$this->data);
            $this->redirect('/users/delete_complete');
        }
        $userData = $this->Auth->user();
        $user = $this->User->read(null, $userData['User']['id']);
        if(empty($user)){
            $this->cakeError('error404');
            return;
        }

    }

    function delete_complete(){

        //セッションチェック
        $check = $this->Session->read('user_delete_check');
        $this->Session->delete('user_delete_check');
        if(empty($check)){
            $this->cakeError('error404');
            return;
        }

        //会員情報取得
        $userData = $this->Auth->user();
        $user = $this->User->read(null, $userData['User']['id']);

        $Children =& ClassRegistry::init('Child');
        foreach($user['Child'] as $child){

            $Children->contain('Diary','ChildPresent');
            $childData = $Children->read(null, $child['id']);

            //削除用の配列作成
            $deleteChildCondition = array("id" => $child['id']);
            //子供IDに紐付く子供情報、思い出情報、獲得プレゼント情報を削除
            TransactionManager::begin();
            try {
                $Children->contain('Diary','ChildPresent');
                if ($Children->deleteAll($deleteChildCondition)) {
                    //会員削除に進む
                } else {
                    TransactionManager::rollback();
                    //ログアウト
                    $this->Auth->logout();
                    //セッション全削除
                    $this->Session->destroy();
                    $this->redirect('/');
                }
            } catch(Exception $e) {
                TransactionManager::rollback();
                //ログアウト
                $this->Auth->logout();
                //セッション全削除
                $this->Session->destroy();
                $this->redirect('/');
            }


            //思い出に紐付く画像を削除
            foreach($childData['Diary'] as $diary) {
                if (file_exists('img/'.sprintf(Configure::read('Diary.image_path_thumb'), $childData['Child']['id'],$diary['id']))) {
                    if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_thumb'), $childData['Child']['id'],$diary['id']) )){
                        //$this->Session->setFlash(__('思い出画像の削除に失敗した可能性があります。', true));
                    }
                }
                if (file_exists('img/'.sprintf(Configure::read('Diary.image_path_rect'), $childData['Child']['id'],$diary['id']))) {
                    if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_rect'), $childData['Child']['id'],$diary['id']) )){
                        //$this->Session->setFlash(__('思い出画像の削除に失敗した可能性があります。', true));
                    }
                }
                if (file_exists('img/'.sprintf(Configure::read('Diary.image_path_postcard'), $childData['Child']['id'],$diary['id']))) {
                    if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_postcard'), $childData['Child']['id'],$diary['id']) )){
                        //$this->Session->setFlash(__('思い出画像の削除に失敗した可能性があります。', true));
                    }
                }
            }
        }

        //削除用の配列作成
        $deleteUserCondition = array("id" => $userData['User']['id']);
        try {
            $this->User->contain();
            if ($this->User->deleteAll($deleteUserCondition)) {
                TransactionManager::commit();
                //$this->Session->setFlash(__('削除完了。', true));
            } else {
                TransactionManager::rollback();
                //ログアウト
                $this->Auth->logout();
                //セッション全削除
                $this->Session->destroy();
                $this->redirect('/');
            }
        } catch(Exception $e) {
            TransactionManager::rollback();
            //ログアウト
            $this->Auth->logout();
            //セッション全削除
            $this->Session->destroy();
            $this->redirect('/');
        }

        //ログアウト
        $this->Auth->logout();

        //セッション全削除
        $this->Session->destroy();

        //トライアルトップへ遷移
        $this->redirect('/');
    }

    function menu() {
        //子供数取得（リンク表示有無情報）
        $user = $this->Auth->user();
        $userData = $this->User->findById($user['User']['id']);

        $childData = $this->Child->find('all',array('conditions'=>array('user_id'=>$userData['User']['id'])));

        $this->set(compact('childData'));
    }

    function other_setting() {

        /* uidﾁｪｯｸ(SSL通信時のみ) */
        $this->Tk->uidCheck();

        // POSTデータが存在する場合 
        if (!empty($this->data)) {
            $this->User->set($this->data);
            if ($this->User->validates()) {
                //セッションにデータ保持
                $this->Session->write('userOtherSettingData', $this->data);
                //バリデーションにエラーがなければリダイレクト処理
                $this->redirect('/users/other_setting_confirm');
            }
        }

        //セッッション回収と削除
        $data = $this->Session->read('userOtherSettingData');
        if(!empty($data)){
            $userData = $this->Auth->user();
            $this->data = $data;
            $this->Session->delete('userOtherSettingData');
        }

        //それでもデータが無ければデータベースから取得
        if(empty($this->data)){
            $userData = $this->Auth->user();
            $this->data = $this->User->read(null, $userData['User']['id']);
        }
    }

    function other_setting_confirm(){

        /* uidﾁｪｯｸ(SSL通信時のみ) */
        $this->Tk->uidCheck();

        $this->data['User']['dc_user'] = $this->check_invalid_code($this->data['User']['dc_user']);

        //セッション情報回収
        $this->data = $this->Session->read('userOtherSettingData');
        if (empty($this->data)) {
            $this->Session->delete('userOtherSettingData');
            $this->cakeError('error404');
            return;
        }
    }

    function other_setting_complete() {

        /* uidﾁｪｯｸ */
        $this->Tk->uidCheck();

        $this->data['User']['dc_user'] = $this->check_invalid_code($this->data['User']['dc_user']);

        //セッション情報回収、削除
        $this->data = $this->Session->read('userOtherSettingData');
        $this->Session->delete('userOtherSettingData');

        if (!empty($this->data)) {
            try {
                $this->User->whitelist = array('dc_user');
                if($this->User->save($this->data)){
                    $this->render('edit_complete');
                } else {
                    $this->log('会員更新に失敗other_setting01:'.date('Y-m-d h:n:s'),LOG_DEBUG);
                    $this->log($this->data,LOG_DEBUG);
                    $this->cakeError('error404');
                }
            } catch(Exception $e) {
                $this->log('会員登録に失敗other_setting02:'.date('Y-m-d h:n:s'),LOG_DEBUG);
                $this->log($this->data,LOG_DEBUG);
                $this->log($e,LOG_DEBUG);
                $this->cakeError('error404');
            }
        } else {
            $this->cakeError('error404');
        }

        //ログアウト
        $this->Auth->logout();

        //セッション全削除
        $this->Session->destroy();
    }

    /** 
     * 外部認証用API(step3)
     * 処理結果と認証用のhashコードを返す。
     * 
     * @param	int	$id    ﾛｸﾞｲﾝ用ID
     * @param	int	$pass   ﾛｸﾞｲﾝ用ﾊﾟｽﾜｰﾄﾞ
     * @return	String	$result	    処理結果
     * @return	String	$uid	    認証用hashｺｰﾄﾞ
     */
    function api_login() {

        //ｵｰﾄﾚﾝﾀﾞｰ解除
        $this->autoRender = false;

        $user_attrs = array('id', 'pass');
        foreach ($user_attrs as $attr){
            //制御文字対策
            if (isset($this->params['url'][$attr])) {
                $this->params['url'][$attr] = $this->check_invalid_code($this->params['url'][$attr]);
            }else{
                $this->log("必須ﾊﾟﾗﾒｰﾀなし:".$attr,LOG_DEBUG);
                return '"false",""';                            
            }
            $value = $this->params['url'][$attr];
            //length check
            if(strlen($value) < 3 || 100 < strlen($value)){
                $this->log("入力値長ｴﾗｰ:".$attr.'='.$value,LOG_DEBUG);
                return '"false",""';
            }
            // numalpha check
            if(!preg_match("/^[a-zA-Z0-9]+$/", $value)){
                $this->log("不正な入力値:".$attr.'='.$value,LOG_DEBUG);
                return '"false",""';
            }
        }

        //存在ﾁｪｯｸ
        $checkData = array();
        $checkData['User.loginid'] = $this->params['url']['id'];
        $checkData['User.password'] = $this->params['url']['pass'];
        $checkData['User.password'] = AuthComponent::password( $checkData['User.password'] );
        $this->User->contain();
        $user = $this->User->find('first',array('conditions' => $checkData));
        if(empty($user) || count($user) != 1){
            return '"false",""';
        }

        // uid値を作成する
        $savedata['User']['id'] = $user['User']['id'];
        $savedata['User']['uid'] = substr(md5($user['User']['id'].date('YmdHis')), 0, 16);
        $this->User->create();
        $this->User->save($savedata);

        //hash値をﾘﾀｰﾝ
        return '"true","'.$savedata['User']['uid'].'"';

    }
}
?>
