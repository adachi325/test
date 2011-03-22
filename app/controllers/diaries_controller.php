<?php

class DiariesController extends AppController {

    var $name = 'Diaries';

    function index($year = null, $month = null, $page = null) {

        $setOptions = array();
        //表示データ年月設定
        if(empty($year) or empty($month)) {
            //年月を設定
            $setOptions['year'] = date('Y');
            $setOptions['month'] = date('m') + 0;
        } else {
            //不正パラメータチェック
            if(
                 ($year >= date('Y') && (date('m') + 0) < $month) or
                 ($year > date('Y'))
            ) {
                 $this->redirect('/diaries/');
            }
            //年月を設定
            $setOptions['year'] = $year;
            $setOptions['month'] = $month;
        }

        //オプションをフィールドに設定
        $this->set('options',$setOptions);

        //思い出投稿時用にセッションに設定
        $this->Session->write('setOptions', $setOptions);

        $month =& ClassRegistry::init('Month');
        $month->contain();
        $months = $month->find('all',array('conditions' => $setOptions));

        if(!empty($months)){
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->_getLastChild(),
                    'Diary.month_id' => $months['0']['Month']['id'],
                ),
                'order'=>array('Diary.created DESC')
            );
            //表示データ一覧取得
            $diaries = $this->Diary->find('all', $conditions);
            $this->set(compact('diaries'));
        } else {
            //月データが存在しない場合は不正操作
            $this->redirect('/diaries/');
        }

        //前月表示フラグ設定
        $beforeOptions['order'] = array(
            'Month.year, Month.month'
        );
        $month->contain();
        $beforeFlag = $month->find('first',$beforeOptions);
        $this->set('beforeFlag',$beforeFlag);

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
        $conditions = array(
            'conditions' => array(
                'Diary.child_id' => $this->_getLastChild(),
                'Diary.hash' => $hash
            )
        );
        $diary = $this->Diary->find('first', $conditions);

        if(empty($diary)){
            //再チェックボタン用にハッシュタグを設定
            $this->set('nexthash',$hash);
            //unknown
            $this->render('post_unknown');
            return;
        }
        //投稿反映画面の表示文言を設定
        if(!empty($diary['Present']['id'])) {
            $typelist = array('壁紙','デコメ絵文字','待受けFLASH','ポストカード');
            $this->set('getStr',$typelist[$diary['Present']['present_type']]);
        }

        $this->set(compact('diary'));

    }

    function edit($id=null){

        //セッション情報回収、削除
        $diaryEditData = $this->Session->read('diaryEditData');
        $this->Session->delete('diaryEditData');
        if(!empty($diaryEditData)){
            $this->data = $diaryEditData;
        }
        $diaryEditValidationErrors = $this->Session->read('diaryEditValidationErrors');
        $this->Session->delete('diaryEditValidationErrors');
        if(!empty($diaryEditValidationErrors)){
            $this->Diary->set($this->data);
            $this->Diary->validates();
        }

        if (empty($this->data)){
            if(empty($id)){
                 $this->Session->setFlash(__('不正操作です', true));
                 $this->redirect('/children/');
            }
            //データ取得
            $this->Diary->contain('Month');
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->_getLastChild(),
                    'Diary.id' => $id
                )
            );
            $diary = $this->Diary->find('first', $conditions);
            if(empty($diary)){
                 $this->Session->setFlash(__('エラー', true));
                 $this->redirect('/children/');
            }
            $this->data = $diary;
        }
    }

    function edit_confirm(){
        if(empty($this->data)){
             $this->Session->setFlash(__('エラー', true));
             $this->redirect('/children/');
        }
        $request = array();
        $request = $this->data;
        $userData = $this->Auth->user();
        $request['Diary']['child_id'] = $this->_getLastChild();
        $this->data = $request;
        $this->Diary->set($this->data);
        if(!$this->Diary->validates()){
            $this->Session->setFlash(__('入力項目に不備があります。', true));
            $this->Session->write('diaryEditData', $this->data);
            $this->Session->write('diaryEditValidationErrors', $this->validateErrors($this->Diary));
            $this->redirect('/diaries/edit/');
        }
        $this->Session->write('diaryEditData', $this->data);
    }

    function edit_complete(){
        //セッション情報回収、削除
        $this->data = $this->Session->read('diaryEditData');
        $this->Session->delete('diaryEditData');

        if (!empty($this->data)) {
            TransactionManager::begin();
            try {
                $this->Diary->create();
                if ($this->Diary->save($this->data)) {
                    TransactionManager::commit();
                    $this->Session->setFlash(__('更新完了。', true));
                    $this->Session->write('diaryEditCompleteId', $this->data['Diary']['id']);
                    $this->redirect('/diaries/info');
                } else {
                    TransactionManager::rollback();
                    $this->Session->setFlash(__('更新失敗。', true));
                    $this->redirect('/children/');
                }
            } catch(Exception $e) {
              TransactionManager::rollback();
              $this->Session->setFlash(__('システムエラー。', true));
              $this->redirect('/children/');
            }
        } else {
             $this->Session->setFlash(__('不正操作です。', true));
             $this->redirect('/children/');
        }
    }

    function delete($id = null){
            if(empty($id)){
                 $this->Session->setFlash(__('不正操作です', true));
                 $this->redirect('/children/');
            }
            //データ取得
            $this->Diary->contain('Month');
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->_getLastChild(),
                    'Diary.id' => $id
                )
            );
            $diary = $this->Diary->find('first', $conditions);
            if(empty($diary)){
                 $this->Session->setFlash(__('エラー', true));
                 $this->redirect('/children/');
            }
            $this->data = $diary;
    }

    function delete_complete(){
            if(empty($this->data) or
               empty($this->data['Diary']['check'])){
                 $this->Session->setFlash(__('不正操作です', true));
                 $this->redirect('/children/');

            }
            $id = $this->data['Diary']['check'];

            $child_id = $this->_getLastChild();

            $this->Diary->contain();
            $diary = $this->Diary->find('first', array( 'conditions' => array( 'id = '.$id , 'child_id = '.$child_id)));

            if(empty($diary)){
                 $this->Session->setFlash(__('不正操作です。', true));
                 $this->redirect('/children/');
            }
            //削除用の配列作成
            $deleteCondition = array("id" => $id);
            
            //子供IDに紐付く子供情報、思い出情報、獲得プレゼント情報を削除
            TransactionManager::begin();
            try {
                $this->Diary->contain();
                if ($this->Diary->deleteAll($deleteCondition)) {
                    TransactionManager::commit();
                    $this->Session->setFlash(__('削除完了。', true));
                } else {
                    TransactionManager::rollback();
                    $this->Session->setFlash(__('削除失敗。', true));
                }
            } catch(Exception $e) {
              TransactionManager::rollback();
              $this->Session->setFlash(__('システムエラー。', true));
              $this->redirect('/children/');
            }

            if($diary['Diary']['has_image']) {
                if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_thumb'), $child_id,$id) )){
                    //$this->Session->setFlash(__('思い出画像の削除に失敗した可能性があります。', true));
                }
                if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_rect'), $child_id,$id) )){
                    //$this->Session->setFlash(__('思い出画像の削除に失敗した可能性があります。', true));
                }
            }

    }

    function info($id=null){

        if(empty($id)){
            //セッション情報回収、削除
            $diaryEditCompleteId = $this->Session->read('diaryEditCompleteId');
            $this->Session->delete('diaryEditCompleteId');
            if(!empty($diaryEditCompleteId)){
                $id = $diaryEditCompleteId;
            } else {
                $this->Session->setFlash(__('不正操作です。', true));
                $this->redirect('/children/');
            }
        }
        //データ取得
        $this->Diary->contain('Month');
        $conditions = array(
            'conditions' => array(
                'Diary.child_id' => $this->_getLastChild(),
                'Diary.id' => $id
            )
        );
        $diary = $this->Diary->find('first', $conditions);
        if(empty($diary)){
             $this->Session->setFlash(__('エラー', true));
             $this->redirect('/children/');
        }
        $this->set(compact('diary'));
    }

    function post($id=null){
        if(empty($id)){
            $this->Session->setFlash(__('エラー', true));
            $this->redirect('/children/');
        }
        //データ取得
        $this->Diary->contain('Month');
        $conditions = array(
            'conditions' => array(
                'Diary.child_id' => $this->_getLastChild(),
                'Diary.id' => $id
            )
        );
        $diary = $this->Diary->find('first', $conditions);        
        if(empty($diary)){
            $this->Session->setFlash(__('エラー', true));
            $this->redirect('/children/');
        }
        $userData = $this->Auth->user();
        if(!$userData['User']['dc_user']) {
            $this->set('un_dc_user',true);
        } else {
            $this->set('un_dc_user',false);
        }
        $this->set('id',$diary['Diary']['id']);
    }

    function downlord($id=null){

        if(empty($id)){
            $this->Session->setFlash(__('エラー', true));
            $this->redirect('/children/');
        }

        //データ取得
        $this->Diary->contain('Month');
        $conditions = array(
            'conditions' => array(
                'Diary.child_id' => $this->_getLastChild(),
                'Diary.id' => $id
            )
        );
        $diary = $this->Diary->find('first', $conditions);

        if(empty($diary)){
            $this->Session->setFlash(__('エラー', true));
            $this->redirect('/children/');
        }

        $filepath = 'img/photo/'.$diary['Diary']['child_id'].'/'.$diary['Diary']['id'].'.dmt';
        $fp = fopen($filepath, "w"); // 新規書き込みモードで開く

        $list = array();

//ファイルへの書き込み処理
$list[0] = 'Decomail-Template
MIME-Version: 1.0
Content-Type: multipart/related;boundary="5000000000"

--5000000000
Content-Type: text/html; charset=Shift_JIS
Content-Transfer-Encoding: 8bit
';

$list[1] = '
<html>
<title>'.$diary['Diary']['title'].'</title>
<body bgcolor="#FFFF8E">

<div align="center"><img src="cid:00" width="50" hight="50"></div>
<div align="center">'.$diary['Diary']['body'].'</div>

</body>
</html>

';

if($diary['Month']['month'] < 10) {
    $imgMonth = '0'.$diary['Month']['month'];
}else {
    $imgMonth = $diary['Month']['month'];
}

$list[2] = '--5000000000
Content-Type: image/jpeg; name='.'diaryback_'.$diary['Month']['year'].$imgMonth.'_header.jpg'.'
Content-Transfer-Encoding: base64
Content-ID: <00>

';
$img = file_get_contents(sprintf(Configure::read('Present.path.diaryback_h'), $diary['Month']['year'], $imgMonth));
$jpeg_enc = base64_encode($img);
$list[3] = $jpeg_enc;

$list[4] ='
--5000000000--
';

        while(list($key,$value) = each($list)){
                $value = mb_convert_encoding($value,  'Shift_JIS', 'UTF-8');
                @fwrite( $fp, $value, strlen($value) );
        }


        
        fclose($fp);
        //ファイルへの書き込みは終了

        $file_length = filesize($filepath);
        header("Content-Disposition: attachment; filename=$filepath");
        header("Content-Length:$file_length");
        header("Content-Type: application/octet-stream");

        readfile ($filepath);

    }

}
?>
