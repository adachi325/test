<?php

class DiariesController extends AppController {

	var $name = 'Diaries';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Diary->recursive = 0;
		$this->set('diaries', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Diary', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('diary', $this->Diary->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Diary->create();
			if ($this->Diary->save($this->data)) {
				$this->Session->setFlash(__('The Diary has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Diary could not be saved. Please, try again.', true));
			}
		}
		$children = $this->Diary->Child->find('list');
		$themes = $this->Diary->Theme->find('list');
		$this->set(compact('children', 'themes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Diary', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Diary->save($this->data)) {
				$this->Session->setFlash(__('The Diary has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Diary could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Diary->read(null, $id);
		}
		$children = $this->Diary->Child->find('list');
		$themes = $this->Diary->Theme->find('list');
		$this->set(compact('children','themes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Diary', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Diary->del($id)) {
			$this->Session->setFlash(__('Diary deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Diary could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>
