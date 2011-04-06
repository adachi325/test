<?php

class NewsController extends AppController {

	var $name = 'News';
	var $helpers = array('Wikiformat.Wikiformat');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('prev','rule','register');
	}

	function index(){
		$this->cakeError('error404');
		return;
	}

	function info($id = null) {
		if(empty($id)){
			$this->cakeError('error404');
			return;
		}

		//最終子供情報取得
		$this->data = $this->News->findById($id);

		if(empty($this->data)){
			$this->cakeError('error404');
			return;
		}
	}
}
?>
