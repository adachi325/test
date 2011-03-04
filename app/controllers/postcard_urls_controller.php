<?php

//ktaiライブラリインポート
App::import('Controller', 'KtaiApp');

class PostcardUrlsController extends KtaiAppController {

	var $name = 'PostcardUrls';
	var $helpers = array('Html', 'Form');

	public $components = array('Auth');
	function beforeFilter(){
		$this->Auth->authError= 'ログインしてください';
	}

	function index() {
		$this->PostcardUrl->recursive = 0;
		$this->set('postcardUrls', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid PostcardUrl', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('postcardUrl', $this->PostcardUrl->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PostcardUrl->create();
			if ($this->PostcardUrl->save($this->data)) {
				$this->Session->setFlash(__('The PostcardUrl has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The PostcardUrl could not be saved. Please, try again.', true));
			}
		}
		$children = $this->PostcardUrl->Child->find('list');
		$this->set(compact('children'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid PostcardUrl', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PostcardUrl->save($this->data)) {
				$this->Session->setFlash(__('The PostcardUrl has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The PostcardUrl could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PostcardUrl->read(null, $id);
		}
		$children = $this->PostcardUrl->Child->find('list');
		$this->set(compact('children'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for PostcardUrl', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->PostcardUrl->del($id)) {
			$this->Session->setFlash(__('PostcardUrl deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The PostcardUrl could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>