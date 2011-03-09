<?php

class ContentsController extends AppController {

	var $name = 'Contents';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Content->recursive = 0;
		$this->set('contents', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Content', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('content', $this->Content->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Content->create();
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash(__('The Content has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Content could not be saved. Please, try again.', true));
			}
		}
		$lines = $this->Content->Line->find('list');
		$issues = $this->Content->Issue->find('list');
		$this->set(compact('lines', 'issues'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Content', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash(__('The Content has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Content could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Content->read(null, $id);
		}
		$lines = $this->Content->Line->find('list');
		$issues = $this->Content->Issue->find('list');
		$this->set(compact('lines','issues'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Content', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Content->del($id)) {
			$this->Session->setFlash(__('Content deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Content could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>