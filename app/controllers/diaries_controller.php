<?php

class DiariesController extends AppController {

	var $name = 'Diaries';

	function index($year = null, $month = null, $page = null) {

            pr($year.'/'.$month.'/'.$page);

            //不正パラメータチェック

            $setOptions = array();

            //表示データ年月設定
            if(empty($year) or empty($month)) {
                //年月を設定
                $setOptions['year'] = date('Y');
                $setOptions['month'] = date('m') + 0;
            } else {
                //年月を設定
                $setOptions['year'] = $year;
                $setOptions['month'] = $month;
            }

            //オプションをフィールドに設定
            $this->set('options',$setOptions);

            $month =& ClassRegistry::init('Month');
            $month->contain();
            $months = $month->find('all',array('conditions' => $setOptions));

            if(!empty($months)){
                $conditions = array(
                    'conditions' => array(
                        'Diary.child_id' => $this->_getLastChild(),
                        'Diary.month_id' => $months['0']['Month']['id']
                    )
                );
                //表示データ一覧取得
                $diaries = $this->Diary->find('all', $conditions);
                $this->set(compact('diaries'));
            }

            //表示データ域設定
            if(empty($page)) {
                $this->set('page','1');
            } else {
                $this->set('page', $page);
            }
	}

        //最終子供ID取得
        function _getLastChild(){
            $userData = $this->Auth->user();
            $User = ClassRegistry::init('User');
            $User = $User->find('first', array('conditions'=>array('id'=>$userData['User']['id'])));
            return $User['User']['last_selected_child'];
        }

        function checkPost($hash = null){
            //hashを確認し、データがなければリダイレクト
            if(empty($hash)){
                $this->Session->setFlash(__('不正操作です。', true));
                $this->redirect('/children/');
            }
            $this->Diary->contain('Present');
            $diaryData = $this->Diary->find('first', array('conditions'=>array('hash' => $hash)));
            if(empty($diaryData)){
                //再チェックボタン用にハッシュタグを設定
                $this->set('nexthash',$hash);
                //unknown
                $this->render('post_unknown');
                return;
            }

            $this->set('diaryId',$diaryData['Diary']['id']);

            //投稿反映画面の表示文言を設定
            if(!empty($diaryData['Present']['id'])) {
                $this->_infoStr($diaryData);
            }

        }

        function _infoStr($data){
            $typelist = array('壁紙','デコメ絵文字','待受けFLASH','ポストカード');
            $this->set('getStr',$typelist[$data['Present']['present_type']]);
            $this->set('presentId',$data['Present']['id']);
        }
}
?>
