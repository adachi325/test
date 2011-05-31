<?php

class NewsController extends AppController {

	var $name = 'News';
	var $helpers = array('Wikiformat.Wikiformat');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('prev','rule','register', 'get_news_count');
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

  /*
   * ニュース本数取得API
   *
   * ニュースの一日あたりの本数を取得します。
   *
   * out: ニュース本数
   */
  function get_news_count() {

    $count = 3; // 何らかの方法で数値を決める

    // 出力データの設定
    $data = array($count);
    $this->set(compact('count'));

    // 出力設定
    Configure::write('debug', 0); // 警告を出さない
    $this->layout = false;
    header("Content-Type: text/plain"); 
  }
}
?>
