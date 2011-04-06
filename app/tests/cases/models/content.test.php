<?php
/* Content Test cases generated on: 2011-03-10 14:03:40 : 1299733240*/
App::import('Model', 'Content');

class ContentTestCase extends CakeTestCase {
	var $fixtures = array('app.content', 'app.line', 'app.child', 'app.user', 'app.child_present', 'app.present', 'app.issue', 'app.theme', 'app.diary', 'app.postcard_url');

	function startTest() {
		$this->Content =& ClassRegistry::init('Content');
	}

	function testIsReleased()
	{
		$c =& $this->Content;

                //正常系
		$expected = true;

                $options = array();
                $options['0']['line'] = 'baby';
                $options['0']['month'] = '1007';

                $options['1']['line'] = 'hop';
                $options['1']['month'] = '1006';

                $options['2']['line'] = 'petit';
                $options['2']['month'] = '1009';

                $options['3']['line'] = 'pocket';
                $options['3']['month'] = '1011';

                $options['4']['line'] = 'step';
                $options['4']['month'] = '1013';

                $options['5']['line'] = 'hop';
                $options['5']['month'] = '1007';

                $options['6']['line'] = 'jump';
                $options['6']['month'] = '1007_2';

                $i=1;
                foreach($options as $option) {
                    $result = $c->isReleased($option['line'],$option['month']);
                    $this->assertEqual($result, $expected, '正常系'.$i);
                    pr(_CONTENTS_BASE_PATH.DS.$option['line'].DS.$option['month']);
                    $i++;
                }

                //異常系

		$expected = false;
                $options = array();
                $options['0']['line'] = 'baby';
                $options['0']['month'] = '1005';

                $options['1']['line'] = 'hop';
                $options['1']['month'] = '1005';

                $options['2']['line'] = 'petit';
                $options['2']['month'] = '1005';

                $options['3'] = null;

                $i=1;
                foreach($options as $option) {
                    $result = $c->isReleased($option['line'],$option['month']);
                    $this->assertEqual($result, $expected, '異常系'.$i);
                    pr(_CONTENTS_BASE_PATH.DS.$option['line'].DS.$option['month']);
                    $i++;
                }
                
	}

	function endTest() {
		unset($this->Content);
		ClassRegistry::flush();
	}

}
?>
