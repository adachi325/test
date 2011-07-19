<?php
App::import('Shell', 'AppShell');

class Step3AddChildPresentsShell extends AppShell {

  /*
   * STEP3用。child_presentsテーブルへ、present_idが３と４がないユーザーのデータを追加します。
   * 前提:
   *   - Step2のDBがあること
   */
  function main() {
    /* chil_presentを作成 */
    $this->_addChildPresent(3);
    $this->_addChildPresent(4);
  }

  /*
   * 引数のｐｒｅｓｅｎｔＩＤがなければ、追加する。
   */
  function _addChildPresent($present_id) {
    echo '-----'.PHP_EOL;
    $ChildPresent =& ClassRegistry::init('ChildPresent');
    $ChildPresent->contain();
    $Child =& ClassRegistry::init('Child');
    $Child->contain();
  
    //child_present中にpresent_id=xのレコード
    $conditions_cp = array('present_id' => $present_id);
    $child_presents = $ChildPresent->find('all', array('conditions' => $conditions_cp));
    $cp_count = count($child_presents);
    // 全childred
    $children_all = $Child->find('all');
    $cnt_all = count($children_all);
    //
    echo count($children_all).'のchildren中、presernt_id='.$present_id.'を取得しているのは'.$cp_count.'人です'. PHP_EOL;    
    echo 'childpresentsテーブルへ追加します。対象レコード件数: ' . ($cnt_all-$cp_count) . PHP_EOL;
    
    echo 'processing...'.PHP_EOL;
    $cnt = 1;
    $ChildPresent->begin();
    foreach ($children_all as $child) {
        //print_r($child);
        if($cnt % 10 == 0){
            echo '処理件数：' . $cnt . '／' . $cnt_all . PHP_EOL;
        }
        $cnt++;
        $match_flag = FALSE;
        foreach ($child_presents as $cp){
            //print_r($cp);
            if($child['Child']['id'] === $cp['ChildPresent']['child_id']){
                $match_flag = true;
                break;
            }
        }
        if($match_flag){
            continue;
        }
        //追加
        $new_cp = array();
        $new_cp['ChildPresent']['child_id'] = $child['Child']['id'];
        $new_cp['ChildPresent']['present_id'] = $present_id;
        $new_cp['ChildPresent']['created'] = NULL;
        $new_cp['ChildPresent']['modified'] = NULL;
        $ChildPresent->create();
        if (!$ChildPresent->save($new_cp)) {
                echo 'faild child_id:'.$child['Child']['id'].PHP_EOL;
        }                        
    }
    $ChildPresent->commit();

    $conditions_cp = array('present_id' => $present_id);
    $child_presents = $ChildPresent->find('all', array('conditions' => $conditions_cp));
    echo 'Child_presents中のpresernt_id='.$present_id.'のレコード数:'.count($child_presents) . PHP_EOL;
    if($cnt_all === count($child_presents)){
        echo '全Childにpresent_id:'.$present_id.'が割り当てられました。';
    }else{
        echo '一部のChildにpresent_id:'.$present_id.'が割り当てられていません。failed child_idを参照してください。';
    }
    echo '-----'.PHP_EOL;    
  }

}
