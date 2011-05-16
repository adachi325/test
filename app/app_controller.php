<?php
/**
 * Ktai library, supports Japanese mobile phone sites coding.
 * It provides many functions such as a carrier check to use Referer or E-mail,
 * conversion of an Emoji, and more.
 *
 * PHP versions 4 and 5
 *
 * Ktai Library for CakePHP
 * Copyright 2009-2011, ECWorks.

 * Licensed under The GNU General Public Licence
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright		Copyright 2009-2011, ECWorks.
 * @link			http://www.ecworks.jp/ ECWorks.
 * @version			0.4.1
 * @lastmodified	$Date: 2011-02-11 18:00:00 +0900 (Fri, 11 Feb 2011) $
 * @license			http://www.gnu.org/licenses/gpl.html The GNU General Public Licence
 */

//******************************
//  NOTICE
//******************************
//If you use session in your mobile phone site, copy this file
//to app/controllers directory or paste nessesary parts in this file to your
//AppController class.

/* SVN FILE: $Id: app_controller.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */

class AppController extends Controller {

	public $helpers = array('Ktai', 'Xml', 'Html', 'Time', 'Form','Session','SelectOptions','tk','ga','FormHidden');
	public $components = array(
		'Ktai',
                'Tk',
		'Auth',
		'Session',
		'Transition',
		//'DebugKit.Toolbar',
                'EasyLogin',
                'Tk',
		'CreatePresent',
		'Secured.Ssl' => array(
			'autoRedirect' => false,
			'secured' => array(
				'users' => array('login','register', 'register_confirm' ,'register_complete', 'edit', 'edit_confirm', 'remind', 'remind_password',),
				'children' => array('register', 'register_confirm', 'edit', 'edit_confirm'),
				'diaries' => array('edit', 'edit_confirm','edit_complete'),
			),
			'allowed' => array(
				'users' => array('login'),
			),
		),
	);

	public $layout = 'default';

       	//ktaiライブラリ設定
	public $ktai = array(
		'use_img_emoji' => true,
		'input_encoding' => 'UTF8',
		'output_encoding' => 'UTF8',
		'use_xml' => true,
		'enable_ktai_session' => true, //セッション使用を有効にします
		'use_redirect_session_id' => true, //リダイレクトに必ずセッションIDをつけます
		'imode_session_name' => 'csid', //iMODE時のセッション名を変更します
		'iphone_user_agent_belongs_to_softbank' => false,
		'use_xml' => false,
	);

	public $selectedChildId = null;//選択中こどもID

	public $allow_android = array();

	function beforeFilter(){

		/* iphone端末からのアクセスはPCしまじろう広場へリダイレクト */
		if ($this->Ktai->is_iphone()) {
		    $this->redirect(Configure::read('Defaults.shimajiro_square'));
		}

		parent::beforeFilter();
		$this->Auth->loginError = 'ﾛｸﾞｲﾝ名､またﾊﾟｽﾜｰﾄﾞが違います';
		$this->Auth->authError =  'ご利用されるにはﾛｸﾞｲﾝが必要です';
		$this->Auth->fields = array(
			'username' => 'loginid',
			'password' => 'password'
			);
		$this->Auth->autoRedirect = false;

		//ドコモのときはSSL設定前にUIDをセット
		if($this->Ktai->is_imode()) {
		    //SSLページでのUIDチェック用
		    $ssluid= $this->Session->read('sslUid');
		    if(empty($ssluid) || !isset($ssluid)){
			$uid = $this->Ktai->get_uid();
			if(isset($uid)){
			    $this->Session->write('sslUid', $uid);
			}
		    }
		}

		//SSL環境下はセッションIDを引き回す。
		if(!$this->Ktai->is_imode()){
		    ini_set('session.use_trans_sid', 1);
		    ini_set('session.use_only_cookies', 0);
		    ini_set('session.use_cookies', 0);
		    $this->_userAgent = '';
		    ini_set("url_rewriter.tags", "a=href,area=href,frame=src,form=action,fieldset=");
		    ini_set('session.name','csid');
		    $session_name = session_name();
		    if(isset($_REQUEST[$session_name]) && preg_match('/^\w+$/', $_REQUEST[$session_name])){
			session_id($_REQUEST[$session_name]);
			output_add_rewrite_var($session_name, $_REQUEST[$session_name]);
		    }
		}

		//SSL通信環境設定
		$secured = $this->Ssl->ssled($this->params);

		if ($secured && !$this->Ssl->https) {

			//sb,auのときはSSL設定前にUIDをセット
			if(!$this->Ktai->is_imode()) {
			    //SSLページでのUIDチェック用
			    $ssluid= $this->Session->read('sslUid');
			    if(empty($ssluid) || !isset($ssluid)){
				$uid = $this->Ktai->get_uid();
				if(isset($uid)){
				    $this->Session->write('sslUid', $uid);
				}
			    }
			}

			//SSL通信開始
			$this->Ssl->forceSSL();
		} elseif (!$secured && $this->Ssl->https) {
			$ssluid= $this->Session->read('sslUid');
			if(empty($ssluid) || !isset($ssluid)){
			    $ssluid= $this->Session->delete('sslUid');
			}

			//通常通信
			$this->Ssl->forceNoSSL();
		}

		if($this->Ktai->is_imode()){
			header('Content-Type: application/xhtml+xml');
			$this->__formActionGuidOn();
			$this->__checkImodeId();
		} elseif ($this->Ktai->is_android()) {
			$action = $this->params['action'];
			
			if (empty($this->allow_android)) {
				if ($action != 'display') {
					$this->redirect('/');
				}
			} else {
				if ($this->allow_android !== true) {
					if (!array_search($action, $this->allow_android)) {
						$this->redirect('/');
					}
				}
			}
		}
	}

	function __formActionGuidOn(){
		// output_add_rewrite_varで設定するパラメータをformタグのactionにも付加
		ini_set("url_rewriter.tags", "a=href,area=href,frame=src,form=action,fieldset=");
		output_add_rewrite_var('guid','ON');
	}

	function __checkImodeId()
	{
		#-------------------------------------------------
		# iモードIDがない場合
		#-------------------------------------------------
		if (empty($_SERVER["HTTP_X_DCMGUID"])) {
			#-------------------------------------------------
			# 「guid=ON」が渡ってこなければ付加してリダイレクト
			#-------------------------------------------------
			$uri = '';
			if(isset($_SERVER["REDIRECT_QUERY_STRING"])){
			    $uri = $_SERVER["REDIRECT_QUERY_STRING"];
			}
			if (!eregi("guid=ON", $uri))
			{
				if (isset($_SERVER["HTTP_HOST"]) && isset($_SERVER["REQUEST_URI"]))
				{
					$url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
					$this->redirect($url);
				}
			}
		}
	}

	//----------------------------------------------------------
	//Redirect override.
	//If iMODE access or use_redirect_session_id is true,
	// adding session id to url param.
	//----------------------------------------------------------
	function __redirect_url($url){

		if(isset($this->Ktai)){
			if($this->Ktai->_options['enable_ktai_session'] &&
				($this->Ktai->_options['use_redirect_session_id'] || $this->Ktai->is_imode())){
				if(!is_array($url)){
					if(preg_match('|^http[s]?://|', $url)){
					    if (!eregi("csid=", $url)) {
						$prefix = ereg("\?", $url) ? "&" : "?";
						$url = $url.$prefix."csid=".session_id();
					    }
					    return $url;
					}
					$url = Router::parse($url);
				}
				if(!isset($url['?'])){
					$url['?'] = array();
				}
				if (!isset($url['?']['guid'])) {
				    $url['?']['guid'] = 'on'; // guid=onを付加
				}
				if (!isset($url['?'][session_name()])) {
				    if ($this->Ktai->is_imode()) {
					$url['?'][session_name()] = session_id();
				    } else {
					$url['?']['csid'] = session_id(); // session_idを不可
				    }
				}
			}
		}
		return $url;
	}
	function redirect($url, $status = null, $exit = true){
                //guid=onを付加
		if ($this->Ktai->is_imode())
		{
		    $prefix = ereg("\?", $url) ? "&" : "?";
		    $url = $url.$prefix."guid=ON";
		}
		return parent::redirect($this->__redirect_url($url), $status, $exit);
	}

	public function beforeRender() {
	    TransactionManager::destructs();
	    if (isset($_SERVER['HTTPS'])) {
		if ($this->Ktai->is_ezweb()) {
		    Configure::write('App.encoding', 'Shift_JIS');
		    header("Content-Type: text/html;charset=sjis-win");
		}
	    }
	}

	public function beforeRedirect() {
		TransactionManager::destructs();
	}

	public function afterRender() {
	    //AuのSSL文字化け対策
	    if (isset($_SERVER['HTTPS'])) {
		if ($this->Ktai->is_ezweb()) {
		    $outBuffer = ob_get_clean();
		    $outBuffer = mb_convert_encoding($outBuffer, "sjis-win", "UTF-8");
		    
		    mb_http_output("sjis-win");
		    ob_start("mb_output_handler");

		    header("Content-Type: text/html;charset=sjis-win");

		    echo $outBuffer;
		}
	    }
	}
}
