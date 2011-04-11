<?php
/**
 * AuthComponentに簡単ログイン機能を付加するコンポーネント.
 *
 */
class EasyLoginComponent extends Object {

	/**
	 * 呼び出し元コントローラーインスタンスの参照
	 * @var Object AppController
	 */
	var $controller;

	/**
	 * AuthComponentが認証に使用するモデルインスタンスの参照
	 * @var Object AppModel
	 */
	var $userModel;

	/**
	 * userModelに対応するテーブルの、簡単ログイン情報を保存するフィールド名.
	 * @var string
	 */
	var $field;

	/**
	 * 簡単ログイン用の個体番号.
	 * @var string
	 */
	var $mobuid;

	/**
	 * 呼び出し元コントローラーのbeforeFilter以前に実行される.
	 * @param $controller 呼び出し元コントローラーインスタンス
	 */
	function initialize(&$controller) {
		//簡単ログインに使用するuserModelテーブルのフィールド名
		$this->field = 'uid';
		//簡単ログインに使用する個体番号を初期化
		$this->mobuid = '';
                //モデル指定
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
	 * 簡単ログインを実行する.
	 */
	function login() {

            //ログイン済みなら終了
            if($this->controller->Auth->user()) {
                $this->log('---uid1---' ,LOG_DEBUG);
                $this->log($this->_getUid() ,LOG_DEBUG);
                $this->log('---/uid1---' ,LOG_DEBUG);

                //ユーザー情報設定
                $this->_setUserData();
                //ログイン成功時にuid更新
                $this->_saveUid($this->controller->Session->read('Auth.User.id'));
                return;
            }

            //userモデル取得
            $User = ClassRegistry::init('User');

            //個体識別番号取得
            $this->mobuid = $this->_getUid();

            $this->log('---uid2---' ,LOG_DEBUG);
            $this->log($this->mobuid ,LOG_DEBUG);
            $this->log('---/uid2---' ,LOG_DEBUG);

            //簡単ログイン個体番号が設定されている場合
            if($this->mobuid!='') {
                    //簡単ログイン個体番号からユーザー情報を取得
                    $user = $User->find('first', array(
                            'conditions' => array($User->name.'.'.$this->field => $this->mobuid)
                    ));
                    //取得したユーザー情報でログイン
                    if($this->controller->Auth->login($user[$User->name])) {
                        //ユーザー情報設定
                        $this->_setUserData();
                    }
            } else {
                //SSL接続だったらやらないでね処理追加！(2次対応)
//                if($_SERVER['HTTPS']=='on'){
//                        print "SSL接続";
//                }else{
//                        print "通常接続";
//                }
                
                if($this->controller->Ktai->is_ktai()) {
                    $result = $this->_getCareer();
                    if( $result == 0 or $result == 1 or $result == 2 ){
                        //【追加対応】ログイン処理にきてuidが取れない端末はエラー画面でその内容を表示
                        $this->cakeError('error404');
                        return;
                    }
                }
                
            }
	}

        //uidを更新する。
        function _saveUid($selectId){
            if (!empty($selectId)){
                //userモデル取得
                $User = ClassRegistry::init('User');
                $request = array();
                $request['User']['id'] = $selectId;
                $request['User']['uid'] = $this->_getUid();
                if($User->save($request)){
                    return true;
                }
            }
            return false;
        }

        /**
	 * 端末からuidを取得する。
	 */
        function _getUid(){
            //UID取得
            if($this->controller->Ktai->is_ktai()) {
                $result = $this->_getCareer();
                if( $result == 0 or $result == 1 or $result == 2 ){
                    return $this->controller->Ktai->get_uid();
                }
            }
            return 0;
        }

	/**
	 * キャリア判定
	 */
        function _getCareer(){
            if ($this->controller->Ktai->is_imode()) {
                return 0;
            } else if ($this->controller->Ktai->is_ezweb()) {
                return 1;
            } else if ($this->controller->Ktai->is_softbank()) {
                return 2;
            } else if ($this->controller->Ktai->is_iphone()) {
                return 3;
            } else if ($this->controller->Ktai->is_android()) {
                return 4;
            } else {
                return 5;
            }
        }

        //ユーザーログイン情報を設定
        function _setUserData(){
            $userdata = array();
            $userdata = $this->controller->Auth->user();
            unset ($userdata['User']['uid']);
            unset ($userdata['User']['created']);
            unset ($userdata['User']['modified']);
            $this->controller->set('login_user_data',$userdata);
        }
}
?>
