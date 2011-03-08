<?php
/* Contents Test cases generated on: 2011-03-08 13:03:31 : 1299559531*/
App::import('Controller', 'Contents');

class TestContentsController extends ContentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ContentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.content', 'app.line', 'app.child', 'app.user', 'app.child_present', 'app.present', 'app.issue', 'app.theme', 'app.diary', 'app.postcard_url');

	function startTest() {
		$this->Contents =& new TestContentsController();
		$this->Contents->constructClasses();
	}

	function endTest() {
		unset($this->Contents);
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