<?php
class PresentsController extends AppController {

	var $name = 'Presents';

	function index() {
		$this->Present->recursive = 0;
		$this->set('presents', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid present', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('present', $this->Present->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Present->create();
			if ($this->Present->save($this->data)) {
				$this->Session->setFlash(__('The present has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The present could not be saved. Please, try again.', true));
			}
		}
		$themes = $this->Present->Theme->find('list');
		$children = $this->Present->Child->find('list');
		$this->set(compact('themes', 'children'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid present', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Present->save($this->data)) {
				$this->Session->setFlash(__('The present has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The present could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Present->read(null, $id);
		}
		$themes = $this->Present->Theme->find('list');
		$children = $this->Present->Child->find('list');
		$this->set(compact('themes', 'children'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for present', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Present->delete($id)) {
			$this->Session->setFlash(__('Present deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Present was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>