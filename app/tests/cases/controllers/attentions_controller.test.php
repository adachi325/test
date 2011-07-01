<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'Asia/Tokyo' for 'JST/9.0/no DST' instead in /Applications/MAMP/htdocs/step2/cake/console/templates/default/classes/test.ctp on line 22
/* Attentions Test cases generated on: 2011-05-31 10:05:57 : 1306806477*/
App::import('Controller', 'Attentions');

class TestAttentionsController extends AttentionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AttentionsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.attention');

	function startTest() {
		$this->Attentions =& new TestAttentionsController();
		$this->Attentions->constructClasses();
	}

	function endTest() {
		unset($this->Attentions);
		ClassRegistry::flush();
	}

}
?>