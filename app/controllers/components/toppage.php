<?php
class ToppageComponent extends Object {
    /**
     * 呼び出し元コントローラーインスタンスの参照
     * @var Object AppController
     */
    var $controller;

    var $components = array('Tk');

    function initialize(&$controller){
        $this->controller = & $controller;
    }

    //最終子供ID更新
    function saveLastChild($id){
        $userData = array();
        $userData = $this->controller->Auth->user();
        $userData['User']['last_selected_child'] = $id;

        unset ($userData['User']['loginid']);
        unset ($userData['User']['carrier']);
        unset ($userData['User']['dc_user']);
        unset ($userData['User']['admin_user']);
        unset ($userData['User']['uid']);
        unset ($userData['User']['created']);
        unset ($userData['User']['modified']);

        $Child =& ClassRegistry::init('Child');
        $Child->saveLastChild($userData);

        $Child->User->contain();

        return $userData;
    }

    //子供情報取得
    function setChild(){
        $userData = $this->controller->Auth->user();
        $Child =& ClassRegistry::init('Child');
        $childData = $Child->find('all', array('conditions'=>array('user_id'=>$userData['User']['id'])));
        return $childData;
    }

    // こども情報取得
    function getChilddata($index = null) {
        $Child =& ClassRegistry::init('Child');
        
        //子供データ一覧設定
        $childrenData = $this->setChild();

        //最終子供ID更新
        if ($index !== null && $index > 0 && $index <= count($childrenData)) {
            
            $updateId = $childrenData[$index - 1]['Child']['id'];
            $this->saveLastChild($updateId);
        }

        //最終子供ID設定
        $lastChildId = $this->Tk->_getLastChild();
        
        if ($lastChildId == 0) {
            if (count($childrenData)) {
                $lastChildId = $childrenData[0]['Child']['id'];
                $updateId = $lastChildId;
                $this->saveLastChild($updateId);
            }
        }

        //最終子供情報取得
        $currentChild = $Child->findById($lastChildId);

        $this->controller->set(compact('childrenData','currentChild','lastChildId'));

        return $currentChild;
    }

    function getLinedata($line_name = null) {
        //　月号データ取得
        $Content =& ClassRegistry::init('Content');
        $Child =& ClassRegistry::init('Child');


        // ライン名取得
        if ($line_name) {
            $currentLine = $Child->Line->findByCategoryName($line_name);
        } else {
            //$currentChild = $this->getChilddata();
            $lastChildId = $this->Tk->_getLastChild();
            $currentChild = $Child->findById($lastChildId);

            $currentLine = $Child->Line->findById($currentChild['Child']['line_id']);
        }

        //babyの場合降順にする
        $sortStr = 'DESC';
        if($currentLine['Line']['id'] == '1'){
            $sortStr = 'ASC';
        }

        //ライン情報取得
        $lines = $Child->Line->find('list');

        $conditions = array(
            'conditions' => array(
                'Content.line_id' => $currentLine['Line']['id'],
            ),
            'order'=>array('Content.release_date '.$sortStr, 'Content.id DESC')
        );
        $Content->contain('Issue');
        $contents = $Content->find('all', $conditions);

        $this->controller->set(compact('contents','lines','currentLine'));

        return $contents;
    }

    function getProfiledata() {

        $lastChildId = $this->Tk->_getLastChild();

        $Diary =& ClassRegistry::init('Diary');
        $conditions = array(
            'conditions' => array(
                'Diary.child_id' => $lastChildId,
                'Diary.has_image' => 1,
                'Diary.error_code' => null
            ),
            'order'=>array('Diary.created DESC')
        );
        $prof_diary = $Diary->find('first', $conditions);

        $this->controller->set(compact('prof_diary'));
        return $prof_diary;
    }

    function getDiarydata() {

        //月データ取得
        $Month =& ClassRegistry::init('Month');
        $options = array();
        $options['year'] = date('Y');
        $options['month'] = date('m') + 0;

        // 動的に条件を指定します sugimoto
        $Month->contain('Theme');
        $Month->hasMany['Theme']['conditions'] = 'Theme.release_date <= "'.date("Y-m-d H:i:s").'"';
        $months = $Month->find('all', array('conditions' => $options));
        // 他に影響が出ないように元に戻しておきます 
        $Month->hasMany['Theme']['conditions'] = null;

        //テーマ要素作成日順に入れ替える
        $result = array_reverse($months['0']['Theme']);
        $months['0']['Theme'] = $result;

        $lastChildId = $this->Tk->_getLastChild();
        if(!empty($months)){
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $lastChildId,
                    'Diary.month_id' => $months['0']['Month']['id'],
                    //'Diary.has_image' => 1,
                    //'Diary.error_code' => null
                ),
                'order'=>array('Diary.created DESC')
            );
            //アルバム部分取得
            $Diary =& ClassRegistry::init('diary');
            $diaries = $Diary->find('all', $conditions);
        }
        $this->controller->set(compact('months','diaries'));
    }

    function getNewsdata() {
        //ニュース取得
        $News =& ClassRegistry::init('news');
        $newslist = $News->find('all',array(
            'conditions' => array('start_at <= "'.date('Y-m-d H:i:s').'"','finish_at >= "'.date('Y-m-d H:i:s').'"' ),
            'order' => array('start_at DESC'),
        ));

        $this->controller->set(compact('newslist'));
        return $newslist;
    } 

}

?>
