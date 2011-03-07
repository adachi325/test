
<?php

//ktaiライブラリインポート
App::import('Controller', 'KtaiApp');

class ChildrenController extends KtaiAppController {

	var $name = 'Children';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Child->recursive = 0;
		$this->set('children', $this->paginate());
                $this->setChild();
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Child', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('child', $this->Child->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Child->create();
			if ($this->Child->save($this->data)) {
				$this->Session->setFlash(__('The Child has been saved', true));
				$this->redirect(array('action' => 'index'));
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
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Child->save($this->data)) {
				$this->Session->setFlash(__('The Child has been saved', true));
				$this->redirect(array('action' => 'index'));
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
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Child->del($id)) {
			$this->Session->setFlash(__('Child deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Child could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

        //会員ID取得
        function getUserId(){
            $Child = ClassRegistry::init('Child');
            $this->Auth->user();
        }

        //子供情報取得
        function setChild($userid){
                $Child = ClassRegistry::init('Child');
                $Child = $Child->find('list');
                $this->set('children', $Child);
        }

}
?>