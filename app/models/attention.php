<?php
class Attention extends AppModel {
    var $name = 'Attention';

    function getAttentionCount($type, $external_id) {
        $count = $this->find('count', array(
            'conditions' => array('type' => $type, 'external_id' => $external_id), 
        ));
        return $count;
    }

  /*
   * ユーザーが該当記事に注目をつけているか判定する。
   *
   * in: $user_id ユーザーID
   * in: $news_id ニュースID
   * out: 注目をつけていればtrue、注目をつけていなければfalse
   */
  function checkAlreadyAddAttention($user_id = null, $news_id = null) {

    $conditions = array(
      'user_id' => $user_id,
      'type' => 2,
      'external_id' => $news_id,
    );

    $count = $this->find('count', array('conditions' => $conditions));
    if ($count == 0) {
      return false;
    }

    return true;
  }

}
?>
