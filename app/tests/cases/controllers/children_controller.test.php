<?php
/* Children Test cases generated on: 2011-03-08 13:03:27 : 1299559527*/
App::import('Controller', 'Children');

class TestChildrenController extends ChildrenController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ChildrenControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.child_present', 'app.theme', 'app.diary', 'app.postcard_url');

	function startTest() {
		$this->Children =& new TestChildrenController();
		$this->Children->constructClasses();
	}

	function endTest() {
		unset($this->Children);
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