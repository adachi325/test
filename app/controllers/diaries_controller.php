<?php
class DiariesController extends AppController {

    var $name = 'Diaries';

    var $uses = array('Diary', 'Child', 'Article', 'Hanamaru');

    var $helpers = array('DiaryCommon');
    var $components = array('Toppage');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('top', 'register', 'get_news_count', 'post_info', 'api_create_thumbnail');
    }

    function top($index = null) {
		//ログイン済みならマイページへ遷移
        if($this->Auth->user()) {
            $user = $this->Auth->user();

            
            $this->set('login_user',$this->Auth->user());
            
            $this->Toppage->getChilddata($index);
            
            $this->Toppage->getDiarydata();
            $this->Toppage->getProfiledata();
            $this->Toppage->getNewsdata();

            $this->index();

        } else {
            $this->render('top_guest');
        }
    }

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
                 //$this->redirect('/diaries/');
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
            // 表示データ一覧（アルバム）取得
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->Tk->_getLastChild(),
                    'Diary.month_id' => $months['0']['Month']['id'],
                    // 'Diary.has_image' => 1,
                    // 'Diary.error_code' => null
                ),
                'order'=>array('Diary.created DESC')
              );
            $diariesTop = $this->Diary->find('all', $conditions);
            $this->set(compact('diariesTop'));

            // 表示データ一覧（思い出一覧）取得
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->Tk->_getLastChild(),
                    'Diary.month_id' => $months['0']['Month']['id']
                ),
                'order'=>array('Diary.created DESC')
            );
            $this->Diary->contain('Article');
            $diaries = $this->Diary->find('all', $conditions);
            $this->set(compact('diaries'));
        } else {
            //月データが存在しない場合は不正操作
            //$this->redirect('/diaries/');
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
            $this->redirect('/');
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
    
    //postデータからの制御コード除去
	function _check_code() {
		$diary_attrs = array(
							'title',
							'body',
							'wish_public',
							'id',
							'check',
		);
		foreach ($diary_attrs as $attr){
			if (isset($this->data['Diary'][$attr])) {
				$this->data['Diary'][$attr] = $this->check_invalid_code($this->data['Diary'][$attr]);
			}
		}
	}
    
    function edit($id=null){
	
	/* uidﾁｪｯｸ */
	$this->Tk->uidCheck();

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
                 $this->redirect('/');
            }
            //データ取得
            $this->Diary->contain();
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->Tk->_getChildIds(),
                    'Diary.id' => $id
                )
            );
            $diary = $this->Diary->find('first', $conditions);
            if(empty($diary)){
                 $this->Session->setFlash(__('エラー', true));
                 $this->redirect('/');
            }
            $this->data = $diary;
        }
    }

    function edit_confirm() {
	
	/* uidﾁｪｯｸ */
	$this->Tk->uidCheck();

        // 不正遷移チェック
        if(empty($this->data)){
             $this->Session->setFlash(__('エラー', true));
             $this->redirect('/');
        }

        // DBよりデータを取得
        $conditions = array(
            'conditions' => array(
                'Diary.child_id' => $this->Tk->_getChildIds(),
                'Diary.id' => $this->data['Diary']['id'],
            )
        );
        $this->Diary->Contain('Article');
        $diary = $this->Diary->find('first', $conditions);
        if(empty($diary)){
          $this->Session->setFlash(__('エラー', true));
          $this->redirect('/');
        }

        //postデータチェック
        $this->_check_code();
        
        $request = array();

        // DBより取得したデータに、POSTされたデータで上書きする
        $request = $diary;
        $request['Diary']['title'] = $this->data['Diary']['title'];
        $request['Diary']['body'] = $this->data['Diary']['body'];
        $request['Diary']['permit_status'] = $diary['Diary']['permit_status'];
        $request['Diary']['wish_public'] = $diary['Diary']['wish_public'];
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
	
	/* uidﾁｪｯｸ */
	$this->Tk->uidCheck();

        //セッション情報回収、削除
        $this->data = $this->Session->read('diaryEditData');
        $this->Session->delete('diaryEditData');

        if (!empty($this->data)) {
            TransactionManager::begin();
            try {
                // パラメータの初期化(審査のやり直し)
                $this->data['Diary']['permit_status'] = ($this->data['Diary']['wish_public']==1) ? 1 : 0;	//公開希望なら１、希望しないなら０
		$this->data['Diary']['modified'] = null;	//modified自動更新のための処理

                $this->Diary->create();
                if ($this->Diary->save($this->data)) {

                    $this->delete_relative_data($this->data['Diary']['id']);

                    TransactionManager::commit();
                    $this->Session->setFlash(__('更新完了。', true));
                    $this->Session->write('diaryEditCompleteId', $this->data['Diary']['id']);
                    $this->redirect('/diaries/info');
                } else {
                    TransactionManager::rollback();
                    $this->Session->setFlash(__('更新失敗。', true));
                    $this->redirect('/');
                }
            } catch(Exception $e) {
              TransactionManager::rollback();
              $this->Session->setFlash(__('システムエラー。', true));
              $this->redirect('/');
            }
        } else {
             $this->Session->setFlash(__('不正操作です。', true));
             $this->redirect('/');
        }
    }

    function delete($id = null){
            if(empty($id)){
                 $this->Session->setFlash(__('不正操作です', true));
                 $this->redirect('/');
            }
            //データ取得
            $this->Diary->contain('Month');
            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->Tk->_getChildIds(),
                    'Diary.id' => $id
                )
            );
            $diary = $this->Diary->find('first', $conditions);
            if(empty($diary)){
                 $this->Session->setFlash(__('エラー', true));
                 $this->redirect('/');
            }
            $this->data = $diary;
    }

    function delete_relative_data($diary_id = null) {
        if ($diary_id ==  null) {
            return;
        }

        // articlesテーブルからのレコード削除
        $conditions = array('type' => 1, 'external_id' => $diary_id);
        $article = $this->Article->find('first', array('conditions' => $conditions));
        if ($article) {
            $this->Article->delete($article['Article']['id']);
        }

        // hanamaruテーブルからのレコード削除
        $hanamarus = $this->Hanamaru->find('all', array('conditions' => $conditions));
        foreach ($hanamarus as $hanamaru) {
          $this->Hanamaru->delete($hanamaru['Hanamaru']['id']);
        }
    }

    function delete_complete(){
            if(empty($this->data) or
               empty($this->data['Diary']['check'])){
                 $this->Session->setFlash(__('不正操作です', true));
                 $this->redirect('/');

            }
            
            //制御文字対策
            $this->_check_code();
            
            $id = $this->data['Diary']['check'];

            $child_ids = $this->Tk->_getChildIds();

            $this->Diary->contain('Month');
            $diary = $this->Diary->find('first', array( 'conditions' => array( 'Diary.id' => $id , 'Diary.child_id' => $child_ids)));

            if(empty($diary)){
                 $this->Session->setFlash(__('不正操作です。', true));
                 $this->redirect('/');
            }
            //削除用の配列作成
            $deleteCondition = array("Diary.id" => $id);

            //子供IDに紐付く子供情報、思い出情報、獲得プレゼント情報を削除
            //思い出IDに紐づく記事、はなまるを削除
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
                $this->delete_relative_data($id);

            } catch(Exception $e) {
                TransactionManager::rollback();
                $this->Session->setFlash(__('システムエラー。', true));
                $this->redirect('/');
            }

            if($diary['Diary']['has_image']) {
                if (file_exists('img/'.sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $id))) {
                    if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $id) )){
                        //$this->Session->setFlash(__('思い出画像の削除に失敗した可能性があります。', true));
                    }
                }
                if (file_exists('img/'.sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $id))) {
                    if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $id) )){
                        //$this->Session->setFlash(__('思い出画像の削除に失敗した可能性があります。', true));
                    }
                }
                if (file_exists('img/'.sprintf(Configure::read('Diary.image_path_postcard'), $diary['Diary']['child_id'], $id))) {
                    if(!unlink('img/'.sprintf(Configure::read('Diary.image_path_postcard'), $diary['Diary']['child_id'], $id) )){
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
              $this->redirect('/');
            }
        }

        // 思い出データ取得
        $this->Diary->contain('Month', 'Article');
        $conditions = array(
            'conditions' => array(
                // 'Diary.child_id' => $this->Tk->_getLastChild(),
                'Diary.id' => $id
            )
        );
        $diary = $this->Diary->find('first', $conditions);
        if (empty($diary)) {

            $this->set('message', 'この思い出記録は削除されています。');
            $this->render('info_error');
            return;
        }
        $this->set(compact('diary'));

        /*
         * パターン
         * ログイン済み かつ 自分の思い出
         * ログイン済み かつ 他人の思い出
         * 未ログイン
         */
        $isLogin = false;
        $isOwner = false;
        $children = null;

        // ログイン判定、ユーザーデータ登録
        $user = $this->Auth->user();
        if ($user) {
          $this->set(compact('user'));

          $isLogin = true;
          $children = $this->Child->find('all', array('conditions' => array('user_id' => $user['User']['id'])));
          foreach ($children as $child) {
            // はなまるをすでに押しているか
            $alreadyAddHanamaru = $this->Hanamaru->checkAlreadyAddHanamaru($user['User']['id'], $diary['Diary']['id']);
            $this->set(compact('alreadyAddHanamaru'));

            if ($diary['Diary']['child_id'] == $child['Child']['id']) {
              $isOwner = true;
              break;
            } else {
            }
          }
        }

        // 他ユーザーの思い出へのアクセス
        if (!$isOwner) {
            if ($this->__checkPublish($diary)) {
               $currentChild = $this->Child->findById($diary['Diary']['child_id']);
               $this->set(compact('currentChild'));
               $this->render('info_public');
            } else {
                $this->set('message', 'このお友達の様子は現在非公開に設定されています。');
                $this->render('info_error');
               //$this->redirect('/');
            }
        }
          
    }

    // 思い出記録が公開されているか判定する
    function __checkPublish($diary) {

      $isPublish = false;

	//release_dateが設定されていなければ、公開しない
	if(empty($diary['Article']['release_date'])){
		return $isPublish;
	}

      if ($diary['Diary']['wish_public'] == 1 && $diary['Diary']['permit_status'] == 2) {
        $current_time = time();
        $publish_time = strtotime($diary['Article']['release_date']);

        if ($current_time > $publish_time) {
          $isPublish = true;
        }
      }

      return $isPublish;
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
                'Diary.child_id' => $this->Tk->_getChildIds(),
                'Diary.id' => $id
            )
        );
        $diary = $this->Diary->find('first', $conditions);
        if(empty($diary)){
            $this->Session->setFlash(__('エラー', true));
            $this->redirect('/');
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
	$users =& ClassRegistry::init('User');
	$user = $users->read(null,$userData['User']['id']);

        if(!$user['User']['dc_user']) {
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
            $this->redirect('/');
        }

        //データ取得
        $this->Diary->contain('Month');
        $conditions = array(
            'conditions' => array(
                'Diary.child_id' => $this->Tk->_getChildIds(),
                'Diary.id' => $id
            )
        );
        $diary = $this->Diary->find('first', $conditions);

        if(empty($diary)){
            $this->Session->setFlash(__('エラー', true));
            $this->redirect('/');
        }

	$dir = 'img/photo/'.$diary['Diary']['child_id'].'/';
	if (!file_exists($dir)) {
		mkdir($dir,0777);
		chmod($dir, 0777);
		system("chmod 777 ".$dir);
	}

        $filepath = $dir.$diary['Diary']['id'].'.dmt';
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
<head></head>
<body bgcolor="#e9f7ff">

<div align="center"><img src="cid:00"></div>
<br>
<div align="center">'.h($diary['Diary']['title']).'</div>
<br>
<div align="center"><img src="cid:01"></div>
<br>
<div align="center">'.nl2br(h($diary['Diary']['body'])).'</div>
<br>
<div align="right">'.date('n月d日', strtotime($diary['Diary']['created'])).'</div>
<div align="center"><img src="cid:02"></div>

</body>
</html>
';

} else {
$list[1] = '
<html>
<body bgcolor="#FFFF8E">

<div align="center"><img src="cid:00" width="50" hight="50"></div>
<br>
<div align="center">'.h($diary['Diary']['title']).'</div>
<br>
<div align="center">'.nl2br(h($diary['Diary']['body'])).'</div>
<br>
<div align="right">'.date('n月d日', strtotime($diary['Diary']['created'])).'</div>
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
Content-Type: image/jpeg; name='.'"diaryback_'.$diary['Month']['year'].$imgMonth.'_header.jpg"'.'
Content-Transfer-Encoding: base64
Content-ID: <00>

';
$img = file_get_contents(sprintf(Configure::read('Present.path.diaryback_h'), $diary['Month']['year'], $imgMonth));
$jpeg_enc = chunk_split(base64_encode($img),76,PHP_EOL);
$list[3] = $jpeg_enc;

if ($diary['Diary']['has_image']) {
$list[4] = '--5000000000
Content-Type: image/jpeg; name="'.$diary['Diary']['id'].'_thumb.jpg"'.'
Content-Transfer-Encoding: base64
Content-ID: <01>

';
$img = file_get_contents('img/'.sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $diary['Diary']['id']));
$jpeg_enc = chunk_split(base64_encode($img),76,PHP_EOL);
$list[5] = $jpeg_enc;

$list[6] = '--5000000000
Content-Type: image/jpeg; name='.'"diaryback_'.$diary['Month']['year'].$imgMonth.'_footer.jpg"'.'
Content-Transfer-Encoding: base64
Content-ID: <02>

';

$img = file_get_contents(sprintf(Configure::read('Present.path.diaryback_f'), $diary['Month']['year'], $imgMonth));
$jpeg_enc = chunk_split(base64_encode($img),76,PHP_EOL);
$list[7] = $jpeg_enc;


$list[8] ='--5000000000--
';
} else {
$list[4] = '--5000000000
Content-Type: image/jpeg; name='.'"diaryback_'.$diary['Month']['year'].$imgMonth.'_footer.jpg"'.'
Content-Transfer-Encoding: base64
Content-ID: <02>

';

$img = file_get_contents(sprintf(Configure::read('Present.path.diaryback_f'), $diary['Month']['year'], $imgMonth));
$jpeg_enc = chunk_split(base64_encode($img),76,PHP_EOL);
$list[5] = $jpeg_enc;

$list[6] ='--5000000000--
';
}

        while(list($key,$value) = each($list)){
                $value = mb_convert_encoding($value,  'sjis-win', 'UTF-8');
                $value = str_replace("\n","\r\n",$value);
                @fwrite( $fp, $value, strlen($value) );
        }

        fclose($fp);
        //ファイルへの書き込みは終了

        chmod($filepath, 0777);

        $file_length = filesize($filepath);
        
        header("Content-Length:$file_length");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=$filepath");

        $this->log($file_length,LOG_DEBUG);
        $this->log($filepath,LOG_DEBUG);

        readfile ($filepath);

    }

    function edit_picture($id = null, $angle = 0) {
        if (empty($id) || ($id == null)) {
            $this->Session->setFlash(__('不正操作です', true));
            $this->redirect('/');
        }
        //データ取得
        $this->Diary->contain();
        $diary = $this->Diary->findById($id);

        if(empty($diary)){
            $this->Session->setFlash(__('エラー', true));
            $this->redirect('/');
        }

        $diary['Diary']['temppath'] = $this->Diary->_getTemppath($id, $diary);

        if ($angle == 0) {
            if (!file_exists($diary['Diary']['temppath']['image_path_thumb'])) {
                $this->Diary->createTempPicture($id);
            }
        } else {
            $this->Diary->rotate($id, $angle);
        }
        $this->data = $diary;
        $this->set('diary', $diary);
    }

    function edit_picture_confirm($id = null) {
        //データ取得
        $this->Diary->contain();
        $diary = $this->Diary->findById($id);

        if(empty($diary)){
            $this->Session->setFlash(__('エラー', true));
            $this->redirect('/');
        }
        $diary['Diary']['temppath'] = $this->Diary->_getTemppath($id, $diary);
        $this->data = $diary;
        $this->set('diary', $diary);
    }

    function edit_picture_complete($id = null) {
        $this->Diary->saveTempfile($id);
        $this->Session->write('diaryEditCompleteId', $id);
        $this->redirect('/diaries/info');
    }

    function edit_public($id=null){

        //セッション情報回収、削除
        $diaryEditPublicData = $this->Session->read('diaryEditPublicData');
        $this->Session->delete('diaryEditPublicData');
        if(!empty($diaryEditPublicData)){
            $this->data = $diaryEditPublicData;
        }
        $diaryEditPublicValidationErrors = $this->Session->read('diaryEditPublicValidationErrors');
        $this->Session->delete('diaryEditPublicValidationErrors');
        if(!empty($diaryEditPublicValidationErrors)){
            $this->Diary->set($this->data);
            $this->Diary->validates();
        }

        if (empty($this->data)){
            if (empty($id)) {
                $this->Session->setFlash(__('不正操作です', true));
                $this->redirect('/');
            }

            $owner = $this->Diary->getOwner($id) {
                if (!$this->check_owner($owner)) {
                    $this->Session->setFlash(__('不正操作です', true));
                    $this->redirect('/');
                }
            }

            $conditions = array(
                'conditions' => array(
                    'Diary.child_id' => $this->Tk->_getChildIds(),
                    'Diary.id' => $id
                )
            );

            $this->Diary->contain('Article');
            $diary = $this->Diary->find('first', $conditions);
            if(empty($diary)){
                $this->Session->setFlash(__('エラー', true));
                $this->redirect('/');
            }

            $this->data = $diary;
            // オリジナルの公開希望フラグをセッションに格納する
            $this->Session->write('wish_public_origin', $diary['Diary']['wish_public']);
        }

        // 公開希望フラグ(オリジナル)をviewに渡す。（セッションに無い場合は再取得する。）
        $wish_public_origin = $this->Session->read('wish_public_origin');
        if (!empty($wish_public_origin)) {
          $this->set(compact('wish_public_origin'));
        } else {
          $conditions = array(
            'conditions' => array(
              'Diary.child_id' => $this->Tk->_getChildIds(),
              'Diary.id' => $id
            ),
          );
          $diary = $this->Diary->find('first', $conditions);
          $this->set('wish_public_origin', $diary['Diary']['wish_public']);
        }

    }

    function edit_public_confirm(){

        // 不正遷移チェック
        if(empty($this->data)){
             $this->Session->setFlash(__('エラー', true));
             $this->redirect('/');
        }

        $this->data['Diary']['wish_public'] = $this->check_invalid_code($this->data['Diary']['wish_public']);

        // DBよりデータを取得
        $conditions = array(
            'conditions' => array(
                'Diary.child_id' => $this->Tk->_getChildIds(),
                'Diary.id' => $this->data['Diary']['id'],
            )
        );
        $diary = $this->Diary->find('first', $conditions);
        if(empty($diary)){
          $this->Session->setFlash(__('エラー', true));
          $this->redirect('/');
        }
        
        //postデータチェック
        $this->_check_code();
        
        $request = array();

        $request = $diary;
        $request['Diary']['wish_public'] = $this->data['Diary']['wish_public'];
        $this->data = $request;
        $this->Diary->set($this->data);
        if(!$this->Diary->validates()){
            $this->Session->setFlash(__('入力項目に不備があります。', true));
            $this->Session->write('diaryEditPublicData', $this->data);
            $this->Session->write('diaryEditPublicValidationErrors', $this->validateErrors($this->Diary));
            $this->redirect('/diaries/edit_public/');
        }
        $this->Session->write('diaryEditPublicData', $this->data);
    }

    function edit_public_complete(){

        //セッション情報回収、削除
        $this->data = $this->Session->read('diaryEditPublicData');
        $this->Session->delete('diaryEditPublicData');

        if (!empty($this->data)) {
            
            $this->data['Diary']['wish_public'] = $this->check_invalid_code($this->data['Diary']['wish_public']);

            TransactionManager::begin();
            try {
                // パラメータの初期化(審査のやり直し)
                $this->data['Diary']['permit_status'] = 1;	//申請中
		        $this->data['Diary']['modified'] = null;	//modified自動更新のための処理

                $this->Diary->create();
                $this->Diary->whitelist = array('wish_public');
                if ($this->Diary->save($this->data)) {

                    $this->delete_relative_data($this->data['Diary']['id']);

                    TransactionManager::commit();
                    $this->Session->setFlash(__('更新完了。', true));
                    $this->Session->write('diaryEditCompleteId', $this->data['Diary']['id']);
                    $this->redirect('/diaries/info');
                } else {
                    TransactionManager::rollback();
                    $this->Session->setFlash(__('更新失敗。', true));
                    $this->redirect('/');
                }
            } catch(Exception $e) {
              TransactionManager::rollback();
              $this->Session->setFlash(__('システムエラー。', true));
              $this->redirect('/');
            }
        } else {
             $this->Session->setFlash(__('不正操作です。', true));
             $this->redirect('/');
        }
    }

    /*
     * ニュース本数取得API
     *
     * ニュースの一日あたりの本数を取得します。
     *
     * out: ニュース本数(csv形式)
     */
    function get_news_count() {

        // 現在日付を取得
        $today = date("Y-m-d");

        // articlesテーブル内の本日付け配信数をカウントする
        $conditions = array(
            'DATE_FORMAT(Article.release_date, \'%Y-%m-%d\')' => $today,
        );
        $count = $this->Article->find('count', array('conditions' => $conditions));

        // 出力データの設定
        $data = array($count);
        $this->set(compact('count'));

        // 出力設定
        Configure::write('debug', 0); // 警告を出さない
        $this->layout = null;
        header("Content-Type: text/plain"); 
    }


    /*
     * 公開に際しての注意事項
     */
    function publish() {
   
    }

 /**
   * ｽﾏｰﾄﾌｫﾝ用ｻｲﾑﾈｲﾙ作成API(step3)
   * 引数の条件でｻﾑﾈｲﾙを作成する
   * 作成結果を返す。
   *
   * @param     int  $child_id       対象Child
   * @param     int  $diary_id       対象Child
   * @param     string  $inputfile      縮小対象ﾌｧｲﾙ
   * @param     string  $inputfilepath  縮小対象ﾌｧｲﾙﾊﾟｽ
   * @return    String  $result            処理結果:true=成功、false=失敗
  */
	function api_create_thumbnail(){

		//ｵｰﾄﾚﾝﾀﾞｰ解除
		$this->autoRender = false;

		$retval_false = '"false"';
		$urlParams = array();
		$url_params = array('child_id', 'diary_id', 'inputfile', 'inputfilepath');
		foreach ($url_params as $attr){
			if(!isset($this->params['url'][$attr])){
				$this->log('必須パラメータがありません。'.$attr, LOG_DEBUG);
				return $retval_false;
			}
			$value = $this->params['url'][$attr];
			//null文字対策
			if(isset($value)){
				$value = $this->check_invalid_code($value);
			}
			//urldecode
			$value = urldecode($value);
			//文字列長check
			$vallen = strlen($value);
			if($vallen < 1 || 512 < $vallen)
			{
				$this->log('不正な文字列長:len of '.$attr.'='.$vallen, LOG_DEBUG);
				return $retval_false;
			}
			$urlParams[$attr] = $value;
		}
		//個別チェック
		if(!preg_match("/^[0-9]+$/", $urlParams['child_id'])){
			$this->log('不正なパラメータ:child_id='.$urlParams['child_id'], LOG_DEBUG);
			return $retval_false;
		}
                
		if(!preg_match("/^[0-9]+$/", $urlParams['diary_id'])){
			$this->log('不正なパラメータ:size='.$urlParams['diary_id'], LOG_DEBUG);
			return $retval_false;
		}
		//元ファイル
        $in_file_path = $urlParams['inputfilepath'];
        /*
		if(strstr($in_file_path, WWW_ROOT) == false){
			$in_file_path = WWW_ROOT.DS.$in_file_path;
			$in_file_path = str_replace(DS.DS, DS, $in_file_path);
        }
         */
		$in_file_path .= DS.$urlParams['inputfile'];
		$in_file_path = str_replace(DS.DS, DS, $in_file_path);
                if(!file_exists($in_file_path)){
			$this->log('不正なinputfile='.$in_file_path, LOG_DEBUG);
			return $retval_false;                    
                }
                //データ読み込み
		$fp = fopen( $in_file_path, "r" );
		$image = fread($fp, filesize($in_file_path));
		fclose( $fp );
                
		//画像保存(オリジナル)
		$image_path_original = sprintf(IMAGES . Configure::read('Diary.image_path_original'), $urlParams['child_id'], $urlParams['diary_id']);
		$this->Diary->__mkdir($image_path_original);
		$fp = fopen( $image_path_original, "w" );
		fwrite( $fp, $image, strlen($image) );
		fclose( $fp );
		$info = getimagesize($image_path_original);

		if (!empty($info) && $info[2] == IMAGETYPE_JPEG) {
                    /**************　携帯用画像　***************/
                    //サムネイル画像保存(比率保持)
                    $image_path_thumb = sprintf(IMAGES . Configure::read('Diary.image_path_thumb'), $urlParams['child_id'], $urlParams['diary_id']);
                    $this->Diary->__saveImageFile($image, $image_path_thumb);
                    $this->Diary->__resize_image($image_path_thumb, Configure::read('Diary.image_size_thumb'), false);
                    chmod($image_path_thumb, 0644);

                    //サムネイル画像保存(正方形)
                    $image_path_rect = sprintf(IMAGES . Configure::read('Diary.image_path_rect'), $urlParams['child_id'], $urlParams['diary_id']);
                    $this->Diary->__saveImageFile($image, $image_path_rect);
                    $this->Diary->__resize_image($image_path_rect, Configure::read('Diary.image_size_rect'), true);
                    chmod($image_path_rect, 0644);

                    //ポストカード用埋め込み画像保存(正方形)
                    $image_path_postcard = sprintf(IMAGES . Configure::read('Diary.image_path_postcard'), $urlParams['child_id'], $urlParams['diary_id']);
                    $this->Diary->__saveImageFile($image, $image_path_postcard);
                    $this->Diary->__resize_image($image_path_postcard, Configure::read('Diary.image_size_postcard'), true);
                    chmod($image_path_postcard, 0777);//ポストカード用は777
                    
                    /**************　スマホ用画像　***************/
                    //サムネイル画像保存(比率保持)
                    $image_path_thumb_4sp = sprintf(IMAGES . Configure::read('Diary.image_path_thumb_for_smartphone'), $urlParams['child_id'], $urlParams['diary_id']);
                    $this->Diary->__saveImageFile($image, $image_path_thumb_4sp);
                    $this->Diary->__resize_image($image_path_thumb_4sp, Configure::read('Diary.image_size_thumb_for_smartphone'), false);
                    chmod($image_path_thumb_4sp, 0644);

                    //サムネイル画像保存(正方形)
                    $image_path_rect_wallpaper_4sp = sprintf(IMAGES . Configure::read('Diary.image_path_rect_for_smartphone'), $urlParams['child_id'], $urlParams['diary_id']);
                    $this->Diary->__saveImageFile($image, $image_path_rect_wallpaper_4sp);
                    $this->Diary->__resize_image($image_path_rect_wallpaper_4sp, Configure::read('Diary.image_size_rect_for_smartphone'), true);
                    chmod($image_path_rect_wallpaper_4sp, 0644);
                  
                    //ポストカード用埋め込み画像保存(正方形)
                    $image_path_postcard_4sp = sprintf(IMAGES . Configure::read('Diary.image_path_postcard_for_smartphone'), $urlParams['child_id'], $urlParams['diary_id']);
                    $this->Diary->__saveImageFile($image, $image_path_postcard_4sp);
                    $this->Diary->__resize_image($image_path_postcard_4sp, Configure::read('Diary.image_size_postcard_for_smartphone'), true);
                    chmod($image_path_postcard_4sp, 0777);//ポストカード用は777

                    //壁紙用埋め込み画像保存(正方形)
                    $image_path_wallpaper_4sp = sprintf(IMAGES . Configure::read('Diary.image_path_wallpaper_for_smartphone'), $urlParams['child_id'], $urlParams['diary_id']);
                    $this->Diary->__saveImageFile($image, $image_path_wallpaper_4sp);
                    $this->Diary->__resize_image($image_path_wallpaper_4sp, Configure::read('Diary.image_size_wallpaper_for_smartphone'), true);
                    chmod($image_path_wallpaper_4sp, 0777);//ポストカード用は777
		}
                
		return '"true"';
                
	}
    
}

?>
