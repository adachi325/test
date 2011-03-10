<?php
/* Theme Test cases generated on: 2011-03-10 14:03:20 : 1299733280*/
App::import('Model', 'Theme');

class ThemeTestCase extends CakeTestCase {
	var $fixtures = array('app.theme', 'app.issue', 'app.line', 'app.child', 'app.user', 'app.child_present', 'app.present', 'app.diary', 'app.postcard_url', 'app.content');

	function startTest() {
		$this->Theme =& ClassRegistry::init('Theme');
	}

	function endTest() {
		unset($this->Theme);
		ClassRegistry::flush();
	}

}
?>