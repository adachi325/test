<?php

class NavigationsController extends AppController {

	var $name = 'Navigations';
	var $uses = null;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('prev', 'after1', 'after2', 'register');
	}

	//登録前ページ(prev)に制御は特に無し。
	function prev($id =null) {

            $previd = $this->Session->read('previd');
            $this->Session->delete('previd');

            if (!empty($previd)){
                    $id = $previd;
            }

            //利用規約未同意エラー表示切り分け処理
            $errorStr = $this->Session->read('prev2_error_flg');
            if(!isset($errorStr)){
                $errorStr = false;
            } else {
                $this->Session->delete('prev2_error_flg');
            }
            $this->set(compact('errorStr'));

            if(empty($id) or $id < 1 or $id > 2){
                    $this->cakeError('error404');
                    return;
            }
            $this->render('prev'.$id);
	}

	function after1() {

		$this->Auth->autoRedirect = false;
		$this->Session->delete('Auth.redirect');

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

		 $Child =& ClassRegistry::init('Child');
		 $child = $Child->findById($userdata['User']['last_selected_child']);

		//メールアドレス設定
		$mailStr = 'diary_'.$userdata['User']['hash'].'.'.$child['Child']['hash'].'.'.$themes[0]['Theme']['id'].'.'.$hash.'@'.Configure::read('Defaults.domain');
		$mailPublicStr = 'diary_'.$userdata['User']['hash'].'.'.$child['Child']['hash'].'.'.$themes[0]['Theme']['id'].'.'.$hash.'.pub@'.Configure::read('Defaults.domain');

		//メールタイトル設定
		$mailTitle = 'ベストショット';

		$ua = $_SERVER['HTTP_USER_AGENT'];

		$this->set('mailStr',$mailStr);
		$this->set('mailPublicStr',$mailPublicStr);
		$this->set('mailTitle',$mailTitle);
	}

	function after2($hash = null) {

                //hashを確認し、データがなければリダイレクト
                if(!empty($this->data['Navigation']['nexthash'])){
                    $hash=$this->data['Navigation']['nexthash'];
                }

		if(empty($hash)){
			$this->cakeError('error404');
			return;
		}

		//会員情報取得
		$userdata = $this->getUserData();
                $conditions = array(
                    'conditions' => array(
                        'Diary.child_id' => $userdata['User']['last_selected_child'],
                        'Diary.hash' => $hash
                    ),
                    'order'=>array('Diary.created DESC')
                );
		$diary =& ClassRegistry::init('Diary');
		$diary->contain();
		$diaries = $diary->find('first',$conditions);
		$this->set(compact('diaries'));

		//ハッシュタグを設定
		$this->set('nexthash',$hash);

		if(empty($diaries)){
			$this->render('after2_unknown');
			return;
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
			$this->data['Navigation']['agree'] == 0){
				//$this->Session->setFlash(__('利用規約に同意してください。', true));
				$this->Session->write('previd' , '2');
				//利用規約未同意エラー表示切り分けフラグ設定
				$this->Session->write('prev2_error_flg' , true);
				$this->redirect('/navigations/prev');
			}
		$this->redirect('/users/register');
	}
}
?>
