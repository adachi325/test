<?php
/* Attention Test cases generated on: 2011-05-31 10:05:09 : 1306806489*/
App::import('Model', 'Attention');

class AttentionTestCase extends CakeTestCase {
	var $fixtures = array('app.attention');

	function startTest() {
		$this->Attention =& ClassRegistry::init('Attention');
	}

	function endTest() {
		unset($this->Attention);
		ClassRegistry::flush();
	}

}
?>
