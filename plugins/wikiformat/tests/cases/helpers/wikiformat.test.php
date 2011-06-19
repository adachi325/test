<?php
App::import('Helper', 'Wikiformat.Wikiformat');
App::import('Helper', 'Html');

class WikiformatTestCase extends CakeTestCase
{

	/**
	 *
	 * @var Wikiformat
	 */
	var $Wikiformat;

	var $invalidString = '―';
	
	function startTest()
	{
		$this->Wikiformat = new WikiformatHelper();
		$this->Wikiformat->Html =& new HtmlHelper();
	}
	
	function endTest()
	{
		unset($this->Wikiformat);
		ClassRegistry::flush();
	}
	
	
	function testMakeLink()
	{
		$w =& $this->Wikiformat;

		$value = '';
		$expected = $this->invalidString;
		$result = $w->makeLink($value);
		$this->assertEqual($result, $expected, 'からの文字列。 %s');

		$value = '[リンクのテスト http://www.google.com]';
		$expected = array(
			array('a' => array('href' => 'http://www.google.com')),
		);
		$result = $w->makeLink($value);
		$this->assertTags($result, $expected, 'http付きのリンク。 %s');

		$value = '[リンクのテスト http://www.google.com _top]';
		$expected = array(
			array('a' => array('href' => 'http://www.google.com', 'target' => '_top')),
		);
		$result = $w->makeLink($value);
		$this->assertTags($result, $expected, 'http付きのリンク。 %s');

		$value = '[ http://www.google.com]';
		$expected = array(
			array('a' => array('href' => 'http://www.google.com')),
		);
		$result = $w->makeLink($value);
		$this->assertTags($result, $expected, 'http付きのリンク。 %s');

		$value = '[ http://www.google.com _blank]';
		$expected = array(
			array('a' => array('href' => 'http://www.google.com', 'target' => '_blank')),
		);
		$result = $w->makeLink($value);
		$this->assertTags($result, $expected, 'http付きのリンク。 %s');

		$value = '[ /items/view/1]';
		$expected = array(
			array('a' => array('href' => $w->Html->url('/items/view/1'))),
		);
		$result = $w->makeLink($value);
		$this->assertTags($result, $expected, 'http付きのリンク。 %s');

		$value = '[ /items/view/1 _blank]';
		$expected = array(
			array('a' => array('href' => $w->Html->url('/items/view/1'), 'target' => '_blank')),
		);
		$result = $w->makeLink($value);
		$this->assertTags($result, $expected, 'http付きのリンク。 %s');

		$value = '[ビューにリンク /items/view/1]';
		$expected = array(
			array('a' => array('href' => '/items/view/1')),
		);
		$result = $w->makeLink($value);
		$this->assertTags($result, $expected, 'http付きのリンク。 %s');


		$value = '[詳細画面にリンク /items/view/1]しています。[編集画面にリンク /items/edit/1]しています。[一覧画面にリンク /items/index]しています。';
		$result  = $w->Html->link('詳細画面にリンク', '/items/view/1');
		$result .= 'しています。';
		$result .= $w->Html->link('編集画面にリンク', '/items/edit/1');
		$result .= 'しています。';
		$result .= $w->Html->link('一覧画面にリンク', '/items/index');
		$result .= 'しています。';
		$this->assertEqual($w->makeLink($value), $result, '複数のリンク。ラベルが前。 %s');

		$value = '[詳細画面にリンク /items/view/1]しています。[編集画面にリンク /items/edit/1 _blank]しています。[一覧画面にリンク /items/index]しています。';
		$result  = $w->Html->link('詳細画面にリンク', '/items/view/1');
		$result .= 'しています。';
		$result .= $w->Html->link('編集画面にリンク', '/items/edit/1', array('target' => '_blank'));
		$result .= 'しています。';
		$result .= $w->Html->link('一覧画面にリンク', '/items/index');
		$result .= 'しています。';
		$this->assertEqual($w->makeLink($value), $result, '複数のリンク。ラベルが前後混在パターン２。 %s');

		$value = 'http://www.google.com 括弧が無い場合、変換されません。';
		$result = 'http://www.google.com 括弧が無い場合、変換されません。';
		$this->assertEqual($w->makeLink($value), $result, '括弧なし。 %s');

		$value = '[http://www.google.com 括弧が不正の場合、変換されません。';
		$result = '[http://www.google.com 括弧が不正の場合、変換されません。';
		$this->assertEqual($w->makeLink($value), $result, '閉じ括弧なし。 %s');

		$value = 'http://www.google.com] 括弧が不正の場合、変換されません。';
		$result = 'http://www.google.com] 括弧が不正の場合、変換されません。';
		$this->assertEqual($w->makeLink($value), $result, '開き括弧なし。 %s');

		$value = '[詳細画面にリンク#/items/view/1]しています。[編集画面にリンク#/items/edit/1]しています。[一覧画面にリンク /items/index]しています。';
		$result = '[詳細画面にリンク#/items/view/1]しています。[編集画面にリンク#/items/edit/1]しています。';
		$result .= $w->Html->link('一覧画面にリンク', '/items/index');
		$result .= 'しています。';
		$this->assertEqual($w->makeLink($value), $result, '区切り記号が不正。 %s');

		$value = '[詳細画面にリンク#/items/view/1]しています。[編集画面にリンク#/items/edit/1]しています。[一覧画面にリンク#/items/index]しています。';
		$result  = $w->Html->link('詳細画面にリンク', '/items/view/1');
		$result .= 'しています。';
		$result .= $w->Html->link('編集画面にリンク', '/items/edit/1');
		$result .= 'しています。';
		$result .= $w->Html->link('一覧画面にリンク', '/items/index');
		$result .= 'しています。';
		$this->assertEqual($w->makeLink($value, array('delimiter' => '#')), $result, '複数のリンク。区切り記号を変更。 %s');

		$value = '<詳細画面にリンク|/items/view/1>しています。<編集画面にリンク|/items/edit/1>しています。<一覧画面にリンク|/items/index>しています。';
		$result  = $w->Html->link('詳細画面にリンク', '/items/view/1');
		$result .= 'しています。';
		$result .= $w->Html->link('編集画面にリンク', '/items/edit/1');
		$result .= 'しています。';
		$result .= $w->Html->link('一覧画面にリンク', '/items/index');
		$result .= 'しています。';
		$this->assertEqual($w->makeLink($value, array('delimiter' => '|', 'brackets' => array('start' => '<', 'end' => '>'))), $result, '複数のリンク。区切り記号,括弧を変更。 %s');

	}

	function testMmdd_to_text() {
		$w =& $this->Wikiformat;

		$value = "";
		$result = $w->mmdd_to_text($value);
		$expected = $this->invalidString;
		$this->assertEqual($result, $expected);

		$value = "0000";
		$result = $w->mmdd_to_text($value);
		$expected = $this->invalidString;
		$this->assertEqual($result, $expected);

		$value = "0505";
		$result = $w->mmdd_to_text($value);
		$expected = "5月 5日";
		$this->assertEqual($result, $expected);

		$value = "1021";
		$result = $w->mmdd_to_text($value);
		$expected = "10月 21日";
		$this->assertEqual($result, $expected);

		$value = "1321";
		$result = $w->mmdd_to_text($value);
		$expected = $this->invalidString;
		$this->assertEqual($result, $expected);

		$value = "1033";
		$result = $w->mmdd_to_text($value);
		$expected = $this->invalidString;
		$this->assertEqual($result, $expected);

		$value = "01205";
		$result = $w->mmdd_to_text($value);
		$expected = $this->invalidString;
		$this->assertEqual($result, $expected);

	}

	public function testArrayToText()
	{
		$w =& $this->Wikiformat;

		$array = array(0 => 1, 1 => 3, 2 => 4);
		$label = array(0 => "test0", 1 => "test1", 2 => "test2", 3 => "test3", 4 => "test4");
		$result = $w->array_to_text($array, $label);
		$expected = "test1, test3, test4";
		
		$this->assertEqual($result, $expected);

		$array = array(0 => 0);
		$result = $w->array_to_text($array, $label);
		$expected = "test0";
		
		$this->assertEqual($result, $expected);

		$array = '';
		$result = $w->array_to_text($array, $label);
		$expected = $this->invalidString;
		
		$this->assertEqual($result, $expected);

	}

	public function testHtmlEscape()
	{
		$w =& $this->Wikiformat;

		$text = '';
		$result = $w->html_escape($text);
		$expected = $this->invalidString;
		
		$this->assertEqual($result, $expected);

		$text = 'test';
		$result = $w->html_escape($text);
		$expected = 'test';
		
		$this->assertEqual($result, $expected);

	}
}
