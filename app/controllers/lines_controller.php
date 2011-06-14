<?php
class linesController extends AppController {

    var $name = 'Lines';

    // 使用するモデルを指定
    var $uses = array('Line', 'Diary', 'Child', 'Article', 'Hanamaru');
    var $helpers = array('Wikiformat.Wikiformat', 'DiaryCommon');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('top');
    }

    //最終子供ID更新
    function _saveLastChild($id){
        $userData = array();
        $userData = $this->Auth->user();
        $userData['User']['last_selected_child'] = $id;
        unset ($userData['User']['loginid']);
        unset ($userData['User']['carrier']);
        unset ($userData['User']['dc_user']);
        unset ($userData['User']['admin_user']);
        unset ($userData['User']['uid']);
        unset ($userData['User']['created']);
        unset ($userData['User']['modified']);
        $this->Child->saveLastChild($userData);
    }

    //子供情報取得
    function _setChild(){
        $userData = $this->Auth->user();
        $childData = $this->Child->find('all', array('conditions'=>array('user_id'=>$userData['User']['id'])));
        return $childData;
    }

    
    function _getChilddata($id = null, $line_id = null) {
        //子供データ一覧設定
        $childrenData = $this->_setChild();

        //最終子供ID更新
        if ($id !== null &&
            $id >= 0 && $id < count($childrenData)) {

                $updateId = $childrenData[$id]['Child']['id'];
                $this->_saveLastChild($updateId);
            }

        //最終子供ID設定
        $lastChildId = $this->Tk->_getLastChild();
        if ($lastChildId == 0) {
            if (count($childrenData)) {
                $lastChildId = $childrenData[0]['Child']['id'];
                $updateId = $lastChildId;
                $this->_saveLastChild($updateId);
            }
        }
        //最終子供情報取得
        $Child =& ClassRegistry::init('Child');

        $currentChild = $Child->findById($lastChildId);

        //月号データ取得
        $content =& ClassRegistry::init('Content');

        //babyの場合降順にする
        $sortStr = 'DESC';
        if($currentChild['Child']['line_id'] == '1'){
            $sortStr = 'ASC';
        }

        //ライン情報取得
        $lines = $Child->Line->find('list');
        if ($line_id) {
            $currentLine = $Child->Line->findByCategoryName($line_id);
        } else {
            $currentLine = $Child->Line->findById($currentChild['Child']['line_id']);
        }

        $conditions = array(
            'conditions' => array(
                'Content.line_id' => $currentLine['Line']['id'],
            ),
            'order'=>array('Content.release_date '.$sortStr)
        );
        $content->contain('Issue');
        $contents = $content->find('all', $conditions);

        //月データ取得
        $month =& ClassRegistry::init('month');
        $options = array();
        $options['year'] = date('Y');
        $options['month'] = date('m') + 0;
        $months = $month->find('all', array('conditions' => $options));

        //テーマ要素作成日順に入れ替える
        $result = array_reverse($months['0']['Theme']);
        $months['0']['Theme'] = $result;


        if(!empty($months)){
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->Tk->_getLastChild(),
                    'Diary.month_id' => $months['0']['month']['id'],
                    'Diary.has_image' => 1,
                    'Diary.error_code' => null
                ),
                'order'=>array('Diary.created DESC')
            );
            //表示データ一覧取得
            $diary =& ClassRegistry::init('diary');
            $diaries = $diary->find('all', $conditions);
        }

        $conditions = array(
            'conditions' => array(
                'Diary.child_id' => $this->Tk->_getLastChild(),
                'Diary.has_image' => 1,
                'Diary.error_code' => null
            ),
            'order'=>array('Diary.created DESC')
        );
        $prof_diary = $diary->find('first', $conditions);

        //ニュース取得
        $news =& ClassRegistry::init('news');
        $newslist = $news->find('all',array(
            'conditions' => array('start_at <= "'.date('Y-m-d H:i:s').'"','finish_at >= "'.date('Y-m-d H:i:s').'"' ),
            'order' => array('start_at DESC'),
        ));

        $this->set(compact('user','childrenData','lastChildId','currentChild','contents','months','lines','currentLine','diaries','prof_diary', 'newslist'));
    }
    
    function top($id = null, $line_id = null) {
        // 非会員の場合のチェック
        $this->_getChilddata($id, $line_id);

        $this->set('line_id', $line_id);

        if($this->Auth->user()) {
            $this->set('login_user',$this->Auth->user());

        } else {
            $line = $this->Line->find('first', array('Line.category_name' => $line_id));

            if (!empty($line)) {
                $name = $line['Line']['category_name'];
            } else {
                $name = "baby";
            }
            $this->redirect(Router::url("/ap/{$name}/", true));
            //$this->render('top_guest');
        }
    }

}
?>
