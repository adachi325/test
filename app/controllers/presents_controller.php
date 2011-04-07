<?php
class PresentsController extends AppController {

	var $name = 'Presents';

	var $components = array('Qdmail');

	function index($year = null, $month = null) {

                if(empty($year)){
                    $year = date('Y');
                }
                if(empty($month)){
                    $month = date('m')+0;
                }

		$opt = array();
		if ($year) {
                    $opt['year'] = $year;
		}
		if ($month) {
                    $opt['month'] = $month;
		}

                //手入力防止（未来年月チェック）
                if ($year > date('Y') or 
                   ($year == date('Y') and $month > (date('m')+0))) {
                    //未来月のページを表示時リダイレクト
                    $this->redirect('/presents/');
                }

                //手入力防止（過去年月チェック）
                $monthModel =& ClassRegistry::init('month');
                $beforeOptions['order'] = array(
                    '(Month.year+0), (Month.month+0) ASC'
                );
                $monthModel->contain();
                $beforeFlag = $monthModel->find('first',$beforeOptions);
                if ($year < $beforeFlag['month']['year'] or
                   ($year == $beforeFlag['month']['year'] and $month < $beforeFlag['month']['month'])) {
                    //未来月のページを表示時リダイレクト
                    $this->redirect('/presents/');
                }
                $this->set('beforeFlag',$beforeFlag);

                $presents = $this->Present->find('month', $opt);
		$this->set(compact('presents', 'year', 'month'));
	}

	function present_list($type = null) {

		$child_id = $this->Tk->_getLastChild();

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

		if($type == 'flash') {
			$max_count = 3;
		} else {
			$max_count = 4;
		}

		if ($data && isset($data['Present']['page'])) {
			$page = $data['Present']['page'];
			$pageCount = $data['Present']['pageCount'];

			$this->Session->write("Present.{$page}.selection", $data['select_photo']);

			$selection = array();
			if (isset($this->params['form']['create'])) {
				for($i = 1; $i < $pageCount + 1; $i++) {
					$sel = $this->Session->read("Present.{$i}.selection");
					if (!is_array($sel)) {
						continue;
					}
					foreach($sel as $key => $value) {
						if ($value == 1) {
							$selection[] = $key;
						}
					}
				}
				if (count($selection) == $max_count) {
					$this->Session->write('Present.data', $data['Present']);
					$this->Session->write('Present.data.selection', $selection);
					$this->redirect("/presents/complete/{$type}/");
				} else {
					$this->Session->setFlash('選択数が不正です');
					$this->redirect("/presents/error_photo/{$type}/{$template_id}/");
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

		$cond = array(
			'child_id' => $this->Tk->_getLastChild(),
			'has_image' => 1,
		);

		//$items = $this->paginate('Diary', array('Dialy.has_image' => 1));
		$items = $this->paginate('Diary', $cond);
		
		$this->set(compact('items', 'data', 'type', 'template_id', 'max_count'));
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

		$render = "";

		if ($type === "flash") {
			$this->CreatePresent->createFlash($selected);
			$render = 'complete_flash';
		} else {
			$token = $this->CreatePresent->createPostcard($selected);
			if ($token === false) {
				$this->cakeError('error502');
				return;
			}
			$render = 'complete_postcard';
		}

		//メールアドレス設定
		$url = Router::url('/'.sprintf(Configure::read('Present.path.postcard_output'), $token), true);
		$mailSubject = "ポストカード印刷用URL";
                $mailBody = "{$url}%0D%0A※PCからアクセスし、ブラウザの印刷機能でプリントアウトしてください（ポストカードサイズに設定必要）%0D%0A※URLの有効期限は3日間です";

		$this->set(compact('mailSubject','mailBody','token'));
		$this->render($render);
	}

	function error_present() {
		
	}

	function error_photo($type = null, $template_id = null) {

		if($type == 'flash') {
			$max_count = 3;
		} else {
			$max_count = 4;
		}
		$this->set(compact('type', 'template_id', 'max_count'));
		
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
