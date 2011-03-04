<?php

//ktaiライブラリインポート
App::import('Controller', 'KtaiApp');

class PresentsController extends KtaiAppController {

	var $name = 'Presents';
	var $helpers = array('Html', 'Form');

	public $components = array('Auth');
	function beforeFilter(){
		$this->Auth->authError= 'ログインしてください';
	}

	function index() {
		$this->Present->recursive = 0;
		$this->set('presents', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Present', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('present', $this->Present->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Present->create();
			if ($this->Present->save($this->data)) {
				$this->Session->setFlash(__('The Present has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Present could not be saved. Please, try again.', true));
			}
		}
		$children = $this->Present->Child->find('list');
		$issues = $this->Present->Issue->find('list');
		$this->set(compact('children', 'issues'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Present', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Present->save($this->data)) {
				$this->Session->setFlash(__('The Present has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Present could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Present->read(null, $id);
		}
		$children = $this->Present->Child->find('list');
		$issues = $this->Present->Issue->find('list');
		$this->set(compact('children','issues'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Present', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Present->del($id)) {
			$this->Session->setFlash(__('Present deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Present could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>