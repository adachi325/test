<?php
class PresentsController extends AppController {

	var $name = 'Presents';

	var $components = array('Qdmail');

	function index($year = null, $month = null) {
		$presents = $this->Present->find('month');
		$this->set(compact('presents', 'year', 'month'));
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
				$items = $this->paginate('Present', $cond, array('limit' => 10));
				
				$this->set(compact('items'));
				
				$this->render("present_list_{$type}");		
			} else {
				// 会員限定コンテンツ
				$this->render("present_list_member");
			}
		}
	}

	function select($type = null, $template_id = null) {
		pr($this->paginate);
		pr($this->data);

		$data = $this->data;
		if ($data && isset($data['Present']['page'])) {
			$page = $data['Present']['page'];
			$pageCount = $data['Present']['pageCount'];

			$this->Session->write("Present.{$page}.selection", $data['Present']);

			if (isset($this->params['form']['create'])) {
				$this->redirect("/presents/complete/{$type}/");
			}
			if (isset($this->params['form']['prev'])) {
				$page--;
				if ($page < 1) {
					$page = 1;
				}
			}
			if (isset($this->params['form']['next'])) {
				$page++;
				if ($page > $pageCount) {
					$page = $pageCount;
				}
			}
			$this->paginate['page'] = $page;
		}

		$this->Diary =& ClassRegistry::init('Diary');
		$this->Diary->contain();
		
		//$items = $this->paginate('Diary', array('Dialy.has_image' => 1));
		$items = $this->paginate('Diary');
		
		$this->set(compact('items', 'data', 'type', 'template_id'));
	}

	function complete($type = null) {
		$selected = array(
			'diary_id' => array(1, 2, 3, 4),
			'present_id' => 1,
			'child_id' => 1,
		);

		

		if ($type === "flash") {
			$this->CreatePresent->createPostcard($selected);
			$this->render('complete_flash');
		} else {
			$this->CreatePresent->createFlash($selected);
			$this->render('complete_postcard');
		}

        //メールアドレス設定
        $mailStr = 'diary_'.$userdata['User']['id'].'.'.$userdata['User']['last_selected_child'].'.'.$id.'.'.$hash.'@shimajiro-dev.com';
        $this->set('mailStr',$mailStr);

	}

	function error_present() {
		
	}

	function error_photo() {
		
	}

	function print_postcard($token = null) {
		if ($token === null) {
			$this->cakeError('error404');
			return;
		}

		$PostcardUrl =& ClassRegistry::init('PostcardUrl');
		if (!$PostcardUrl->isValiable($token)) {
			$this->cakeError('error404');
		}

		$this->set(compact($token));
	}
}
?>
