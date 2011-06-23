<?php
App::import('Shell', 'AppShell');

class Step2DbMakeIdentifyTokenShell extends AppShell {

  /*
   * STEP2用のDBの、diariesテーブルのidentifyTokenにデータを作成します。
   * 前提:
   *   - Step2のDBがあること
   */
  function main() {
    /* identifyTokenを作成 */
    $this->makeIdentifyToken();
  }

  function makeIdentifyToken() {
    echo '-----'.PHP_EOL;
    $Diary =& ClassRegistry::init('Diary');
    $Diary->contain();
  
    $conditions = array('identify_token' => null);
    $diaries = $Diary->find('all', array('conditions' => $conditions));
    echo 'identify_tokenが設定されていないレコード件数: ' . count($diaries) . PHP_EOL;

    echo 'processing...'.PHP_EOL;
    foreach ($diaries as $diary) {
      $diary['Diary']['identify_token'] = $Diary->makeIdentifyToken();
			if (!$Diary->save($diary)) {
				echo 'faild id:'.$diary['Diary']['id'].PHP_EOL;
			}
    }
    echo '-----'.PHP_EOL;

    $diaries = $Diary->find('all', array('conditions' => $conditions));
    echo 'identify_tokenが設定されていないレコード件数: ' . count($diaries) . PHP_EOL;

  }

}
