<?php
class TkComponent extends Object {
    /**
     * 呼び出し元コントローラーインスタンスの参照
     * @var Object AppController
     */
    var $controller;

    function initialize(&$controller){
            $this->controller = & $controller;
    }

    //最終子供ID取得
    function _getLastChild(){
        $userdata = array();
        $userdata = $this->controller->Auth->user();
        $User = ClassRegistry::init('User');
        $User = $User->find('first', array('conditions'=>array('id'=>$userdata['User']['id'])));
        return $User['User']['last_selected_child'];
    }

    // 子供取得
    // 自分の子供のIDを配列で返却します
    function _getChildIds() {
      $child_ids = array();

      $user = $this->controller->Auth->user();
      $Child = ClassRegistry::init('Child');
      $children = $Child->find('all', array('conditions' => array('user_id' => $user['User']['id'])));
      foreach ($children as $child) {
        array_push($child_ids, $child['Child']['id']);
      }
      return $child_ids;
    }

    function uidCheck(){
	if (isset($_SERVER['HTTPS'])) {
	    $uid = $this->controller->Session->read('sslUid');
	    if(empty($uid) || !isset($uid)) {
		$result = $this->_getCareer();
		if( $result == 0 or $result == 1 or $result == 2 ){
		    $urlItem = split('\/',$_SERVER["SCRIPT_NAME"]);
		    $this->controller->redirect('http://'.$_SERVER["SERVER_NAME"].'/'.$urlItem[1].'/pages/errorMobileId/');	
		    return;
		}
	    }
	}
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
}

?>
