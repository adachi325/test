<?php
class MonthsController extends AppController {

	var $name = 'Months';

	function index() {
		$this->Month->recursive = 0;
		$this->set('months', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid month', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('month', $this->Month->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Month->create();
			if ($this->Month->save($this->data)) {
				$this->Session->setFlash(__('The month has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The month could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid month', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Month->save($this->data)) {
				$this->Session->setFlash(__('The month has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The month could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Month->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for month', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Month->delete($id)) {
			$this->Session->setFlash(__('Month deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Month was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>