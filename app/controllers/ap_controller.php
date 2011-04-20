<?php
class ApController extends AppController {

	var $name = 'Ap';
	var $helpers = array('Time');
	var $uses = array();

	var $allow_android = true;

	function beforeFilter()
	{
		$this->EasyLogin->login();
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

		if ($this->Ktai->is_android()) {
			$this->redirect('/');
		}

		extract($this->params);	

		$title = '';

		if (isset($line)) {
			
			$Line =& ClassRegistry::init('Line');

			$opt = array(
				'conditions' => array('category_name' => $line),
				'fields' => array('title', 'category_name'),
			);

			if ($line != "baby") {
				$opt['order'] = 'created DESC';
			}

			$data = $Line->find('first', $opt);

			if (!empty($data)) {
				$title = $data['Line']['title'];
			}

			$Issue =& ClassRegistry::init('Issue');
			$issues = $Issue->find('released', array('line' => $line));

			$lines = $Line->find('all', array(
				'fields' => array('title', 'category_name'),
			));
		}

		$this->set(compact('issues', 'title', 'lines', 'line'));
		$this->render('index');
	}

	function __member_view($id = null) {

		if(empty($id)) {
			$this->cakeError('error404');
		}

		if ($this->Ktai->is_android()) {
			$this->redirect('/pages/android/');
		}

		$this->ktai['enable_ktai_session'] = false;

	  $filepath = WWW_ROOT."ap/member/{$id}/index.html";
		if ($this->Ktai->is_softbank()) {
			$_path = WWW_ROOT."ap/member/{$id}/index.softbank.html";
		} elseif ($this->Ktai->is_ezweb()) {
			$_path = WWW_ROOT."ap/member/{$id}/index.au.html";
		}

    if (isset($_path) && file_exists($_path)) {
      $filepath = $_path;
    }
		
		$this->set(compact('filepath'));
		$this->layout = 'contents';
		$this->render("view");
	}

	function __view($line = null, $id = null) {

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

		if ($release_date <= date('Y-m-d H:i:s')) {
			$filepath = WWW_ROOT."ap/{$line}/{$id}/index.html";

			$this->layout = 'contents';
			if ($this->Ktai->is_softbank()) {
				$_path = WWW_ROOT."ap/{$line}/{$id}/index.softbank.html";
			} elseif ($this->Ktai->is_ezweb()) {
				$_path = WWW_ROOT."ap/{$line}/{$id}/index.au.html";
			} elseif ($this->Ktai->is_android()) {
				$_path = WWW_ROOT."ap/{$line}/{$id}/index.android.html";
				if (!file_exists($_path)) {
					$this->layout = null;
					$this->render('android');
					return;
        } else {
			    $this->layout = 'contents_android';
        }
			}

			if (isset($_path) && file_exists($_path)) {
				$filepath = $_path;
			}
			
			$this->set(compact('release_date', 'filepath'));
			$this->render("view");
		} else {
			$this->set(compact('release_date'));
			if ($this->Ktai->is_android()) {
				$this->layout = null;
				$this->render("android_error");	
			} else {
				$this->render("error");	
			}
		}
	}

}
?>
