<?php
/* Diaries Test cases generated on: 2011-03-08 13:03:35 : 1299559535*/
App::import('Controller', 'Diaries');

class TestDiariesController extends DiariesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DiariesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.diary', 'app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.child_present', 'app.theme', 'app.postcard_url');

	function startTest() {
		$this->Diaries =& new TestDiariesController();
		$this->Diaries->constructClasses();
	}

	function endTest() {
		unset($this->Diaries);
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