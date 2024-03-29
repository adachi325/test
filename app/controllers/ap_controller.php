<?php
class ApController extends AppController {

	var $name = 'Ap';
	var $helpers = array('Time');
	var $uses = array();

	var $allow_android = true;

	function beforeFilter()
	{
		$this->Auth->allow('*');
		parent::beforeFilter();
	}

	function _getUser() {
		//ログイン済みじゃない場合、uidを取得
		$has_account = false;
        $uid = $this->_getUid();
        $user = false;
		if(!empty($uid)) {
			$User =& ClassRegistry::init('User');
			$User->contain();
			$user = $User->find('first',array('conditions' => array('uid' => $uid)));
			//uidが存在する場合、フラグを立てる
			if(!empty($user)){
				$has_account = true;
			}
		}
        $this->set(compact('has_account'));
        return $user;
	}

	/**
	 * 端末からuidを取得する。
	 */
	function _getUid(){
		//UID取得
		if($this->Ktai->is_ktai()) {
			$result = $this->_getCareer();
			if( $result == 0 or $result == 1 or $result == 2 ){
				return $this->Ktai->get_uid();
			}
		}
		return 0;
	}

	/**
	 * キャリア判定
	 */
	function _getCareer(){
		if ($this->Ktai->is_imode()) {
			return 0;
		} else if ($this->Ktai->is_ezweb()) {
			return 1;
		} else if ($this->Ktai->is_softbank()) {
			return 2;
		} else if ($this->Ktai->is_iphone()) {
			return 3;
		} else if ($this->Ktai->is_android()) {
			return 4;
		} else {
			return 5;
		}
	}

    function _redirect2members() {
        $url = '/lines/top/0/'.$this->params['action'].'/';
        $url = Router::url($url, true);
        //pr (Router::url($url, true));
        $this->redirect($url);
    }

    function baby($id = null) {
		if ($id) {
			$this->__view($this->params['action'], $id);
		} else {
			$this->__index($this->params['action']);
		}
	}

	function petit_f($id = null) {
		if ($id) {
			$this->__view($this->params['action'], $id);
		} else {
			$this->__index($this->params['action']);
		}
	}

	function petit($id = null) {
		if ($id) {
			if ($id === 'index') {
				$this->__index($this->params['action']);
			} else {
				$this->__view($this->params['action'], $id);
			}
        } else {
            if ($this->Ktai->is_android()) {
                $this->redirect('/');
            }

            $user = $this->_getUser();
            if ($user) {
                $this->_redirect2members();
            }

            $this->render("petit");
        }
	}

	function pocket($id = null) {
		if ($id) {
			$this->__view($this->params['action'], $id);
		} else {
			$this->__index($this->params['action']);
		}
	}

	function hop($id = null) {
		if ($id) {
			$this->__view($this->params['action'], $id);
		} else {
			$this->__index($this->params['action']);
		}
	}

	function step($id = null) {
		if ($id) {
			$this->__view($this->params['action'], $id);
		} else {
			$this->__index($this->params['action']);
		}
	}
	
	function jump($id = null) {

        if ($id) {
			$this->__view($this->params['action'], $id);
		} else {
			$this->__index($this->params['action']);
		}
	}

	function member($id = null) {
		if ($id) {
			$this->__member_view($id);
		} else {
			$this->cakeError('error404');
		}
	}

	function __index($line = null) {

		if ($this->Ktai->is_android()) {
			$this->redirect('/');
		}

		extract($this->params);	

		$title = '';

		if (isset($line)) {
			
			$Line =& ClassRegistry::init('Line');

			$opt = array(
				'conditions' => array('category_name' => $line),
				'fields' => array('title', 'category_name'),
			);

			if ($line != "baby") {
				$opt['order'] = 'created DESC';
			}

			$data = $Line->find('first', $opt);

			if (!empty($data)) {
				$title = $data['Line']['title'];
			}

			$Issue =& ClassRegistry::init('Issue');
			$issues = $Issue->find('released', array('line' => $line));

			$lines = $Line->find('all', array(
				'fields' => array('title', 'category_name'),
            ));
            $contents = Set::extract('/Content', $issues);

            //Issue.titleの追加
            $ii = 0;
            foreach($contents as $content){
                foreach($issues as $issue){
                    if ($content['Content']['issue_id'] == $issue['Issue']['id']) {
                        $contents[$ii++]['Issue']['title'] = $issue['Issue']['title'];
                        break;
                    }	
                }
            }	
        }

        $user = $this->_getUser();
        if ($user) {
            $this->_redirect2members();
        }

		$this->set(compact('issues', 'title', 'lines', 'line', 'contents'));
		$this->render('index');
	}

	function __member_view($id = null) {

		if(empty($id)) {
			$this->cakeError('error404');
		}

		if ($this->Ktai->is_android()) {
			$this->redirect('/pages/android/');
		}

		$this->ktai['enable_ktai_session'] = false;
        $user = $this->_getUser();

	  $filepath = WWW_ROOT."ap/member/{$id}/index.html";
		if ($this->Ktai->is_softbank()) {
			$_path = WWW_ROOT."ap/member/{$id}/index.softbank.html";
		} elseif ($this->Ktai->is_ezweb()) {
			$_path = WWW_ROOT."ap/member/{$id}/index.au.html";
		}

    if (isset($_path) && file_exists($_path)) {
      $filepath = $_path;
    }
		
		$this->set(compact('filepath'));
		$this->layout = 'contents';
		$this->render("view");
	}

	function __view($line = null, $id = null) {

		if(empty($line) || empty($id)) {
			$this->redirect(array('action' => 'index'));
		}

		$this->Content =& ClassRegistry::init('Content');
		
		$data = $this->Content->isReleased($line, $id);

		$this->ktai['enable_ktai_session'] = false;

		if ($data === false) {
			$this->cakeError('error404');
			return;
		}

		$release_date = $data['Content']['release_date'];
        $user = $this->_getUser();

        if ($release_date <= date('Y-m-d H:i:s')) {
            $filepath = WWW_ROOT."ap/{$line}/{$id}/index.html";

            $this->layout = 'contents';
            if ($this->Ktai->is_softbank()) {
                $_path = WWW_ROOT."ap/{$line}/{$id}/index.softbank.html";
            } elseif ($this->Ktai->is_ezweb()) {
                $_path = WWW_ROOT."ap/{$line}/{$id}/index.au.html";
            } elseif ($this->Ktai->is_android()) {
                $_path = WWW_ROOT."ap/{$line}/{$id}/index.android.html";
                if (!file_exists($_path)) {
                    $this->layout = null;
                    $this->render('android');
                    return;
                } else {
                    $this->layout = 'contents_android';
                }
            }

            if (isset($_path) && file_exists($_path)) {
                $filepath = $_path;
            }

            $this->set(compact('release_date', 'filepath'));
            $this->render("view");
        } else {
            $this->set(compact('release_date'));
            if ($this->Ktai->is_android()) {
                $this->layout = null;
                $this->render("android_error");	
            } else {
                $this->render("error");	
            }
        }
	}

}
?>
