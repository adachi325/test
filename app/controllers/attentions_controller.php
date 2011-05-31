<?php
class AttentionsController extends AppController {

  var $name = 'Attentions';
  var $helpers = array('Html', 'Form', 'Csv');

  function beforeFilter()
  {
    // TODO: 表示テストの
		$this->Auth->allow('*');
    parent::beforeFilter();
  }

  function get_attention_count($news_id) {

    $conditions = array(
      'type' => 2,
      'external_id' => $news_id,
    );
    // $count = $this->Attention->find('count');

    // csw
    Configure::write('debug', 2); // 警告を出さない
    $this->layout = false;
    $filename = 'get_attention_count' . date('YmdHis'); // 任意のファイル名
    $count = $this->Attention->find('count');
    $this->set(compact('count', 'filename'));
  }

  function attention($id, $user_id, $returnPath) {

    // リダイレクトしまーす
  }

}
?>
