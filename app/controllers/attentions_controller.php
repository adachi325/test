<?php
class AttentionsController extends AppController {

  var $name = 'Attentions';
  var $uses = array('Attention', 'User');

  function beforeFilter()
  {
		$this->Auth->allow('*');
    parent::beforeFilter();
  }

  /*
   * 注目数取得API
   *
   * ニュースの注目数を取得するAPIです。
   *
   * in: id ニュースのID
   * out: 注目数、注目フラグ(true/false)、current_user(ログアウト中は-1)をcsv形式にした文字列
   */
  function get_attention_count() {

    // パラメーターの取得
    $news_id = $this->params['url']['id'];
    $user_id = $this->params['url']['user_id'];

    // 注目数の取得
    $conditions = array(
      'type' => 2,
      'external_id' => $news_id,
    );
    $attention_count = $this->Attention->find('count', array('conditions' => $conditions));

    // ログインユーザーの取得、注目フラグの取得
    //$user = $this->Auth->user();
    // 渡されたハッシュ(user_id)からユーザーを特定します。
    $conditions = array(
      'hash' => $user_id,
    );

    $user_model =& ClassRegistry::init('User');
    $user_model->contain();
    $user = $user_model->find('first', array('conditions' => $conditions));
    if (!$user) {
        // ユーザーが特定できなければ、リダイレクト
        return;
    }

    $user_id = -1;
    $attention_flg = "false";
    if ($user) {
      // ログインユーザーの取得
      $user_id = $user['User']['id'];

      // 注目フラグの取得
      $conditions = array(
        'type' => 2,
        'external_id' => $news_id,
        'user_id' => $user_id,
      );

      $count = $this->Attention->find('count', array('conditions' => $conditions));
      if ($count > 0) {
        $attention_flg = "true";
      }
    }

    // 出力データの設定
    $data = array($attention_count, $attention_flg, $user_id);
    $this->set(compact('data'));

    // 出力設定
    Configure::write('debug', 0); // 警告を出さない
    $this->layout = false;
    header("Content-Type: text/plain"); 

  }

  /*
   * 注目！ボタンAPI
   *
   * ニュースに注目するAPIです。
   * ニュースの注目数を1増やします。
   * 1つのニュースにつき、注目できる回数は、1ユーザーについき1回です。
   * 実行後、パラメーターで指定されたURLへリダイレクトします。
   *
   * in: id ニュースのID (GETメソッドのパラメータより取得)
   * in: user_id ユーザーIDのハッシュ(GETメソッドのパラメータより取得)
   * in: returnPath リダイレクト先URL(GETメソッドのパラメータより取得)
   */
  function attention() {

    // パラメーターの取得
    $id = $this->params['url']['id'];
    $user_id = $this->params['url']['user_id'];
    $returnPath = $this->params['url']['returnPath'];

    if (strpos(Configure::read('Api.domain'), $returnPath) === false) { 
        //return false;
        $this->redirect('/');
    }

    // 渡されたハッシュ(user_id)からユーザーを特定します。
    $conditions = array(
      'hash' => $user_id,
    );
    $user_model =& ClassRegistry::init('User');
    $user_model->contain();
    $user = $user_model->find('first', array('conditions' => $conditions));
    if (!$user) {
      // ユーザーが特定できなければ、リダイレクト
      $this->redirect($returnPath);
    }

    // 既に注目しているかチェック
    $conditions = array(
      'type' => 2,
      'external_id' => $id,
      'user_id' => $user['User']['id'],
    );
    $count = $this->Attention->find('count', array('conditions' => $conditions));

    // 注目していなければデータを登録する
    if ($count == 0) {

      // モデルを作成
      $data = array(
        'type' => 2,
        'external_id' => $id,
        'user_id' => $user['User']['id'],
      );
      $this->Attention->create();
      $this->Attention->save($data);
    }

    $this->redirect($returnPath);
  }

}
?>
