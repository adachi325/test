<?php
/* PostcardUrl Test cases generated on: 2011-03-10 14:03:46 : 1299733306*/
App::import('Model', 'PostcardUrl');

class PostcardUrlTestCase extends CakeTestCase {
	var $fixtures = array('app.postcard_url', 'app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.child_present', 'app.theme', 'app.diary');

	function startTest() {
		$this->PostcardUrl =& ClassRegistry::init('PostcardUrl');
	}

	function endTest() {
		unset($this->PostcardUrl);
		ClassRegistry::flush();
	}

}
?>