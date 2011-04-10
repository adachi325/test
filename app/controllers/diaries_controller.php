<?php

class DiariesController extends AppController {

    var $name = 'Diaries';

    function index($year = null, $month = null, $page = null) {

        $setOptions = array();
        //表示データ年月設定
        if(empty($year) or empty($month)) {
            //年月を設定
            //セッション情報回収、削除
            $deleteDiaryReturn = $this->Session->read('deleteDiaryReturn');
            $this->Session->delete('deleteDiaryReturn');
            if(!empty($deleteDiaryReturn)) {
                $setOptions['year'] = $deleteDiaryReturn['year'];
                $setOptions['month'] = $deleteDiaryReturn['month'];
            } else {
                $setOptions['year'] = date('Y');
                $setOptions['month'] = date('m') + 0;
            }
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
            $conditions;
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->Tk->_getLastChild(),
                    'Diary.month_id' => $months['0']['Month']['id'],
                    'Diary.has_image' => 1,
                    'Diary.error_code' => null
                ),
                'order'=>array('Diary.created DESC')
            );
            //表示データ一覧取得
            $diariesTop = $this->Diary->find('all', $conditions);
            $this->set(compact('diariesTop'));

            $conditions;
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->Tk->_getLastChild(),
                    'Diary.month_id' => $months['0']['Month']['id']
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
            '(Month.year+0), (Month.month+0)'
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

    function checkPost($hash = null){

        //hashを確認し、データがなければリダイレクト
        if(!empty($this->data['Diary']['nexthash'])){
            $hash=$this->data['Diary']['nexthash'];
        }

        if(empty($hash)){
            $this->Session->setFlash(__('不正操作です。', true));
            $this->redirect('/children/');
        }
        $this->Diary->contain('Present','Month');
        $conditions = array(
            'conditions' => array(
                'Diary.child_id' => $this->Tk->_getLastChild(),
                'Diary.hash' => $hash
            ),
            'order'=>array('Diary.created DESC')
        );
        $diary = $this->Diary->find('first', $conditions);
        $this->set(compact('diary'));

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
                    'Diary.child_id' => $this->Tk->_getLastChild(),
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
        $request['Diary']['child_id'] = $this->Tk->_getLastChild();
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
                    'Diary.child_id' => $this->Tk->_getLastChild(),
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

            $child_id = $this->Tk->_getLastChild();

            $this->Diary->contain('Month');
            $diary = $this->Diary->find('first', array( 'conditions' => array( 'Diary.id = '.$id , 'Diary.child_id = '.$child_id)));

            if(empty($diary)){
                 $this->Session->setFlash(__('不正操作です。', true));
                 $this->redirect('/children/');
            }
            //削除用の配列作成
            $deleteCondition = array("Diary.id" => $id);

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
                if (file_exists('img/'.sprintf(Configure::read('Diary.image_path_thumb'), $child_id,$id))) {
                    if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_thumb'), $child_id,$id) )){
                        //$this->Session->setFlash(__('思い出画像の削除に失敗した可能性があります。', true));
                    }
                }
                if (file_exists('img/'.sprintf(Configure::read('Diary.image_path_rect'), $child_id,$id))) {
                    if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_rect'), $child_id,$id) )){
                        //$this->Session->setFlash(__('思い出画像の削除に失敗した可能性があります。', true));
                    }
                }
                if (file_exists('img/'.sprintf(Configure::read('Diary.image_path_postcard'), $child_id,$id))) {
                    if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_postcard'), $child_id,$id) )){
                        //$this->Session->setFlash(__('思い出画像の削除に失敗した可能性があります。', true));
                    }
                }
            }
            //削除した思い出の月へ戻る
            $setOptions = array();
            $setOptions['year'] = $diary['Month']['year'];
            $setOptions['month'] = $diary['Month']['month'];
            $this->Session->write('deleteDiaryReturn', $setOptions);
            parent::redirect('/diaries/index/');
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
                'Diary.child_id' => $this->Tk->_getLastChild(),
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
            $this->set('yyy',date('Y')+0);
            $this->set('mmm',date('m')+0);
            $this->render('un_dc_user');
            return;
        }
        //データ取得
        $this->Diary->contain('Month');
        $conditions = array(
            'conditions' => array(
                'Diary.child_id' => $this->Tk->_getLastChild(),
                'Diary.id' => $id
            )
        );
        $diary = $this->Diary->find('first', $conditions);
        if(empty($diary)){
            $this->Session->setFlash(__('エラー', true));
            $this->redirect('/children/');
        }
        $this->set(compact('diary'));

		// create mail info
        if(strlen($diary['Diary']['title']) > 9){
            $mailTitle = mb_substr($diary['Diary']['title'],0,9);
        }else {
            $mailTitle = $diary['Diary']['title'];
        }
        $this->set('mailTitle',$mailTitle);

		if(strlen($diary['Diary']['body']) > 100){
			$mailBody = mb_substr($diary['Diary']['body'],0,100);
		} else {
			$mailBody = $diary['Diary']['body'];
		}
		$this->set('mailBody',$mailBody);

		// not dc_user
        $userData = $this->Auth->user();
        if(!$userData['User']['dc_user']) {
            $this->set('yyy',$diary['Month']['year']);
            $this->set('mmm',$diary['Month']['month']);
            $this->render('post_info');
            return;
        }

		// not i-mode
        if(!$this->Ktai->is_imode()){
            $this->render('post_sb_au');
            return;
        }
    }

    function post_info(){
        $this->set('yyy',date('Y')+0);
        $this->set('mmm',date('m')+0);
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

if ($diary['Diary']['has_image']) {
$list[1] = '
<html>
<title>'.$diary['Diary']['title'].'</title>
<body bgcolor="#FFFF8E">

<div align="center"><img src="cid:00" width="50" hight="50"></div>
<div align="center"><img src="cid:01" width="100" hight="100"></div>
<div align="center">'.$diary['Diary']['body'].'</div>
<div align="center"><img src="cid:02" width="50" hight="50"></div>

</body>
</html>

';

} else {
$list[1] = '
<html>
<title>'.$diary['Diary']['title'].'</title>
<body bgcolor="#FFFF8E">

<div align="center"><img src="cid:00" width="50" hight="50"></div>
<div align="center">'.$diary['Diary']['body'].'</div>
<div align="center"><img src="cid:02" width="50" hight="50"></div>

</body>
</html>

';
}

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

if ($diary['Diary']['has_image']) {
$list[4] = '
--5000000000
Content-Type: image/jpeg; name='.$diary['Diary']['id'].'.jpg'.'
Content-Transfer-Encoding: base64
Content-ID: <01>

';
$img = file_get_contents('img/'.sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $diary['Diary']['id']));
$jpeg_enc = base64_encode($img);
$list[5] = $jpeg_enc;

$list[6] = '
--5000000000
Content-Type: image/jpeg; name='.'diaryback_'.$diary['Month']['year'].$imgMonth.'_footer.jpg'.'
Content-Transfer-Encoding: base64
Content-ID: <02>

';

$img = file_get_contents(sprintf(Configure::read('Present.path.diaryback_f'), $diary['Month']['year'], $imgMonth));
$jpeg_enc = base64_encode($img);
$list[7] = $jpeg_enc;


$list[8] ='
--5000000000--
';

} else {
$list[4] = '
--5000000000
Content-Type: image/jpeg; name='.'diaryback_'.$diary['Month']['year'].$imgMonth.'_footer.jpg'.'
Content-Transfer-Encoding: base64
Content-ID: <02>

';

$img = file_get_contents(sprintf(Configure::read('Present.path.diaryback_f'), $diary['Month']['year'], $imgMonth));
$jpeg_enc = base64_encode($img);
$list[5] = $jpeg_enc;

$list[6] ='
--5000000000--
';

}

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
