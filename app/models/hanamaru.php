<?php
class Hanamaru extends AppModel {
	var $name = 'Hanamaru';
  var $useTable = 'hanamaru';

  /*
   * もらったはなまる総数を取得する。
   * in: $user_id 該当ユーザーのユーザーID
   * out: 該当ユーザーのもらったはなまる総数。該当ユーザーが見つからない場合は、0。
   */
  function getHanamaruCount($user_id) {
    $count = $this->find('count', array('conditions' => array('owner_id' => $user_id)));
    return $count;
  }

}
?>
