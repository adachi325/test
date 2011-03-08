<?php
/* Themes Test cases generated on: 2011-03-08 13:03:15 : 1299559515*/
App::import('Controller', 'Themes');

class TestThemesController extends ThemesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ThemesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.theme', 'app.issue', 'app.line', 'app.child', 'app.user', 'app.child_present', 'app.present', 'app.diary', 'app.postcard_url', 'app.content');

	function startTest() {
		$this->Themes =& new TestThemesController();
		$this->Themes->constructClasses();
	}

	function endTest() {
		unset($this->Themes);
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