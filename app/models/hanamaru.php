<?php
class Hanamaru extends AppModel {
	var $name = 'Hanamaru';

  // 対応するテーブルを指定
  var $useTable = 'hanamarus';

  /*
   * もらったはなまる総数を取得する。
   * in: $user_id 該当ユーザーのユーザーID
   * out: 該当ユーザーのもらったはなまる総数。該当ユーザーが見つからない場合は、0。
   */
  function getReceivedHanamaruCount($user_id = null) {
    $count = $this->find('count', array('conditions' => array('owner_id' => $user_id)));
    return $count;
  }

  /*
   * あげたはなまる総数を取得する。
   * in: $user_id 該当ユーザーのユーザーID
   * out: 該当ユーザーのあげたはなまる総数。該当ユーザーが見つからない場合は、0。
   */
  function getGaveHanamaruCount($user_id = null) {
/*
	//結合条件
	$joins = array(
		array(
			'type' => 'inner',
			'table' => 'diaries',
			'conditions' => array(
				'Hanamaru.type = 1',
				'diaries.permit_status = 2',
				'diaries.wish_public = 1',
				'diaries.id = Hanamaru.external_id',
			),
		),
    	);
	$params = array('joins' => $joins, 'fields' => '*', 'conditions' => array('user_id' => $user_id));
	// 'count'では件数が返らないらしい
	$result = $this->find('all', $params);
	$count = count($result);
	$this->log('[Hanamaru::getGaveHanamaruCount]count='.$count, LOG_DEBUG);//logging
  */
    $count = $this->find('count', array('conditions' => array('type' => 1, 'user_id' => $user_id)));
    return $count;
  }

  /*
   * ユーザーが該当記事にはなまるをつけているか判定する。
   *
   * in: $user_id ユーザーID
   * in: $diary_id 思い出記録ID
   * out: はなまるをつけていればtrue、はなまるをつけていなければfalse
   */
  function checkAlreadyAddHanamaru($user_id = null, $diary_id = null) {

    $conditions = array(
      'user_id' => $user_id,
      'type' => 1,
      'external_id' => $diary_id
    );

    $count = $this->find('count', array('conditions' => $conditions));
    if ($count == 0) {
      return false;
    }

    return true;
  }
  

}
?>
