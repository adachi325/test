<?php
/* Presents Test cases generated on: 2011-03-14 01:03:03 : 1300035243*/
App::import('Controller', 'Presents');

class TestPresentsController extends PresentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PresentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.present', 'app.theme', 'app.diary', 'app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.child_present', 'app.postcard_url');

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