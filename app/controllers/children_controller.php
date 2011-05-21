<?php

class ChildrenController extends AppController {

    var $name = 'Children';
	var $helpers = array('Wikiformat.Wikiformat');

 	function beforeFilter() {
    parent::beforeFilter();
		$this->Auth->allow('display');
		if ($this->Ktai->is_android()) {
			$this->layout = 'android';
			$this->view_prefix = 'android_';
		}
  }
    
	function display() {
		if ($this->Ktai->is_android()) {
			$this->render('/pages/android_top');
			return;
		}

		//ログイン済みならマイページへ遷移
		if($this->Auth->user()) {
			$this->set('login_user',$this->Auth->user());
			//$this->redirect('/children/');
			$this->_getChilddata();
			$this->render('index');
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
					$this->_getChilddata();
					$this->render('index');
					return;
				}
			}
		}

		//ニュース取得
		$news =& ClassRegistry::init('news');
		$newslist = $news->find('all',array('conditions' =>
			array('start_at <= "'.date('Y-m-d H:i:s').'"','finish_at >= "'.date('Y-m-d H:i:s').'"' )));

		$this->set(compact('newslist'));
	}

	function index($id = null) {
		$this->_getChilddata($id);
    }

	function _getChilddata($id = null) {
        //子供データ一覧設定
        $childrenData = $this->_setChild();

        //最終子供ID更新
        if ($id !== null &&
            $id >= 0 && $id < count($childrenData)) {

            $updateId = $childrenData[$id]['Child']['id'];
            $this->_saveLastChild($updateId);
        }

        //最終子供ID設定
        $lastChildId = $this->Tk->_getLastChild();
        if ($lastChildId == 0) {
                if (count($childrenData)) {
                        $lastChildId = $childrenData[0]['Child']['id'];
                        $updateId = $lastChildId;
                        $this->_saveLastChild($updateId);
                }
        }
		//最終子供情報取得
		$Child =& ClassRegistry::init('Child');
		
        $currentChild = $Child->findById($lastChildId);

        //月号データ取得
        $content =& ClassRegistry::init('Content');

        //babyの場合降順にする
        $sortStr = 'DESC';
        if($currentChild['Child']['line_id'] == '1'){
            $sortStr = 'ASC';
        }

        $conditions = array(
                'conditions' => array(
                    'Content.line_id' => $currentChild['Child']['line_id'],
                ),
                'order'=>array('Content.release_date '.$sortStr)
            );
        $content->contain('Issue');
        $contents = $content->find('all', $conditions);

        //月データ取得
        $month =& ClassRegistry::init('month');
        $options = array();
        $options['year'] = date('Y');
        $options['month'] = date('m') + 0;
        $months = $month->find('all', array('conditions' => $options));

        //テーマ要素作成日順に入れ替える
        $result = array_reverse($months['0']['Theme']);
        $months['0']['Theme'] = $result;

        //ライン情報取得
        $lines = $Child->Line->find('list');
        $currentLine = $Child->Line->findById($currentChild['Child']['line_id']);

        if(!empty($months)){
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->Tk->_getLastChild(),
                    'Diary.month_id' => $months['0']['month']['id'],
                    'Diary.has_image' => 1,
                    'Diary.error_code' => null
                ),
                'order'=>array('Diary.created DESC')
            );
            //表示データ一覧取得
            $diary =& ClassRegistry::init('diary');
            $diaries = $diary->find('all', $conditions);
		}

		$conditions = array(
			'conditions' => array(
				'Diary.child_id' => $this->Tk->_getLastChild(),
				'Diary.has_image' => 1,
				'Diary.error_code' => null
			),
            'order'=>array('Diary.created DESC')
		);
		$prof_diary = $diary->find('first', $conditions);

        //ニュース取得
        $news =& ClassRegistry::init('news');
		$newslist = $news->find('all',array(
			'conditions' => array('start_at <= "'.date('Y-m-d H:i:s').'"','finish_at >= "'.date('Y-m-d H:i:s').'"' ),
			'order' => array('start_at DESC'),
		));

        $this->set(compact('user','childrenData','lastChildId','currentChild','contents','months','lines','currentLine','diaries','prof_diary', 'newslist'));
        if (count($childrenData) == 0) {
            $this->render('index_nochild');
        }

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
            $this->cakeError('error404');
            return;
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

					//メール投稿用のハッシュコードを追加
					$this->Child->save_hashcode($this->Child->getLastInsertId());

                    TransactionManager::commit();
                } else {
                    TransactionManager::rollback();
                    $this->cakeError('error404');
                    $this->log('子供登録に失敗01:'.$this->Child->getLastInsertId().':'.date('Y-m-d h:n:s'),LOG_DEBUG);
                    return;
                }
            } catch(Exception $e) {
                TransactionManager::rollback();
                $this->cakeError('error404');
                $this->log('子供登録に失敗02:'.$this->Child->getLastInsertId().':'.date('Y-m-d h:n:s'),LOG_DEBUG);
                $this->log($e.':'.date('Y-m-d h:n:s'),LOG_DEBUG);
                return;
            }
        } else {
            $this->cakeError('error404');
            $this->log('不正操作03:'.$this->Child->getLastInsertId().':'.date('Y-m-d h:n:s'),LOG_DEBUG);
            return;
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
            $lastChildId = $this->Tk->_getLastChild();

            //子供情報取得
            $this->data = $this->Child->read(null, $lastChildId);

            if(empty($this->data)){
                $this->cakeError('error404');
                return;
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
            $request['Child']['id'] = $this->Tk->_getLastChild();
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
        } else {
            $this->redirect('/children/index');
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
                } else {
                    TransactionManager::rollback();
                    $this->cakeError('error404');
                    $this->log('子供情報更新に失敗01:'.$this->Child->getLastInsertId().':'.date('Y-m-d h:n:s'),LOG_DEBUG);
                    return;
                }
            } catch(Exception $e) {
                TransactionManager::rollback();
                $this->cakeError('error404');
                $this->log('子供情報更新に失敗02:'.$this->Child->getLastInsertId().':'.date('Y-m-d h:n:s'),LOG_DEBUG);
                $this->log($e.':'.date('Y-m-d h:n:s'),LOG_DEBUG);
                return;
            }
        } else {
            $this->cakeError('error404');
            $this->log('子供情報更新に失敗03:'.date('Y-m-d h:n:s'),LOG_DEBUG);
            return;
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

        if(!empty($this->data)){
            $this->Session->write('check',$this->data);
            $this->redirect('/children/delete_complete');
        }

        $childrenData = $this->_setChild();
        //削除する子供がいなければ不正操作
        if (empty($childrenData)){
            $this->cakeError('error404');
            return;
        }
        //最終子供ID設定
        $lastChildId = $this->Tk->_getLastChild();
        //最終子供IDの子供がいなければ不正操作
        if (empty($lastChildId)){
            $this->cakeError('error404');
            return;
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
            } else {
                TransactionManager::rollback();
                $this->log('子供削除に失敗01:'.date('Y-m-d h:n:s'),LOG_DEBUG);
                $this->cakeError('error404');
                return;
            }
        } catch(Exception $e) {
          TransactionManager::rollback();
          $this->log('子供削除に失敗02:'.date('Y-m-d h:n:s'),LOG_DEBUG);
          $this->cakeError('error404');
          return;
        }

        //思い出に紐付く画像を削除
        foreach($childData['Diary'] as $diary) {
            if($diary['has_image']) {
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

        //最終子供IDを更新
        $childrenData = $this->_setChild();
        if (!empty($childrenData)){
            $updateId = $childrenData['0']['Child']['id'];
            $this->_saveLastChild($updateId);
        } else {
            $updateId = -1;
            $this->_saveLastChild($updateId);
        }

        $this->redirect('/children/');

    }
}
?>
