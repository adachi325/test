<?php
/* Diary Test cases generated on: 2011-03-10 14:03:59 : 1299733319*/
App::import('Model', 'Diary');

class DiaryTestCase extends CakeTestCase {
	var $fixtures = array('app.diary', 'app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.child_present', 'app.theme', 'app.postcard_url');

	function startTest() {
		$this->Diary =& ClassRegistry::init('Diary');
	}

	function endTest() {
		unset($this->Diary);
		ClassRegistry::flush();
	}

	function testAddByEmail() {
		$u =& $this->Diary;
		$data = array(
			'to' => 'diary_1.1.5.abcd@shimajiro-dev.com',
			'subject' => 'たいとる',
			'body' => 'ほんぶん本文',
			'image' => '',
		);
		$this->assertTrue($u->addByEmail($data));
	}


}
?>