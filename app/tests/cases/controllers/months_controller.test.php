<?php
/* Months Test cases generated on: 2011-03-14 13:03:18 : 1300075218*/
App::import('Controller', 'Months');

class TestMonthsController extends MonthsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MonthsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.month', 'app.present', 'app.theme', 'app.diary', 'app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.child_present', 'app.postcard_url');

	function startTest() {
		$this->Months =& new TestMonthsController();
		$this->Months->constructClasses();
	}

	function endTest() {
		unset($this->Months);
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