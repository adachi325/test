<?php
/* PostcardUrl Test cases generated on: 2011-03-31 14:03:09 : 1301550129*/
App::import('Model', 'PostcardUrl');

class PostcardUrlTestCase extends CakeTestCase {
	var $fixtures = array('app.postcard_url', 'app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.month', 'app.diary', 'app.theme', 'app.child_present');

	function startTest() {
		$this->PostcardUrl =& ClassRegistry::init('PostcardUrl');
	}

	function endTest() {
		unset($this->PostcardUrl);
		ClassRegistry::flush();
	}

	function testIsValiable() {

	}

}
?>