<?php
/* User Test cases generated on: 2011-03-10 14:03:51 : 1299733251*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.child', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.child_present', 'app.theme', 'app.diary', 'app.postcard_url');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

	function testRegister() {

	}

}
?>