<?php

class ChildrenController extends AppController {

    var $name = 'Children';

    function beforeFilter() {
        parent::beforeFilter();
    }
    
    function test(){
        $args = array(
            'diary_id' => array(3,4,5),
            'child_id' => 2,
            'present_id' => 3
        );
        if(!$this->CreatePresent->createFlash($args)){
            $this->Session->setFlash(__('画像作成に失敗しました。', true));
        }
        $this->redirect('/children');
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
        //最終子供情報取得
        $currentChild = $this->Child->findById($lastChildId);

        //月号データ取得
        $Issue =& ClassRegistry::init('Issue');
        //$issues = $Issue->find('month', array('line_id' => $currentChild['Child']['line_id']));
        $issues = $Issue->find('month');

        //月データ取得
        $month =& ClassRegistry::init('month');
        $options = array();
        $options['year'] = date('Y');
        $options['month'] = date('m') + 0;
        $months = $month->find('all',array('conditions' => $options));

        //ライン情報取得
		$lines = $this->Child->Line->find('list');
		$currentLine = $this->Child->Line->findById($currentChild['Child']['line_id']);

        if(!empty($months)){
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->_getLastChild(),
<<<<<<< HEAD
                    'Diary.month_id' => $months['0']['month']['id']
=======
					'Diary.month_id' => $months['0']['month']['id'],
					'Diary.has_image' => 1,
                    'Diary.error_code' => null
>>>>>>> ac959258b2b743e0d79e15ae495c73302ad03834
                )
            );
            //表示データ一覧取得
            $diary =& ClassRegistry::init('diary');
            $diaries = $diary->find('all', $conditions);
        }

        //ニュース取得
        $news =& ClassRegistry::init('news');
        $newslist = $news->find('all',array('conditions' =>
            array('start_at <= "'.date('Y-m-d H:i:s').'"','finish_at >= "'.date('Y-m-d H:i:s').'"' )));

        $this->set(compact('childrenData', 'lastChildId', 'currentChild', 'issues','months','lines','currentLine','diaries','newslist'));
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
            if(empty($request['Child']['sex'])){
                $request['Child']['sex'] = null;
            }
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
                    //最終子供IDを更新
                    $this->_saveLastChild($this->Child->getLastInsertId());
                    //初回登録プレゼント
                    $this->_initialRegistrationPresents($this->Child->getLastInsertId());
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

    function _initialRegistrationPresents($id){
        $presentIds = Configure::read('Child.Initial_registration_presents');
        $request = array();
        for ($i=0;$i<count($presentIds);$i++) {
            $request[$i]['ChildPresent']['child_id'] = $id;
            $request[$i]['ChildPresent']['present_id'] = $presentIds[$i];
        }
        $this->Child->ChildPresent->saveAll($request);
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
        $childEditData = $this->Session->read('childEditData');
        $this->Session->delete('childEditData');
        if(!empty($childEditData)){
            $this->data = $childEditData;
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

            if(empty($this->data)){
                $this->cakeError('error404');
            }

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
                //$this->redirect('/children/edit');
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

    function edit_menu(){
        //子供数取得（リンク表示有無情報）
        $userData = $this->Auth->user();
        $childData = $this->Child->find('all',array('conditions'=>array('user_id'=>$userData['User']['id'])));
        $this->set(compact('childData'));
    }

    function user_menu(){
    }
    
    function delete() {

        pr ($this->data);

        if(!empty($this->data)){
            $this->Session->write('check',$this->data);
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
        $this->Child->contain();
        $this->data = $this->Child->read(null, $lastChildId);

    }

    function delete_complete(){
        $check = $this->Session->read('check');
        $this->Session->delete('check');
        if(empty($check)){
            $this->cakeError('error404');
            return;
        }

        //子供データ存在確認
        $conditions = array();
        $userData = $this->Auth->user();
        $conditions['Child.id'] = $check['Child']['check'];
        $conditions['Child.user_id'] = $userData['User']['id'];
        
        $this->Child->contain('Diary','ChildPresent');
        $childData = $this->Child->find('first', array('conditions' => $conditions));

        if(empty($childData)){
            $this->cakeError('error404');
            return;
        }

        //削除用の配列作成
        $deleteCondition = array("id" => $childData['Child']['id']);
        //子供IDに紐付く子供情報、思い出情報、獲得プレゼント情報を削除
        TransactionManager::begin();
        try {
            $this->Child->contain('Diary','ChildPresent');
            if ($this->Child->deleteAll($deleteCondition)) {
                TransactionManager::commit();
                $this->Session->setFlash(__('削除完了。', true));
            } else {
                TransactionManager::rollback();
                $this->Session->setFlash(__('削除失敗。', true));
            }
        } catch(Exception $e) {
          TransactionManager::rollback();
          $this->Session->setFlash(__('システムエラー。', true));
          $this->redirect('/children/');
        }

        //思い出に紐付く画像を削除
        foreach($childData['Diary'] as $diary) {
            if($diary['has_image']) {
                if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_thumb'), $childData['Child']['id'],$diary['id']) )){
                    //$this->Session->setFlash(__('思い出画像の削除に失敗した可能性があります。', true));
                }
                if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_rect'), $childData['Child']['id'],$diary['id']) )){
                    //$this->Session->setFlash(__('思い出画像の削除に失敗した可能性があります。', true));
                }
            }
        }

        //最終子供IDを更新
        $childrenData = $this->_setChild();
        if (!empty($childrenData)){
            $updateId = $childrenData['0']['Child']['id'];
            $this->_saveLastChild($updateId);
        } else {
            $updateId = -1;
            $this->_saveLastChild($updateId);
        }

    }
}
?>
