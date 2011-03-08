<?php
/* Presents Test cases generated on: 2011-03-08 13:03:11 : 1299559511*/
App::import('Controller', 'Presents');

class TestPresentsController extends PresentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PresentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.present', 'app.issue', 'app.line', 'app.child', 'app.user', 'app.child_present', 'app.diary', 'app.theme', 'app.postcard_url', 'app.content');

	function startTest() {
		$this->Presents =& new TestPresentsController();
		$this->Presents->constructClasses();
	}

	function endTest() {
		unset($this->Presents);
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