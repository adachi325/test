<?php
/* Issue Test cases generated on: 2011-03-10 14:03:37 : 1299733297*/
App::import('Model', 'Issue');

class IssueTestCase extends CakeTestCase {
	var $fixtures = array('app.issue', 'app.line', 'app.child', 'app.user', 'app.child_present', 'app.present', 'app.diary', 'app.theme', 'app.postcard_url', 'app.content');

	function startTest() {
		$this->Issue =& ClassRegistry::init('Issue');
	}

	function endTest() {
		unset($this->Issue);
		ClassRegistry::flush();
	}

}
?>