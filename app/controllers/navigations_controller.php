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
            $options['year'] = date('Y');
            $options['month'] = date('m') + 0;
            $options['free_theme'] = true;
            $month =& ClassRegistry::init('Month');
            $month = contain('theme');
            $months = $month->find('all',array('conditions' => $options));
            $this->set(compact('months'));

            //会員情報取得
            $userAuthData = $this->Auth->user();
            $user =& ClassRegistry::init('User');
            $user->contain();
            $userdata = $user->read(null,$userAuthData['User']['id']);

            //現在時刻にてhash作成
            $hash = substr(AuthComponent::password(date("Ymdhis")), 0, 4);

            //次へボタン用にハッシュタグを設定
            $this->set('nexthash',$hash);

            //メールアドレス設定
            $mailStr = 'diary_'.$userdata['User']['id'].'.'.$userdata['User']['last_selected_child'].'.'.$id.'.'.$hash.'@shimajiro-dev.com';
            $this->set('mailStr',$mailStr);
        }

	function after3() { }

	function after4() { }
        
	function after5() { }
}
?>
