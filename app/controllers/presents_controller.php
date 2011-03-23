<?php
class PresentsController extends AppController {

	var $name = 'Presents';

	var $components = array('Qdmail');

	function index($year = null, $month = null) {
		$opt = array();
		if ($year) {
			$opt['year'] = $year;
		}
		if ($month) {
			$opt['month'] = $month;
		}
		$presents = $this->Present->find('month', $opt);

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
		$data = $this->data;
		$this->paginate = array('limit' => 10);
		
		if ($data && isset($data['Present']['page'])) {
			$page = $data['Present']['page'];
			$pageCount = $data['Present']['pageCount'];

			$this->Session->write("Present.{$page}.selection", $data['select_photo']);

			$selection = array();
			if (isset($this->params['form']['create'])) {
				for($i = 1; $i < $pageCount + 1; $i++) {
					$sel = $this->Session->read("Present.{$i}.selection");
					foreach($sel as $key => $value) {
						if ($value == 1) {
							$selection[] = $key;
						}
					}
				}
				if (count($selection) == 4) {
					$this->Session->write('Present.data', $data['Present']);
					$this->Session->write('Present.data.selection', $selection);
					$this->redirect("/presents/complete/{$type}/");
				} else {
					$this->Session->setFlash('選択数が不正です');
					//$this->redirect('/presents/error_photo');
				}
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
		$data = $this->Session->read('Present.data');

		$child_id = $this->Session->read('Auth.User.last_selected_child');
		$user_id = $this->Session->read('Auth.User.id');

		$selected = array(
			'diary_id' => $data['selection'],
			'present_id' => $data['template'],
			'child_id' => $child_id,
		);

		if ($type === "flash") {
			$this->CreatePresent->createFlash($selected);
			$this->render('complete_flash');
		} else {
			$this->CreatePresent->createPostcard($selected);
			$this->render('complete_postcard');
		}

        //メールアドレス設定
        $mailStr = 'diary_'.$user_id.'.'.$child_id.'.'.$id.'.'.$hash.'@shimajiro-dev.com';

		$path = '';
		$token = '';

		$this->set(compact('mailStr', 'token', 'path'));
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

		$this->set(compact('token'));
	}
}
?>
