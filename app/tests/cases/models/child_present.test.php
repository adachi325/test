<?php
/* ChildPresent Test cases generated on: 2011-03-10 14:03:30 : 1299733290*/
App::import('Model', 'ChildPresent');

class ChildPresentTestCase extends CakeTestCase {
	var $fixtures = array('app.child_present', 'app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.theme', 'app.diary', 'app.postcard_url');

	function startTest() {
		$this->ChildPresent =& ClassRegistry::init('ChildPresent');
	}

	function endTest() {
		unset($this->ChildPresent);
		ClassRegistry::flush();
	}

}
?>