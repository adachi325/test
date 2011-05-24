<?php
App::import('Model', 'Diary');

class DiaryTestCase extends CakeTestCase {
	var $fixtures = array('app.diary');

	function startTest() {
		$this->Diary =& ClassRegistry::init('Diary');
  }

  function testmakeIdentifyToken() {
    // 10桁で帰ってくるかのテスト
    $token = $this->Diary->makeIdentifyToken();
    $result = false;
    if (1000000000 <= $token && $token <= 9999999999) {
      $result = true;
    } else {
      $result = false;
    }
    $this->assertTrue($result);
  }

  function test__checkUniqueIdentifyToken() {
    //---------- 記事IDチェックのテスト
    //----- 正常ケース
    // 未登録ID
    $this->assertEqual($this->Diary->__checkUniqueIdentifyToken(1111111111), true);

    // 登録済みのID
    $this->assertFalse($this->Diary->__checkUniqueIdentifyToken(1234567895), false);
  }

  function test__check_digit() {

    //---------- チェックディジットの作成テスト
    //----- 正常ケース
    $actual = $this->Diary->__check_digit(111111111);
    $expected = 1;
    $this->assertEqual($actual, $expected);

    $actual = $this->Diary->__check_digit(222222222);
    $expected = 2;
    $this->assertEqual($actual, $expected);

    $actual = $this->Diary->__check_digit(333333333);
    $expected = 3;
    $this->assertEqual($actual, $expected);

    $actual = $this->Diary->__check_digit(123456789);
    $expected = 5;
    $this->assertEqual($actual, $expected);

    $actual = $this->Diary->__check_digit(341940192);
    $expected = 5;
    $this->assertEqual($actual, $expected);

    $actual = $this->Diary->__check_digit(192401414);
    $expected = 2;
    $this->assertEqual($actual, $expected);

    //----- 異常ケース
    // 1桁の数値
    $actual = $this->Diary->__check_digit(1);
    $this->assertNull($actual);

    // 2桁の数値
    $actual = $this->Diary->__check_digit(12);
    $this->assertNull($actual);

    // 3桁の数値
    $actual = $this->Diary->__check_digit(123);
    $this->assertNull($actual);

    // 4桁の数値
    $actual = $this->Diary->__check_digit(1234);
    $this->assertNull($actual);

    // 5桁の数値
    $actual = $this->Diary->__check_digit(12345);
    $this->assertNull($actual);

    // 6桁の数値
    $actual = $this->Diary->__check_digit(123456);
    $this->assertNull($actual);

    // 7桁の数値
    $actual = $this->Diary->__check_digit(1234567);
    $this->assertNull($actual);

    // 8桁の数値
    $actual = $this->Diary->__check_digit(12345678);
    $this->assertNull($actual);

    // マイナス
    $actual = $this->Diary->__check_digit(-12345678);
    $this->assertNull($actual);

    // 文字列を含む
    $actual = $this->Diary->__check_digit("12a34b5678");
    $this->assertNull($actual);
  }

	function endTest() {
		unset($this->Diary);
		ClassRegistry::flush();
	}

}
?>
