
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
class KtaiAppController extends AppController {

    	//ktaiライブラリ設定
	public $ktai = array(
		'use_img_emoji' => true,
		'input_encoding' => 'UTF8',
		'output_encoding' => 'UTF8',
		'use_xml' => true,
		'enable_ktai_session' => true, //セッション使用を有効にします
		'use_redirect_session_id' => false, //リダイレクトに必ずセッションIDをつけます
		'imode_session_name' => 'csid', //iMODE時のセッション名を変更します
		'iphone_user_agent_belongs_to_softbank' => false,
		'use_xml' => false,
	);

	public $helpers = array('Ktai','Html', 'Form','Session','SelectOptions');
	public $components = array('Ktai','Auth','Session','Transition');
        public $layout = 'default';
        
	function beforeFilter(){
            parent::beforeFilter();
            $this->Auth->loginError = 'パスワードが違います。';
            $this->Auth->authError =  'ログインしてください';
            if($this->Ktai->is_imode()){
                $this->__formActionGuidOn();
                $this->__checkImodeId();
            }
            //キャリア判定＆UID取得
            if($this->Ktai->is_ktai()) {
                if( $this->__getCareer() == 0 or
                    $this->__getCareer() == 1 or
                    $this->__getCareer() == 2 ){
                    $uid = $this->Ktai->get_uid();
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
		if (empty($_SERVER["HTTP_X_DCMGUID"]))
                {
			#-------------------------------------------------
			# 「guid=ON」が渡ってこなければ付加してリダイレクト
			#-------------------------------------------------
			if (!eregi("guid=ON", $_SERVER["REDIRECT_QUERY_STRING"]))
			{
				if (isset($_SERVER["HTTP_HOST"]) && isset($_SERVER["REQUEST_URI"]))
				{
					$url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
					$this->redirect($url);
				}
			#-------------------------------------------------
			# 「guid=ON」が渡っているのにiモードIDがなければ(通知しない設定の場合)、エラーページ表示
			#-------------------------------------------------
			} else {
				$this->__showImodeidErrorPage();
			}
		}
	}

	function __showImodeidErrorPage()
	{
		$this->render(null, null, VIEWS.'pages'.DS.'imodeid_error.ctp');
		echo $this->output;
		exit;
	}

        //キャリア判定
        function __getCareer(){
            if ($this->Ktai->is_imode()) {
                return 0;
            } else if ($this->Ktai->is_ezweb()) {
                return 1;
            }else if ($this->Ktai->is_softbank()) {
                return 2;
            }else if ($this->Ktai->is_iphone()) {
                return 3;
            }else if ($this->Ktai->is_android()) {
                return 4;
            } else {
                return 5;
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
						return $url;
					}
					$url = Router::parse($url);
				}
				if(!isset($url['?'])){
					$url['?'] = array();
				}
				$url['?'][session_name()] = session_id();
                                $url['?']['guid'] = 'on'; // guid=onを付加
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
	}

	public function beforeRedirect() {
		TransactionManager::destructs();
	}
}