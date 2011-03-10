<?php
/* Line Test cases generated on: 2011-03-10 14:03:56 : 1299733316*/
App::import('Model', 'Line');

class LineTestCase extends CakeTestCase {
	var $fixtures = array('app.line', 'app.child', 'app.user', 'app.child_present', 'app.present', 'app.issue', 'app.content', 'app.theme', 'app.diary', 'app.postcard_url');

	function startTest() {
		$this->Line =& ClassRegistry::init('Line');
	}

	function endTest() {
		unset($this->Line);
		ClassRegistry::flush();
	}

}
?>