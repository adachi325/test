<?php

class ChildPresentsController extends AppController {

	var $name = 'ChildPresents';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->ChildPresent->recursive = 0;
		$this->set('childPresents', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ChildPresent', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('childPresent', $this->ChildPresent->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ChildPresent->create();
			if ($this->ChildPresent->save($this->data)) {
				$this->Session->setFlash(__('The ChildPresent has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ChildPresent could not be saved. Please, try again.', true));
			}
		}
		$children = $this->ChildPresent->Child->find('list');
		$presents = $this->ChildPresent->Present->find('list');
		$this->set(compact('children', 'presents'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ChildPresent', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ChildPresent->save($this->data)) {
				$this->Session->setFlash(__('The ChildPresent has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ChildPresent could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ChildPresent->read(null, $id);
		}
		$children = $this->ChildPresent->Child->find('list');
		$presents = $this->ChildPresent->Present->find('list');
		$this->set(compact('children','presents'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ChildPresent', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->ChildPresent->del($id)) {
			$this->Session->setFlash(__('ChildPresent deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The ChildPresent could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>
