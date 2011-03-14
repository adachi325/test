<?php
/* Themes Test cases generated on: 2011-03-14 13:03:09 : 1300075209*/
App::import('Controller', 'Themes');

class TestThemesController extends ThemesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ThemesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.theme', 'app.month', 'app.diary', 'app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.child_present', 'app.postcard_url');

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