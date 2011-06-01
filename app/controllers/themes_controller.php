<?php
class ThemesController extends AppController {

    var $name = 'Themes';

    function index($assign = null,$setyear = null,$setmonth = null ) {
        if (!empty($assign)){
            //セッション情報回収
            $setOptions = $this->Session->read('setOptions');
            $this->Session->delete('setOptions');
            if (!empty($setOptions)){
                //前月の場合
                if($assign === 'before') {
                    if($setOptions['month'] == 1) {
                        $setOptions['year'] = $setOptions['year'] - 1;
                        $setOptions['month'] = 12;
                    } else {
                        $setOptions['month'] = $setOptions['month'] - 1;
                    }
                    if ($this->_monthsDataFind($setOptions)){
                        $this->redirect('/themes/');
                        return;
                    }
                //次月の場合
                } else if ($assign === 'next') {
                    if($setOptions['month'] == 12) {
                        $setOptions['year'] = $setOptions['year'] + 1;
                        $setOptions['month'] = 1;
                    } else {
                        $setOptions['month'] = $setOptions['month'] + 1;
                    }
                    if ($this->_monthsDataFind($setOptions)){
                        $this->redirect('/themes/');
                        return;
                    }
                } else if ($assign === 'diary') {

		    //クッキー対策
		    $setOptions['year'] = $setyear;
		    $setOptions['month'] = $setmonth;

                    if ($this->_monthsDataFind($setOptions)){
                        $this->redirect('/themes/');
                        return;
                    }
                }
            }
        }

        $months = $this->Session->read('monthData');
        if(!empty($months)){
            //該当一覧表示
            $this->set(compact('months'));

            //前月、次月表示判定フラグセット
            $this->_beforeNextFlgSet();

            //セッション情報削除
            $this->Session->delete('monthData');
            return;
        }

        $options = array();
        $options['year'] = date('Y');
        $options['month'] = date('m') + 0;
        if (!$this->_monthsDataFind($options)){
            $this->Session->setFlash(__('システムエラー', true));
            $this->redirect('/children/');
        }
        $this->redirect('/themes/');
    }

    function _monthsDataFind($options){
        $month =& ClassRegistry::init('Month');
        $months = $month->find('all',array('conditions' => $options));

        //テーマ要素作成日順に入れ替える
        $result = array_reverse($months['0']['Theme']);
        $months['0']['Theme'] = $result;

        if (!empty($months)){
            $this->Session->write('setOptions', $options);
            $this->Session->write('monthData', $months);
            $this->set(compact('months'));
            return true;
        } else {
            return false;
        }
    }

    //MAXまたはMINの月データを取得する。
    function _stockYearMonth($stockdatas=null,$order=null){
	if(empty($stockdatas) or !isset($stockdatas)){
	    $this->log('月データ取得中にエラーが発生',LOG_DEBUG);
	    $this->cakeError('error404');
	    return;
	}
	$stock;
	foreach($stockdatas as $data){
	    $data['Month']['month'] = (mb_strlen($data['Month']['month'])==1) ? '0'.$data['Month']['month'] : $data['Month']['month'] ;
	    if (!isset($stock)){
		$stock = $data;
	    }
	    if ($order==='MIN'){
		if ($data['Month']['year'].$data['Month']['month'] < $stock['Month']['year'].$stock['Month']['month']) {
		    $stock = $data;
		}
	    } else if ($order==='MAX'){
		if ($data['Month']['year'].$data['Month']['month'] > $stock['Month']['year'].$stock['Month']['month']) {
		    $stock = $data;
		}
	    } else {
		$this->log('条件不正',LOG_DEBUG);
		$this->cakeError('error404');
		return;
	    }
	}
	$stock['Month']['month'] = $stock['Month']['month']+0;
	return $stock;
    }

    function _beforeNextFlgSet(){

        $months = $this->Session->read('monthData');
        
        //前月フラグ設定
        $month =& ClassRegistry::init('Month');
	$month->contain();
        $monthData = $month->find('all');
	$stock = $this->_stockYearMonth($monthData,'MIN');

        if(
           (
            $months['0']['Month']['year'] > $stock['Month']['year']
           ) || (
            $months['0']['Month']['year'] == $stock['Month']['year'] &&
            $months['0']['Month']['month'] > $stock['Month']['month']
           )
          )
        {
            $this->set('beforeFlag', true);
        } else {
            $this->set('beforeFlag', false);
        }
        
        //次月フラグ設定
        if((
            $months['0']['Month']['year'] < date('Y')
           ) || 
            $months['0']['Month']['year'] == date('Y') &&
            $months['0']['Month']['month'] < (date('m') + 0)
          )
        {
            $this->set('nextFlag', true);
        } else {
            $this->set('nextFlag', false);
        }
    }

    //テーマ詳細表示
    function info($id = null){

         if(empty($id)){
             $this->Session->setFlash(__('不正操作', true));
             $this->redirect('/children/');
         }

         $theme = $this->Theme->read(null, $id);

         if(empty($theme)){
             $this->Session->setFlash(__('不正操作', true));
             $this->redirect('/children/');
         }

         $this->set(compact('theme'));

         //会員情報取得
         $userAuthData = $this->Auth->user();
         $user =& ClassRegistry::init('User');
         $user->contain();
         $userdata = $user->read(null,$userAuthData['User']['id']);

         if(empty($userdata)){
             $this->Session->setFlash(__('ログイン有効期限切れです。', true));
             $this->redirect('/children/');
         }
         
         //現在時刻にてhash作成
         $hash = substr(AuthComponent::password(date("Ymdhis")), 0, 4);

         //次へボタン用にハッシュタグを設定
         $this->set('nexthash',$hash);

         //メールアドレス生成
		 /*
         $mailStr = 'diary_'.$userdata['User']['id'].'.'.$userdata['User']['last_selected_child'].'.'.$id.'.'.$hash.'@'.Configure::read('Defaults.domain');
		  */

		 $Child =& ClassRegistry::init('Child');
		 $child = $Child->findById($userdata['User']['last_selected_child']);

		 $mailStr = 'diary_'.$userdata['User']['hash'].'.'.$child['Child']['hash'].'.'.$id.'.'.$hash.'@'.Configure::read('Defaults.domain');


         //タイトル設定
         if($theme['Theme']['free_theme']){
            $mailTitle = (date('m')+0).'月'.(date('d')+0).'日の思い出';
         } else {
            $mailTitle = $theme['Theme']['title'];
         }

         $this->set('mailStr', $mailStr);
         $this->set('mailTitle',$mailTitle);

    }
    

}
?>
