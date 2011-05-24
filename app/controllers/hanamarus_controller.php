<?php
class HanamarusController extends AppController {

	var $name = 'Hanamarus';

  // 使用するモデルを指定
  var $uses = array("Hanamaru", "Diary");

  // TODO: テスト用のため、削除すること
  var $layout = null;

	function beforeFilter()
  {
    // TODO: 表示テストのため、非ログイン時でも表示可とする
		$this->Auth->allow('*');
    parent::beforeFilter();
  }

  function index() {
    $this->set('hanamarus', $this->paginate('Hanamaru'));
  }

  function receive($user_id = null) {

    $this->paginate = array(
      'Diary' => array(
        'joins' => array(
          array(
            'type' => 'inner',
            'table' => 'hanamarus',
            'alias' => 'Hanamaru',
            'conditions' => array('Diary.id = Hanamaru.external_id'),
          ),
        ),
        'fields' => "*",
        'limit' => 2,
        'conditions' => array('Hanamaru.owner_id' => $user_id),
      )
    );
    $hanamarus = $this->paginate('Diary');
    $this->set('hanamarus', $hanamarus);
    pr($hanamarus);
  }


}
?>
