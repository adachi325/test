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

}

?>
