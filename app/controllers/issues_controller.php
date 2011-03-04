
<?php

//ktaiライブラリインポート
App::import('Controller', 'KtaiApp');

class IssuesController extends KtaiAppController {

	var $name = 'Issues';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Issue->recursive = 0;
		$this->set('issues', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Issue', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('issue', $this->Issue->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Issue->create();
			if ($this->Issue->save($this->data)) {
				$this->Session->setFlash(__('The Issue has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Issue could not be saved. Please, try again.', true));
			}
		}
		$lines = $this->Issue->Line->find('list');
		$this->set(compact('lines'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Issue', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Issue->save($this->data)) {
				$this->Session->setFlash(__('The Issue has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Issue could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Issue->read(null, $id);
		}
		$lines = $this->Issue->Line->find('list');
		$this->set(compact('lines'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Issue', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Issue->del($id)) {
			$this->Session->setFlash(__('Issue deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Issue could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>