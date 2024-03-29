<?php
class ContentsController extends AppController {

	var $name = 'Contents';
	var $helpers = array('Time');

	function beforeFilter()
	{
		$this->Auth->allow('*');
		parent::beforeFilter();
	}

	function index($line = null) {

		extract($this->params);	

		$title = 'baby/ぷちファースト教材';

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
	}


	function view() {

		extract($this->params);

		if(!isset($line) || !isset($id)) {
			$this->redirect(array('action' => 'index'));
		}

		$data = $this->Content->isReleased($line, $id);

		$this->ktai['enable_ktai_session'] = false;

		if ($data === false) {
			$this->cakeError('error404');
			return;
		}

		$release_date = $data['Content']['release_date'];

		if ($release_date <= date('Y-m-d')) {
			$filepath = WWW_ROOT."ap/{$line}/{$id}/index.html";
			if (!file_exists($filepath)) {
				$this->cakeError('error404');
			}
			
			// auかsoftbankだった場合、独自テンプレートがあればそちらを使用する
			$_path = '';
			if ($this->Ktai->is_softbank()) {
				$_path = WWW_ROOT."ap/{$line}/{$id}/index.softbank.html";
			} elseif ($this->Ktai->is_ezweb()) {
				$_path = WWW_ROOT."ap/{$line}/{$id}/index.au.html";
			} elseif ($this->Ktai->is_android()) {
				$_path = WWW_ROOT."ap/{$line}/{$id}/index.android.html";
			}
			if (file_exists($_path)) {
				$filepath = $_path;
			}
			
			$this->set(compact('release_date', 'filepath'));
			$this->layout = 'contents';
		} else {
			$this->set(compact('release_date'));
			$this->render("error");	
		}
	}

}
?>
