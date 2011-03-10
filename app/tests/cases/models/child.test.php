<?php
/* Child Test cases generated on: 2011-03-10 14:03:05 : 1299733325*/
App::import('Model', 'Child');

class ChildTestCase extends CakeTestCase {
	var $fixtures = array('app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.child_present', 'app.theme', 'app.diary', 'app.postcard_url');

	function startTest() {
		$this->Child =& ClassRegistry::init('Child');
	}

	function endTest() {
		unset($this->Child);
		ClassRegistry::flush();
	}

}
?>