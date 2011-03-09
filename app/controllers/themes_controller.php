<?php

class ThemesController extends KtaiAppController {

	var $name = 'Themes';

	function index() {
		$this->Theme->recursive = 0;
		$this->set('themes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Theme', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('theme', $this->Theme->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Theme->create();
			if ($this->Theme->save($this->data)) {
				$this->Session->setFlash(__('The Theme has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Theme could not be saved. Please, try again.', true));
			}
		}
		$issues = $this->Theme->Issue->find('list');
		$this->set(compact('issues'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Theme', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Theme->save($this->data)) {
				$this->Session->setFlash(__('The Theme has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Theme could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Theme->read(null, $id);
		}
		$issues = $this->Theme->Issue->find('list');
		$this->set(compact('issues'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Theme', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Theme->del($id)) {
			$this->Session->setFlash(__('Theme deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Theme could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>