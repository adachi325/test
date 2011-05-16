<?php

class NavigationsController extends AppController {

	var $name = 'Navigations';
	var $uses = null;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('prev','register');
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
