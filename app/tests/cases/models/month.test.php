<?php
/* Month Test cases generated on: 2011-03-14 13:03:17 : 1300075217*/
App::import('Model', 'Month');

class MonthTestCase extends CakeTestCase {
	var $fixtures = array('app.month', 'app.present', 'app.theme', 'app.diary', 'app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.child_present', 'app.postcard_url');

	function startTest() {
		$this->Month =& ClassRegistry::init('Month');
	}

	function endTest() {
		unset($this->Month);
		ClassRegistry::flush();
	}

}
?>