<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'Asia/Tokyo' for 'JST/9.0/no DST' instead in /Applications/MAMP/htdocs/step2/cake/console/templates/default/classes/test.ctp on line 22
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