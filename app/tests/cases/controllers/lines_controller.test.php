<?php
/* Lines Test cases generated on: 2011-03-08 13:03:16 : 1299559456*/
App::import('Controller', 'Lines');

class TestLinesController extends LinesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class LinesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.line', 'app.child', 'app.user', 'app.child_present', 'app.present', 'app.issue', 'app.content', 'app.theme', 'app.diary', 'app.postcard_url');

	function startTest() {
		$this->Lines =& new TestLinesController();
		$this->Lines->constructClasses();
	}

	function endTest() {
		unset($this->Lines);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>