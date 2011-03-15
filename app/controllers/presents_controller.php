<?php
class PresentsController extends AppController {

	var $name = 'Presents';

	function index() {
		$month = $this->Present->find('month');
		$this->set(compact('month'));
	}

	function present_list($type = null) {

		$child_id = $this->Session->read('Auth.User.last_selected_child');

		$paging_items = $this->paginate();

		if ($type === null) {
			$this->Session->setFlash('プレゼントの種類を指定してください');
			$this->redirect(array('action' => 'index'));
		} else {
			if ($type >= 0) {
				// Todo: paginateの組み込み
				$items = $this->Present->find('type', compact('child_id', 'type'));
				$this->set(compact('items', 'pagind_items'));
				
				$this->render("present_list_{$type}");		
			} else {
				// 会員限定コンテンツ
				$this->render("present_list_member");
			}
		}
	}

	function select($type = null) {
		$this->Present->contain();
		$this->set($this->paginate());
		
		if ($type == "flash") {

		} else {

		}
	}

	function complete($type = null) {
		if ($type == "flash") {

		} else {

		}
	}

	function error_present() {
		
	}

	function error_photo() {

	}

	function print_photo() {
		
	}
}
?>
