<?php
class PresentsController extends AppController {

	var $name = 'Presents';

	function index() {
		$month = $this->Present->find('month');
		$this->set(compact('month'));
	}

	function present_list($type = null) {

		$child_id = $this->Session->read('Auth.User.last_selected_child');

		if ($type === null) {
			$this->Session->setFlash('プレゼントの種類を指定してください');
			$this->redirect(array('action' => 'index'));
		} else {
			if ($type >= 0) {

				$cond = array('Present.present_type' => $type);
		
				if ($child_id) {
					$ChildPresent =& ClassRegistry::init('ChildPresent');
					$ChildPresent->contain();
					$present_ids = $ChildPresent->find('all', array(
						'fields' => array('id', 'present_id'), 
						'conditions' => array('child_id' => $child_id),
					));
					
					if (is_array($present_ids)) {
						$cond["Present.id"] = Set::combine($present_ids, '{n}.ChildPresent.id', '{n}.ChildPresent.present_id');
					}
				}

				$this->Present->contain(array('Month'));
				$items = $this->paginate('Present', $cond, array('limit' => 4));
				
				$this->set(compact('items'));
				
				$this->render("present_list_{$type}");		
			} else {
				// 会員限定コンテンツ
				$this->render("present_list_member");
			}
		}
	}

	function select($type = null) {

		$data = $this->data;
		if ($data && isset($data['page'])) {
			if (isset($this->params['form']['create'])) {
				$this->redirect('complete');
			}
			if (isset($this->params['form']['prev'])) {
				$data['page']--;
			}
			if (isset($this->params['form']['next'])) {
				$data['page']++;
			}
		}

		$this->Diary =& ClassRegistry::init('Diary');
		$this->Diary->contain();
		
		//$items = $this->paginate('Diary', array('Dialy.has_image' => 1));
		$items = $this->paginate('Diary');

		$this->set(compact('items', 'data'));
	}

	function complete($type = null) {
	
	}

	function error_present() {
		
	}

	function error_photo() {

	}

	function print_photo() {
		
	}
}
?>
