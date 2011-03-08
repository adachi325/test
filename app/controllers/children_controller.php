
<?php

//ktaiライブラリインポート
App::import('Controller', 'KtaiApp');

class ChildrenController extends KtaiAppController {

	var $name = 'Children';

	function index() {
            $this->Child->recursive = 0;
            $this->set('children', $this->paginate());
            $this->setChild();
	}
        
        //子供情報取得
        function setChild(){
            $userData = $this->Auth->user();
            $childData = $this->Child->find('all',array('conditions'=>array('user_id'=>$userData['User']['id'])));
            $this->set('children', $childData);
        }

        function view($id = null) {
            if (!$id) {
                    $this->Session->setFlash(__('Invalid Child', true));
                    $this->redirect('children/index');
            }
            $this->set('child', $this->Child->read(null, $id));
	}

	function register() {
            
            $userData = $this->Auth->user();
            //子供が３人以上存在する場合は、エラーを返す。
            $childData = $this->Child->find('all',array('conditions'=>array('user_id'=>$userData['User']['id'])));
            if( count($childData) > 2) {
                    $this->Session->setFlash(__('子供は３人以上登録できません。', true));
                    $this->redirect('/children/index');
            }
            
            if (!empty($this->data)) {
                    $request = array();
                    $request = $this->data;
                    $request['Child']['user_id'] = $userData['User']['id'];
                    $this->data = $request;

                    $this->Child->create();
                    if ($this->Child->save($this->data)) {
                            $this->Session->setFlash(__('The Child has been saved', true));
                            $this->redirect('/children/index');
                    } else {
                            $this->Session->setFlash(__('The Child could not be saved. Please, try again.', true));
                    }
            }
            $users = $this->Child->User->find('list');
            $lines = $this->Child->Line->find('list');
            $this->set(compact('users', 'lines'));
	}

	function edit($id = null) {
            if (!$id && empty($this->data)) {
                    $this->Session->setFlash(__('Invalid Child', true));
                    $this->redirect('children/index');
            }
            if (!empty($this->data)) {
                    if ($this->Child->save($this->data)) {
                            $this->Session->setFlash(__('The Child has been saved', true));
                            $this->redirect('children/index');
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
                    $this->redirect('children/index');
            }
            if ($this->Child->del($id)) {
                    $this->Session->setFlash(__('Child deleted', true));
                    $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The Child could not be deleted. Please, try again.', true));
            $this->redirect('children/index');
	}

}
?>