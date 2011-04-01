<?php
/* Diary Test cases generated on: 2011-03-31 14:03:11 : 1301550071*/
App::import('Model', 'Diary');

class DiaryTestCase extends CakeTestCase {
	var $fixtures = array('app.diary', 'app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.month', 'app.theme', 'app.child_present', 'app.postcard_url');

	function startTest() {
		$this->Diary =& ClassRegistry::init('Diary');
	}

	function endTest() {
		unset($this->Diary);
		ClassRegistry::flush();
	}

	function testImportMail() {
                $d =& $this->Diary;

                //正常系
//                $result = true;
//                $type='diary';
//                $data = array('to' => 'hogehoge@tangit.jp','subject' => 'hogehoge', 'title' => 'hogehoge', 'body' => 'hogehoge' , 'images' => 'hogehoge');
//                pr($d->ImportMail($data));
//		$this->assertTrue($d->ImportMail($data), '正常系');

                //異常系

	}

	function testAdd() {
                $d =& $this->Diary;
//                $result = true;
//                $data = array('to' => 'hogehoge@tangit.jp','subject' => 'hogehoge', 'title' => 'hogehoge', 'body' => 'hogehoge' , 'images' => 'hogehoge');
//                $this->assertTrue($d->testAdd($data), '正常系');
                
	}

}
?>