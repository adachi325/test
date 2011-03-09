
<?php

class ChildrenController extends AppController {

    var $name = 'Children';

    function beforeFilter() {
        
    }

    function index() {
        $this->Child->recursive = 0;
        $this->set('children', $this->paginate());
        $this->_setChild();
        $this->_getLastChild();
    }

    //最終子供情報取得
    function _getLastChild(){
        $userData = $this->Auth->user();
        $User = ClassRegistry::init('User');
        $User = $User->find('first', array('conditions'=>array('id'=>$userData['User']['id'])));
        $this->set('lastChildId', $User['User']['last_selected_child']);
    }

    //子供情報取得
    function _setChild(){
        $userData = $this->Auth->user();
        $childData = $this->Child->find('all', array('conditions'=>array('user_id'=>$userData['User']['id'])));
        $this->set('children', $childData);
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
            $userData = $this->Auth->user();
            $request['Child']['user_id'] = $userData['User']['id'];
            $this->data = $request;
            if ($this->Child->saveAll($this->data, array('validate'=>'only'))) {
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

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Child', true));
            $this->redirect('/children/index');
        }
        if (!empty($this->data)) {
            if ($this->Child->save($this->data)) {
                $this->Session->setFlash(__('The Child has been saved', true));
                $this->redirect('/children/index');
            } else {
                $this->Session->setFlash(__('The Child could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Child->read(null, $id);
        }
        $users = $this->Child->User->find('list');
        $lines = $this->Child->Line->find('list');
        $this->set(compact('users','lines'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Child', true));
            $this->redirect('/children/index');
        }
        if ($this->Child->del($id)) {
            $this->Session->setFlash(__('Child deleted', true));
            $this->redirect('/children/index');
        }
        $this->Session->setFlash(__('The Child could not be deleted. Please, try again.', true));
        $this->redirect('/children/index');
    }
}
?>