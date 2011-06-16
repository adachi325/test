<?php
class ArticlesController extends AppController {

    var $name = 'Articles';
    var $helpers = array('Wikiformat.Wikiformat', 'DiaryCommon');

    // 使用するモデルを指定

    function beforeFilter()
    {
        parent::beforeFilter();
        
        $this->Auth->allow('top');

        if ($this->Ktai->is_android()) {
            $this->layout = 'android';
            $this->view_prefix = 'android_';
        }
    }

    function timeline($category = null) {
 
        $user = $this->Auth->user();

        if ($user) {
            $this->set('login_user',$user);
        } else {
            //ログイン済みじゃない場合、uidを取得
            $uid = $this->EasyLogin->_getUid();
            if(!empty($uid)) {
                $User =& ClassRegistry::init('User');
                $User->contain();
                $user = $User->find('first',array('conditions' => array('uid' => $uid)));
                //uidが存在する場合、自動ログイン実行
                if(!empty($user)){
                    //取得したユーザー情報でログイン
                    if($this->Auth->login($user)) {
                        //ユーザー情報設定
                        unset ($user['User']['uid']);
                        unset ($user['User']['created']);
                        unset ($user['User']['modified']);
                        $this->set('login_user',$user);
                    } else {
                        $user = '';
                    }
                }
            } else {
                $this->redirect('/');
            }

        } 
 
        $today = date('Y-m-d H:i:s');
  
        $cond = array(
            'conditions' => array('release_date <= ' => $today, 'expire_date >= ' => $today),
            'limit' => 10,
            'order' => array('release_date', 'id DESC'),
        );

        if ($category != null) {
            $cond['conditions']['type'] = $category;
        }
    
        $this->paginate = $cond;
        $articles_base = $this->paginate();
        $articles = $this->__addDiaries($articles_base);

        /*
        $Diary =& ClassRegistry::init('Diary');
        $Child =& ClassRegistry::init('Child');

        $Child->contain();
        $children = $Child->find('all', array(
            'conditions' => array('Child.user_id' => $user['User']['id']),
            'fields' => array('id'),
        ));

        $child_ids = Set::extract('/Child/id', $children);

        $cond = array(
            'conditions' => array(
                'Diary.child_id' => $child_ids,
                'Diary.has_image' => 1,
                'Diary.error_code' => null
            ),
            'order'=>array('Diary.created DESC')
        );
        $prof_diary = $Diary->find('first', $cond);
         */

        $this->set(compact('newslist', 'hanamaru_received', 'hanamaru_gave', 'articles')); 
    }

    function top($category = null) {

        if ($this->Ktai->is_android()) {
            $this->render('/pages/android_top');
            return;
        }

        $sessionTimeOutError01 = $this->Session->read('sessionTimeOutError01');
        $this->Session->delete('sessionTimeOutError01');
        if (!empty($sessionTimeOutError01)){
            $this->set('uidErrorStr',1);
        }

        //ログイン済み判定
        $user = $this->Auth->user();
        $this->set('login_user', array());

        if ($user) {
            $this->set('login_user',$user);
        } else {
            //ログイン済みじゃない場合、uidを取得
            $uid = $this->EasyLogin->_getUid();
            if(!empty($uid)) {
                $User =& ClassRegistry::init('User');
                $User->contain();
                $user = $User->find('first',array('conditions' => array('uid' => $uid)));
                //uidが存在する場合、自動ログイン実行
                if(!empty($user)){
                    //取得したユーザー情報でログイン
                    if($this->Auth->login($user)) {
                        //ユーザー情報設定
                        unset ($user['User']['uid']);
                        unset ($user['User']['created']);
                        unset ($user['User']['modified']);
                        $this->set('login_user',$user);
                    } else {
                        $user = '';
                    }
                }
            }
        }

        $today = date('Y-m-d H:i:s');
        
        //ニュース取得
        $News =& ClassRegistry::init('News');
        $newslist = $News->find('all',array('order' => array('start_at desc'),
					    'conditions' =>
            					array('start_at <= ' => $today, 'finish_at >= ' => $today )));

        $cond = array(
            'conditions' => array('release_date <= ' => $today, 'expire_date >= ' => $today),
            'limit' => empty($user) ? 4 : 5,
            'order' => 'release_date DESC'
        );
        if ($category != null) {
            $cond['conditions']['type'] = $category;
        }
        if (empty($user)) {
            $cond['conditions']['type <>'] = 1;
        }

        $this->Article->contain();
        $articles_base = $this->Article->find('all', $cond);
        $articles = $this->__addDiaries($articles_base);

        $hanamaru_received = 0;
        $hanamaru_gave = 0;
        $themes = array();

        // 非会員の判定
        if (empty($user)) {
            //月データ取得
            $Month =& ClassRegistry::init('Month');
            $options = array();
            $options['year'] = date('Y');
            $options['month'] = date('m') + 0;
            $months = $Month->find('all', array('conditions' => $options));
            //テーマ要素作成日順に入れ替える
            $themes = array_reverse($months['0']['Theme']);
	    $themes = $themes[0];	//追加　ｂｙ　飯塚
       } else {
            $Hanamaru =& ClassRegistry::init('Hanamaru');

            $hanamaru_received = $Hanamaru->getReceivedHanamaruCount($user['User']['id']);
            $hanamaru_gave = $Hanamaru->getGaveHanamaruCount($user['User']['id']);
        }

        $this->set(compact('newslist', 'hanamaru_received', 'hanamaru_gave', 'articles', 'themes')); 
        
        if (empty($user)) {
            $this->render('top_guest');
        }
    }

    function __addDiaries($articles_base) {
        $Diary =& ClassRegistry::init('Diary');
        $Diary->contain('Child');

        $articles = array();
        $Attention =& ClassRegistry::init('Attention');
        
        foreach($articles_base as $article) {
            switch($article['Article']['type']) {
            case 1:
                $diary = $Diary->find('first', array('conditions' => array('Diary.id' => $article['Article']['external_id'])));
                $article['Diary'] = $diary['Diary'];
                $article['Child'] = $diary['Child'];
                break;
            case 2:
                $count = $Attention->getAttentionCount($article['Article']['type'], $article['Article']['external_id']);
                $article['Article']['attention_count'] = $count;
                break;
            }
            $articles[] = $article;
        } 
        return $articles;
    }

    function __getTimeline($limit, $category) {

    }

}
?>
