<?php
app::import('Model','User');

class AutoLoginComponent extends Object {
	/**
	 * 使用するコンポーネント
	 * @var array
	 */
	var $components = array('ktai');
        
    	//ktaiライブラリ設定
	public $ktai;
        
	/**
	 * 呼び出し元コントローラーインスタンスの参照
	 * @var Object AppController
	 */
	var $controller;

	/**
	 * AuthComponentが認証に使用するモデルインスタンスの参照
	 * @var Object AppModel
	 */
	var $User;

	/**
	 * 自動ログインの有効期限.
	 * strtotime()関数でtime型に変換できる文字列.
	 * デフォルトは2週間('2weeks').
	 * @var string
	 */
	var $expire;

	/**
	 * userModelに対応するテーブルの、自動ログイン情報を保存するフィールド名.
	 * cookieに保存する際のキーにも使用する.
	 * デフォルトは'passport'
	 * @var string
	 */
	var $field;

	/**
	 * 呼び出し元コントローラーのbeforeFilter以前に実行される.
	 *
	 * @param $controller 呼び出し元コントローラーインスタンス
	 */
	function initialize(&$controller) {
		//自動ログインの有効期限、2週間
		//$this->expire = '2weeks';

		//自動ログインに使用するuserModelテーブルのフィールド名
		$this->field = 'uid';

                /** AuthComponentが認証に使用するモデルインスタンスの参照 */
		$this->userModel = 'User';
	}

	/**
	 * コンストラクタ
	 * @param $controller 呼び出し元コントローラーインスタンス
	 */
	function startup(&$controller) {
		//コントローラーを取得
		$this->controller = & $controller;
		//AuthComponentから認証に使うモデルを取得
		$this->userModel = & $controller->{$controller->Auth->userModel};
		//AuthComponentの自動リダイレクト設定を切る
		$controller->Auth->autoRedirect = false;
		//ログイン処理
		$this->login();
	}

	/**
	 * 自動ログインを実行する.
	 */
	function login() {
            //ログイン済みなら終了
            if($this->controller->Auth->user()) {
                    return;
            }
            //端末のUIDを自動ログインキーに設定
            $passport = $this->_getUid();
            pr($passport);

            //自動ログインキーが存在する場合
            if($passport) {
                $passport = $passport[$this->field];
                //自動ログインキーからユーザー情報を取得
                $user = $this->User->find('first', array('conditions' => array($this->User->loginid.'.'.$this->field => $passport)));

                //取得したユーザー情報でログイン
                if($this->controller->Auth->login($user[$this->User->name])) {
                    $this->AutoLogin->enable();
                }
            }
	}

	/**
	 * uidを取得する。
	 */
        function _getUid(){
            //UID取得
            if($this->ktai->is_ktai()) {
                $result = $this->_getCareer();
                if( $result == 0 or $result == 1 or $result == 2 ){
                    return $this->ktai->get_uid();
                }
            }
            return 0;
        }

	/**
	 * キャリア判定
	 */
        function _getCareer(){
            if ($this->ktai->is_imode()) {
                return 0;
            } else if ($this->ktai->is_ezweb()) {
                return 1;
            } else if ($this->ktai->is_softbank()) {
                return 2;
            } else if ($this->ktai->is_iphone()) {
                return 3;
            } else if ($this->ktai->is_android()) {
                return 4;
            } else {
                return 5;
            }
        }

	/**
	 * 自動ログインを使用可能にする
	 */
	function enable() {
		$new_passport = $this->_getUid();
		//$this->User->id = $this->controller->Auth->user('id');
		//$this->User->saveField($this->field, $new_passport);
	}
}
?>