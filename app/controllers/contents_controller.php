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
			$Issue =& ClassRegistry::init('Issue');
			$issues = $Issue->find('released', array('line' => $line));
		}
		
		$this->set(compact('issues', 'title'));
	}


	function view() {

		extract($this->params);

		if(!isset($line) || !isset($id)) {
			$this->redirect(array('action' => 'index'));
		}

		$data = $this->Content->isReleased($line, $id);

		if ($data === false) {
			$this->cakeError('error404');
			return;
		}

		$release_date = $data['Content']['release_date'];

		$this->set(compact('release_date'));

		if ($release_date <= date('Y-m-d')) {
			// Todo: キャリアごとに表示するテンプレートを振り分ける?
			$this->set('filepath', WWW_ROOT."ap/{$line}/{$id}/body.html");
			//$this->set('filepath', WWW_ROOT."ap/{$line}/{$id}/docomo.html");
			//$this->set('filepath', WWW_ROOT."ap/{$line}/{$id}/softbank.html");
			//$this->set('filepath', WWW_ROOT."ap/{$line}/{$id}/au.html");

			$this->layout = 'contents';
		} else {
			$this->render("error");	
		}
	}

}
?>
