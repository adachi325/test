<?php
/* Present Test cases generated on: 2011-03-10 14:03:09 : 1299733269*/
App::import('Model', 'Present');

class PresentTestCase extends CakeTestCase {
	var $fixtures = array('app.present', 'app.issue', 'app.line', 'app.child', 'app.user', 'app.child_present', 'app.diary', 'app.theme', 'app.postcard_url', 'app.content');

	function startTest() {
		$this->Present =& ClassRegistry::init('Present');
	}

	function endTest() {
		unset($this->Present);
		ClassRegistry::flush();
	}

}
?>