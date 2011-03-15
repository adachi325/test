<?php

class ChildrenController extends AppController {

    var $name = 'Children';

    function beforeFilter() {
		parent::beforeFilter();
    }

    function index($id = null) {
        //子供データ一覧設定
        $childrenData = $this->_setChild();

        //最終子供ID更新
        if ($id !== null &&
            $id >= 0 && $id < count($childrenData)) {
            $updateId = $childrenData[$id]['Child']['id'];
            $this->_saveLastChild($updateId);
        }

        //最終子供ID設定
        $lastChildId = $this->_getLastChild();

        $currentChild = $this->Child->findById($lastChildId);

        $Issue =& ClassRegistry::init('Issue');
        //$issues = $Issue->find('month', array('line_id' => $currentChild['Child']['line_id']));
        $issues = $Issue->find('month');

        $month =& ClassRegistry::init('month');
        $options = array();
        $options['year'] = date('Y');
        $options['month'] = date('m') + 0;
        $months = $month->find('all',array('conditions' => $options));

        $lines = $this->Child->Line->find('list');

        $this->Child->Diary->contain();
        $diaries = $this->Child->Diary->find('all', array('conditions'=>array('child_id' => $this->_getLastChild())));
        $this->set(compact('diaries'));

        $this->set(compact('childrenData', 'lastChildId', 'currentChild', 'issues','months','lines','diaries'));
    }

    //最終子供ID更新
    function _saveLastChild($id){
        $userData = array();
        $userData = $this->Auth->user();
        $userData['User']['last_selected_child'] = $id;
        unset ($userData['User']['loginid']);
        unset ($userData['User']['carrier']);
        unset ($userData['User']['dc_user']);
        unset ($userData['User']['admin_user']);
        unset ($userData['User']['uid']);
        unset ($userData['User']['created']);
        unset ($userData['User']['modified']);
        $this->Child->saveLastChild($userData);
    }

    //最終子供ID取得
    function _getLastChild(){
        $userData = $this->Auth->user();
        $User = ClassRegistry::init('User');
        $User = $User->find('first', array('conditions'=>array('id'=>$userData['User']['id'])));
        return $User['User']['last_selected_child'];
    }

    //子供情報取得
    function _setChild(){
        $userData = $this->Auth->user();
        $childData = $this->Child->find('all', array('conditions'=>array('user_id'=>$userData['User']['id'])));
        return $childData;
    }

    function _setSimaItem(){
        $simaItem = array();
        $simaItem[1] = 'しま(青)';
    }

    function register() {
        //子供数チェック
        $this->_checkChildrenCount();

        if (!empty($this->data)) {
            $request = array();
            $request = $this->data;
            $userData = $this->Auth->user();;
            $request['Child']['user_id'] = $userData['User']['id'];
            $this->data = $request;
            $this->Child->set($this->data);
            if($this->Child->validates()){
                $this->Session->write('childRegisterData', $this->data);
                $this->redirect('/children/register_confirm');
            } else {
                    $this->Session->setFlash(__('入力項目に不備があります。', true));
            }
        }
        $lines = $this->Child->Line->find('list');
        $this->set(compact('lines'));

        //セッション情報回収、削除
        $childRegisterData = $this->Session->read('childRegisterData');
        if(!empty($childRegisterData)){
            $this->data = $childRegisterData;
            $this->Session->delete('childRegisterData');
        }

    }

    function register_confirm(){
        //セッション情報回収
        $this->data = $this->Session->read('childRegisterData');

        if (empty($this->data)) {
            $this->Session->delete('childRegisterData');
            $this->Session->setFlash(__('不正操作です。', true));
            $this->redirect('/children/');
        }
        
        $lines = $this->Child->Line->find('list');
        $this->set(compact('lines'));
    }

    function register_complete(){
        //子供数チェック
        $this->_checkChildrenCount();
        
        //セッション情報回収、削除
        $this->data = $this->Session->read('childRegisterData');
        $this->Session->delete('childRegisterData');

        //子供登録処理
        if (!empty($this->data)) {
            TransactionManager::begin();
            try {
                $this->Child->create();
                if ($this->Child->save($this->data)) {
                    TransactionManager::commit();
                    $this->Session->setFlash(__('子供登録完了。', true));
                } else {
                    TransactionManager::rollback();
                    $this->Session->setFlash(__('子供登録失敗。', true));
                    $this->redirect('/children/');
                }
            } catch(Exception $e) {
              TransactionManager::rollback();
              $this->Session->setFlash(__('システムエラー。', true));
              $this->redirect('/children/');
            }
        } else {
             $this->Session->setFlash(__('不正操作です。', true));
             $this->redirect('/children/');
        }
    }

    //子供が３人以上存在する場合はその有無を表示する。
    function _checkChildrenCount(){
        $userData = $this->Auth->user();
        $childData = $this->Child->find('all',array('conditions'=>array('user_id'=>$userData['User']['id'])));
        if( count($childData) > 2) {
            $this->Session->setFlash(__('子供は３人以上登録できません。', true));
            $this->redirect('/children/index');
        }
    }

    //子供の情報を編集する
    function edit() {
        //セッション情報回収、削除
        $childRegisterData = $this->Session->read('childEditData');
        $this->Session->delete('childEditData');
        if(!empty($childRegisterData)){
            $this->data = $childRegisterData;
        }
        $childEditValidationErrors = $this->Session->read('childEditValidationErrors');
        $this->Session->delete('childEditValidationErrors');
        if(!empty($childEditValidationErrors)){
            $this->Child->set($this->data);
            $this->Child->validates();
        }

        if (empty($this->data)) {
            //最終子供ID設定
            $lastChildId = $this->_getLastChild();
            //子供情報取得
            $this->data = $this->Child->read(null, $lastChildId);
            $lines = $this->Child->Line->find('list');
        }
        
        $lines = $this->Child->Line->find('list');
        $this->set(compact('lines'));
    }

    function edit_confirm(){
        if (!empty($this->data)) {
            $request = array();
            $request = $this->data;
            $userData = $this->Auth->user();
            $request['Child']['id'] = $this->_getLastChild();
            $request['Child']['user_id'] = $userData['User']['id'];
            $this->data = $request;
            $this->Child->set($this->data);
            if($this->Child->validates()){
                $this->Session->write('childEditData', $this->data);
            } else {
                $this->Session->setFlash(__('入力項目に不備があります。', true));
                $this->Session->write('childEditData', $this->data);
                $this->Session->write('childEditValidationErrors', $this->validateErrors($this->Child));
                $this->redirect('/children/edit');
            }
        }
        $lines = $this->Child->Line->find('list');
        $this->set(compact('lines'));
    }

    function edit_complete(){
        //セッション情報回収、削除
        $this->data = $this->Session->read('childEditData');
        $this->Session->delete('childEditData');

        //子供登録処理
        if (!empty($this->data)) {
            TransactionManager::begin();
            try {
                $this->Child->create();
                if ($this->Child->save($this->data)) {
                    TransactionManager::commit();
                    $this->Session->setFlash(__('更新完了。', true));
                } else {
                    TransactionManager::rollback();
                    $this->Session->setFlash(__('更新失敗。', true));
                    $this->redirect('/children/');
                }
            } catch(Exception $e) {
              TransactionManager::rollback();
              $this->Session->setFlash(__('システムエラー。', true));
              $this->redirect('/children/');
            }
        } else {
             $this->Session->setFlash(__('不正操作です。', true));
             $this->redirect('/children/');
        }
    }
    
    function delete() {

        if(!empty($this->data)){
            //削除実行
            //bigbarnDEHEHE();
            //最古子供IDで最新子供IDを更新
            //OLD!OLD!OLD!
            //完了ページへリダイレクト！
            pr('わちょい！');
            $this->redirect('/children/delete_complete');
        }

        $childrenData = $this->_setChild();
        //削除する子供がいなければ不正操作
        if (empty($childrenData)){
             $this->Session->setFlash(__('不正操作です。', true));
             $this->redirect('/children/');
        }
        //最終子供ID設定
        $lastChildId = $this->_getLastChild();
        //最終子供IDの子供がいなければ不正操作
        if (empty($lastChildId)){
             $this->Session->setFlash(__('不正操作です。', true));
             $this->redirect('/children/');
        }
        //子供情報取得
        $this->data = $this->Child->read(null, $lastChildId);
    }

    function delete_complete(){ 
    }
}
?>
