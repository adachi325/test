<?php
/* News Test cases generated on: 2011-03-10 14:03:51 : 1299733311*/
App::import('Model', 'News');

class NewsTestCase extends CakeTestCase {
	var $fixtures = array('app.news');

	function startTest() {
		$this->News =& ClassRegistry::init('News');
	}

	function endTest() {
		unset($this->News);
		ClassRegistry::flush();
	}

}
?>