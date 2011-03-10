<?php
/* Content Test cases generated on: 2011-03-10 14:03:40 : 1299733240*/
App::import('Model', 'Content');

class ContentTestCase extends CakeTestCase {
	var $fixtures = array('app.content', 'app.line', 'app.child', 'app.user', 'app.child_present', 'app.present', 'app.issue', 'app.theme', 'app.diary', 'app.postcard_url');

	function startTest() {
		$this->Content =& ClassRegistry::init('Content');
	}

	function endTest() {
		unset($this->Content);
		ClassRegistry::flush();
	}

}
?>