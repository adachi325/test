<?php
class HanamarusController extends AppController {

	var $name = 'Hanamarus';

  // 使用するモデルを指定
  var $uses = array("Hanamaru", "Diary");

  // TODO: テスト用のため稼働時には削除すること、またapp/view/layout/cake.ctpも削除すること
  var $layout = "cake";

	function beforeFilter()
  {
    // TODO: 表示テストのため、非ログイン時でも表示可とする
		$this->Auth->allow('*');
    parent::beforeFilter();
  }

  function index() {
    $this->set('hanamarus', $this->paginate('Hanamaru'));
  }

  function received() {
    // ユーザー情報を取得
    $user = $this->Auth->user();
    $user_id = $user['User']['id'];

    // もらったはなまる総数を取得
    $this->set('hanamaru_total', $this->Hanamaru->getReceivedHanamaruCount($user_id));

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
        'group' => array('Diary.id'),
        'order' => array('Diary.hanamaru_last_updated' =>  'desc'),
      )
    );
    $this->Diary->recursive = -1;
    $hanamarus = $this->paginate('Diary');
    $this->set('hanamarus', $hanamarus);
  }

  function gave() {
    // ユーザー情報を取得
    $user = $this->Auth->user();
    $user_id = $user['User']['id'];

    // あげたはなまる総数を取得
    $this->set('hanamaru_total', $this->Hanamaru->getGaveHanamaruCount($user_id));

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
        'conditions' => array('Hanamaru.user_id' => $user_id),
        'group' => array('Diary.id'),
        'order' => array('Hanamaru.created' => 'desc'),
      )
    );
    $this->Diary->recursive = -1;
    $hanamarus = $this->paginate('Diary');
    $this->set('hanamarus', $hanamarus);
  }
}
?>
