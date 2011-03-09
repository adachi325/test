<?php
class ContentsController extends AppController {

	var $name = 'Contents';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Content->recursive = 0;
		$this->set('contents', $this->paginate());
	}

	function view() {

		extract($this->params);

		if ($id == '1006') {
			//Configure::write('debug', 0);
			//$this->set('filepath', "ap/{$line}/{$id}/index.html");
			$this->set('filepath', WWW_ROOT."ap/{$line}/{$id}/index.ctp");
			$this->layout = null;
			$this->render('media');
		} else {
			$this->cakeError('error404');
		}
	}

}
?>
