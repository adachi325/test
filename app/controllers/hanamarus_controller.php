<?php
class HanamarusController extends AppController {

	var $name = 'Hanamarus';

  // 使用するモデルを指定
  var $uses = array("Hanamaru", "Diary");

	function beforeFilter()
  {
    // 表示テストのため、非ログイン時でも表示可とする
		$this->Auth->allow('*');
    parent::beforeFilter();
  }

  function index() {
    $this->set('hanamarus', $this->paginate('Hanamaru'));
  }

  function hoge($user_id = null) {

    // hanamarus.external_idより、diariesを特定して表示する。はなまる個数は？

    $joins = array(
      array(
        'type'       => 'inner',
        'table'      => 'diaries',
        'alias'      => 'Diary',
        'conditions' => array(
          'Diary.id = Hanamaru.external_id',
        ),
      ),
    );
    $param = array('joins' =>$joins, 'fields' => '*', 'conditions' => array('Hanamaru.owner_id' => $user_id));
    // 普通のfindはできた
    // $hanamarus = $this->Hanamaru->find('all', $param);
    // paginateができない？
#     $this->paginate = array(
#       'Hanamaru' => array(
#         'joins' => array(
#           array(
#             'type' => 'inner',
#             'table' => 'diaries',
#             'alias' => 'Diary',
#             'conditions' => array('Diary.id = Hanamaru.external_id'),
#           ),
#         ),
#         'fields' => "*",
#         'limit' => 2,
#         'conditions' => array('Hanamaru.owner_id' => $user_id),
#       )
#     );
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
