<?php

class NavigationsController extends AppController {

	var $name = 'Navigations';
	var $uses = null;

        function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('prev');
	}

        //登録前ページ(prev)に制御は特に無し。
	function prev($id =null) {
            if(empty($id) or $id < 1 or $id > 6){
                $this->cakeError('error404');
                return;
            }
            $this->render('prev'.$id);
        }
        
	function after1() { }

	function after2() {

            //今月の自由テーマＩＤを取得
            $options = array();
            $options['Theme.free_theme'] = true;
            $options['Month.year'] = date('Y');
            $options['Month.month'] = date('m') + 0;            
            $theme =& ClassRegistry::init('Theme');
            $theme->contain('Month');
            $themes = $theme->find('all',array('conditions' => $options));

            //会員情報取得
            $userdata = $this->getUserData();

            //現在時刻にてhash作成
            $hash = substr(AuthComponent::password(date("Ymdhis")), 0, 4);

            //ハッシュタグを設定
            $this->set('nexthash',$hash);

            //メールアドレス設定
            $mailStr = 'diary_'.$userdata['User']['id'].'.'.$userdata['User']['last_selected_child'].'.'.$themes[0]['Theme']['free_theme'].'.'.$hash.'@shimajiro-dev.com';
            $this->set('mailStr',$mailStr);

        }

	function after3($hash = null) {

            if(!empty($hush)){
                $this->cakeError('error404');
                return;
            }

            //会員情報取得
            $userdata = $this->getUserData();

            $options = array();
            $options['hash'] = $hash;
            $options['child_id'] = $userdata['User']['last_selected_child'];
            $diary =& ClassRegistry::init('Diary');
            $diary->contain();
            $diaries = $diary->find('first',array('conditions' => $options));

            //ハッシュタグを設定
            $this->set('nexthash',$hash);

            if(empty($diaries)){
                $this->render('after3_unknown');
            }
            
        }

	function after4($hash = null) {
            if(!empty($hush)){
                $this->cakeError('error404');
                return;
            }

            //会員情報取得
            $userdata = $this->getUserData();
            
            $options = array();
            $options['hash'] = $hash;
            $options['child_id'] = $userdata['User']['last_selected_child'];
            $diary =& ClassRegistry::init('Diary');
            $diary->contain();
            $diaries = $diary->find('first',array('conditions' => $options));

            $this->set(compact('diaries'));
        }
        
	function after5() { }

        function getUserData(){
            //会員情報取得
            $userAuthData = $this->Auth->user();
            $user =& ClassRegistry::init('User');
            $user->contain();
            return $user->read(null,$userAuthData['User']['id']);
        }
}
?>
