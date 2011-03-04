<?php

//ktaiライブラリインポート
App::import('Controller', 'KtaiApp');

class LinesController extends KtaiAppController {

	var $name = 'Lines';
	var $helpers = array('Html', 'Form');

	public $components = array('Auth');
	function beforeFilter(){
		$this->Auth->authError= 'ログインしてください';
	}

	function index() {
		$this->Line->recursive = 0;
		$this->set('lines', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Line', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('line', $this->Line->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Line->create();
			if ($this->Line->save($this->data)) {
				$this->Session->setFlash(__('The Line has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Line could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Line', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Line->save($this->data)) {
				$this->Session->setFlash(__('The Line has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Line could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Line->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Line', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Line->del($id)) {
			$this->Session->setFlash(__('Line deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Line could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>