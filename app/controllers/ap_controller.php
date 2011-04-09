<?php
class ApController extends AppController {

	var $name = 'Ap';
	var $helpers = array('Time');
	var $uses = array();

	function beforeFilter()
	{
		$this->Auth->allow('*');
		parent::beforeFilter();
	}

	function baby($id = null) {
		if ($id) {
			$this->__view($this->params['action'], $id);
		} else {
			$this->__index($this->params['action']);
		}
	}

	function petit($id = null) {
		if ($id) {
			if ($id === 'index') {
				$this->__index($this->params['action']);
			} else {
				$this->__view($this->params['action'], $id);
			}
		} else {
			$this->render("petit");
		}
	}

	function pocket($id = null) {
		if ($id) {
			$this->__view($this->params['action'], $id);
		} else {
			$this->__index($this->params['action']);
		}
	}

	function hop($id = null) {
		if ($id) {
			$this->__view($this->params['action'], $id);
		} else {
			$this->__index($this->params['action']);
		}
	}

	function step($id = null) {
		if ($id) {
			$this->__view($this->params['action'], $id);
		} else {
			$this->__index($this->params['action']);
		}
	}
	
	function jump($id = null) {
		if ($id) {
			$this->__view($this->params['action'], $id);
		} else {
			$this->__index($this->params['action']);
		}
	}

	function member($id = null) {
		if ($id) {
			$this->__member_view($id);
		} else {
			$this->cakeError('error404');
		}
	}

	function __index($line = null) {

		extract($this->params);	

		$title = '';

		if (isset($line)) {
			
			$Line =& ClassRegistry::init('Line');
			
			$data = $Line->find('first', array(
				'conditions' => array('category_name' => $line),
				'fields' => array('title', 'category_name'),
			));

			if (!empty($data)) {
				$title = $data['Line']['title'];
			}

			$Issue =& ClassRegistry::init('Issue');
			$issues = $Issue->find('released', array('line' => $line));

			$lines = $Line->find('all', array(
				'fields' => array('title', 'category_name'),
			));
		}
		$this->set(compact('issues', 'title', 'lines'));
		$this->render('index');		
	}

	function __member_view($id = null) {

		if(empty($id)) {
			$this->cakeError('error404');
		}

		$this->ktai['enable_ktai_session'] = false;

		if ($this->Ktai->is_imode()) {
			$filepath = WWW_ROOT."ap/member/{$id}/index.html";
		} elseif ($this->Ktai->is_softbank()) {
			$filepath = WWW_ROOT."ap/member/{$id}/index.softbank.html";
		} elseif ($this->Ktai->is_ezweb()) {
			$filepath = WWW_ROOT."ap/member/{$id}/index.au.html";
		}
		
		$this->set(compact('filepath'));
		$this->layout = 'contents';
		$this->render("view");
	}

	function __view($line = null, $id = null) {

		//extract($this->params);

		if(empty($line) || empty($id)) {
			$this->redirect(array('action' => 'index'));
		}

		$this->Content =& ClassRegistry::init('Content');
		
		$data = $this->Content->isReleased($line, $id);

		$this->ktai['enable_ktai_session'] = false;

		if ($data === false) {
			$this->cakeError('error404');
			return;
		}

		$release_date = $data['Content']['release_date'];

		if ($release_date <= date('Y-m-d')) {
			$filepath = WWW_ROOT."ap/{$line}/{$id}/index.html";

			if ($this->Ktai->is_softbank()) {
				$_path = WWW_ROOT."ap/{$line}/{$id}/index.softbank.html";
			} elseif ($this->Ktai->is_ezweb()) {
				$_path = WWW_ROOT."ap/{$line}/{$id}/index.au.html";
			} elseif ($this->Ktai->is_android()) {
				$_path = WWW_ROOT."ap/{$line}/{$id}/index.android.html";
				if (!file_exists($_path)) {
					$this->render('android');
					return;
				}
			}

			if (isset($_path) && file_exists($_path)) {
				$filepath = $_path;
			}
			
			$this->set(compact('release_date', 'filepath'));
			$this->layout = 'contents';
			$this->render("view");
		} else {
			$this->set(compact('release_date'));
			$this->render("error");	
		}
	}

}
?>
