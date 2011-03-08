<?php
/* Issues Test cases generated on: 2011-03-08 13:03:39 : 1299559539*/
App::import('Controller', 'Issues');

class TestIssuesController extends IssuesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class IssuesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.issue', 'app.line', 'app.child', 'app.user', 'app.child_present', 'app.present', 'app.diary', 'app.theme', 'app.postcard_url', 'app.content');

	function startTest() {
		$this->Issues =& new TestIssuesController();
		$this->Issues->constructClasses();
	}

	function endTest() {
		unset($this->Issues);
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