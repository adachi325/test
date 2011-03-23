<?php

class NavigationsController extends AppController {

	var $name = 'Navigations';
	var $uses = null;

        function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('prev','rule','register');
	}

        //登録前ページ(prev)に制御は特に無し。
	function prev($id =null) {

            $previd = $this->Session->read('previd');
            $this->Session->delete('previd');
            if (!empty($previd)){
                $id = $previd;
            }

            if(empty($id) or $id < 1 or $id > 2){
                $this->cakeError('error404');
                return;
            }
            $this->render('prev'.$id);
        }

	function after1() {

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

            //メールタイトル
            $mailTitle = rawurlencode((date('m')+0).'月'.(date('d')+0).'日の思い出');

            $this->set('mailStr','mailto:'.$mailStr.'?subject='.$mailTitle.'&body='.'111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111');
        }

	function after2($hash = null) {

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

            //ハッシュタグを設定
            $this->set('nexthash',$hash);

            if(empty($diaries)){
                $this->render('after2_unknown');
                return;
            }

            if(!empty($diaries['Diary']['error_code'])){
                $this->render('after2_failure');
            }

        }

        function getUserData(){
            //会員情報取得
            $userAuthData = $this->Auth->user();
            $user =& ClassRegistry::init('User');
            $user->contain();
            return $user->read(null,$userAuthData['User']['id']);
        }

        function register(){

            //同意しているかチェック
            if(empty($this->data) or
               $this->data['navigations']['agree'] == 0){
                $this->Session->setFlash(__('利用規約に同意してください。', true));
                $this->Session->write('previd' , '2');
                $this->redirect('/navigations/prev');
            }
            $this->redirect('/users/register');
        }
}
?>
