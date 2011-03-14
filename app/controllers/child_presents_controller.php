<?php
class ChildPresentsController extends AppController {

	var $name = 'ChildPresents';

	function index() {
		$this->ChildPresent->recursive = 0;
		$this->set('childPresents', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid child present', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('childPresent', $this->ChildPresent->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ChildPresent->create();
			if ($this->ChildPresent->save($this->data)) {
				$this->Session->setFlash(__('The child present has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The child present could not be saved. Please, try again.', true));
			}
		}
		$children = $this->ChildPresent->Child->find('list');
		$presents = $this->ChildPresent->Present->find('list');
		$themes = $this->ChildPresent->Theme->find('list');
		$this->set(compact('children', 'presents', 'themes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid child present', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ChildPresent->save($this->data)) {
				$this->Session->setFlash(__('The child present has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The child present could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ChildPresent->read(null, $id);
		}
		$children = $this->ChildPresent->Child->find('list');
		$presents = $this->ChildPresent->Present->find('list');
		$themes = $this->ChildPresent->Theme->find('list');
		$this->set(compact('children', 'presents', 'themes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for child present', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ChildPresent->delete($id)) {
			$this->Session->setFlash(__('Child present deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Child present was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>