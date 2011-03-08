<?php
/* PostcardUrls Test cases generated on: 2011-03-08 13:03:07 : 1299559507*/
App::import('Controller', 'PostcardUrls');

class TestPostcardUrlsController extends PostcardUrlsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PostcardUrlsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.postcard_url', 'app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.child_present', 'app.theme', 'app.diary');

	function startTest() {
		$this->PostcardUrls =& new TestPostcardUrlsController();
		$this->PostcardUrls->constructClasses();
	}

	function endTest() {
		unset($this->PostcardUrls);
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