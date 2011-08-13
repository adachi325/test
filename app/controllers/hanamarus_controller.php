<?php
class HanamarusController extends AppController {

    var $name = 'Hanamarus';

    // 使用するモデルを指定
    var $uses = array("Hanamaru", "Diary", "Article");


    function beforeFilter()
    {
        $this->Auth->allow('add_hanamaru');
        parent::beforeFilter();
    }

    function received() {
        // ユーザー情報を取得
        $user = $this->Auth->user();
        $user_id = $user['User']['id'];

        // もらったはなまる総数を取得
        $this->set('hanamaru_total', $this->Hanamaru->getReceivedHanamaruCount($user_id));

        // paginateCount呼び出し時のオプションを設定
        Configure::write('paginateOption','hanamarus/received');

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
                'limit' => 5,
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

        // paginateCount呼び出し時のオプションを設定
        Configure::write('paginateOption','hanamarus/gave');

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
                'limit' => 5,
                'conditions' => array('Hanamaru.user_id' => $user_id),
                'group' => array('Diary.id'),
                'order' => array('Hanamaru.created' => 'desc'),
            )
        );
        $this->Diary->recursive = -1;
        $hanamarus = $this->paginate('Diary');
        $this->set('hanamarus', $hanamarus);
    }

    /*
     * はなまるを追加
     *
     * はなまるを追加するAPIです。
     * はなまるを1増やします。
     * 1つの思い出記録につき、はなまるを追加できる回数は、1ユーザーにつき1回です。
     * 実行後、パラメーターで指定されたURLへリダイレクトします。
     *
     * in: id 思い出記録のID (GETメソッドのパラメータより取得)
     * in: user_id ユーザーIDのハッシュ(GETメソッドのパラメータより取得)
     * in: returnPath リダイレクト先URL(GETメソッドのパラメータより取得)
     */
    function add_hanamaru() {

        // パラメーターの取得
        $id = $this->params['url']['id'];
        $user_id = $this->params['url']['user_id'];
        $returnPath = $this->params['url']['returnPath'];

        if (strpos($returnPath, Configure::read('Api.domain')) === false) { 
            $this->cakeError('error404');
        }

        if (!$this->check_hash($user_id)) {
            $this->cakeError('error404');
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
            //$this->redirect($returnPath);
            $this->cakeError('error404');
            return;
        }

        // 既にはなまるをあげているかチェック
        $conditions = array(
            'type' => 1,
            'external_id' => $id,
            'user_id' => $user['User']['id'],
        );
        $count = $this->Hanamaru->find('count', array('conditions' => $conditions));

        // はなまるをあげていなければデータを登録する
        if ($count == 0) {
            // 対象記事の所有者のUIDを取得する
            $diary_model = & ClassRegistry::init('Diary');
            $diary_model->contain();
            $diary = $diary_model->find('first', array('conditions' => array('id' => $id)));
            $child_id = $diary['Diary']['child_id'];

            $child_model = & ClassRegistry::init('Child');
            $child_model->contain();
            $child = $child_model->find('first', array('conditions' => array('id' => $child_id)));
            $owner_id = $child['Child']['user_id'];

            // モデルを作成
            $data = array(
                'type' => 1,
                'external_id' => $id,
                'user_id' => $user['User']['id'],
                'owner_id' => $owner_id,
            );
            $this->Hanamaru->create();
            $this->Hanamaru->save($data);
        }

        $this->redirect($returnPath);
    }

}
?>
