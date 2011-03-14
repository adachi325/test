<?php

class DiariesController extends AppController {

	var $name = 'Diaries';
        
	function index() {

                
            //月設定
            $this->set('month',date('m') + 0);

            //年月を設定
            $setOptions['year'] = date('Y');
            $setOptions['month'] = date('m') - 1;
            $this->Session->write('setOptions', $setOptions);

            $this->Diary->contain();
            $diaries = $this->Diary->find('all', array('conditions'=>array('child_id' => $this->_getLastChild())));
            $this->set(compact('diaries'));

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
