<?php
/* Hanamaru Test cases generated on: 2011-05-16 16:05:21 : 1305529941*/
App::import('Model', 'Hanamaru');

class HanamaruTestCase extends CakeTestCase {
	var $fixtures = array('app.hanamaru');

	function startTest() {
		$this->Hanamaru =& ClassRegistry::init('Hanamaru');
	}

  function testGetHanamaruCount(){

    //---------- ユーザーのはなまる総数取得テスト
    // 存在するユーザーで実施 
    $count = $this->Hanamaru->getHanamaruCount(1);
    $this->assertEqual($count, 2);

    // 存在しないユーザーで実施
    $count = $this->Hanamaru->getHanamaruCount(242424);
    $this->assertEqual($count, 0);
  }

	function endTest() {
		unset($this->Hanamaru);
		ClassRegistry::flush();
	}

}
?>
