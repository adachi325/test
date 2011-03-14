<?php
/* ChildPresents Test cases generated on: 2011-03-14 13:03:00 : 1300075260*/
App::import('Controller', 'ChildPresents');

class TestChildPresentsController extends ChildPresentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ChildPresentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.child_present', 'app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.theme', 'app.month', 'app.diary', 'app.postcard_url');

	function startTest() {
		$this->ChildPresents =& new TestChildPresentsController();
		$this->ChildPresents->constructClasses();
	}

	function endTest() {
		unset($this->ChildPresents);
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