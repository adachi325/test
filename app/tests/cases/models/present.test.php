<?php
/* Present Test cases generated on: 2011-03-10 14:03:09 : 1299733269*/
App::import('Model', 'Present');

class PresentTestCase extends CakeTestCase {
	var $fixtures = array('app.month','app.present', 'app.issue', 'app.line', 'app.child', 'app.user', 'app.child_present', 'app.diary', 'app.theme', 'app.postcard_url', 'app.content');

	function startTest() {
		$this->Present =& ClassRegistry::init('Present');
	}

	function endTest() {
		unset($this->Present);
		ClassRegistry::flush();
	}

	function testFind() {
		$p =& $this->Present;

                //正常系TYPE
		$type = "type";
                $options = array();
		$options['0'] = array('type' => 1, 'child_id' => 1,);
		$options['1'] = array('type' => 2, 'child_id' => 1,);
		$options['2'] = array('type' => 1, 'child_id' => 2,);
		$options['3'] = array('type' => 1, 'child_id' => 3,);

                $i=1;
                foreach($options as $option) {
                    $result = $p->find($type,$option);
                    $this->assertNotNull($result, '[type]正常系'.$i);
                    //pr($result);
                    //pr($type.','.$option['type'].','.$option['child_id']);
                    $i++;
                }

                //異常系TYPE
		$type = "type";
                $options = array();
		$options['0'] = array('type' => 'a', 'child_id' => 1,);
		$options['1'] = array('type' => '', 'child_id' => 1,);
		$options['2'] = array('type' => 1000, 'child_id' => 2,);
		$options['3'] = array('type' => 'a1sj981', 'child_id' => 3,);
		$options['4'] = array('type' => 1, 'child_id' => 'e329hd2',);
		$options['5'] = array('type' => 4, 'child_id' => 'a',);
		$options['6'] = array('type' => 3, 'child_id' => '',);
                $options['6'] = array('type' => '</div>', 'child_id' => '1',);
                $options['6'] = array('type' => 3, 'child_id' => '<div>',);

                $i=1;
                foreach($options as $option) {
                    $result = $p->find($type,$option);
                    if(isset($result['0'])){
                        $this->assertNull($result['0'], '[type]異常系'.$i);
                    }else {
                        $this->assertNull(null, '[type]異常系'.$i);
                    }
                    //pr($result);
                    //pr($type.','.$option['type'].','.$option['child_id']);
                    $i++;
                }
		
                //正常系MONTH
		$type = "month";
                $options = array();
		$options['0'] = array('year' => '2011', 'month' => 3,);
                $options['1'] = array('year' => '2011', 'month' => 4,);
                $options['2'] = array('year' => '2011', 'month' => 5,);

                $i=1;
                foreach($options as $option) {
                    $result = $p->find($type,$option);
                    $this->assertNotNull($result, '[month]正常系'.$i);
                    //pr($result);
                    //pr($type.','.$option['year'].','.$option['month']);
                    $i++;
                }

                //異常系MONTH
		$type = "month";
                $options = array();
		$options['0'] = array('year' => '', 'month' => 3,);
                $options['1'] = array('year' => 'あああ', 'month' => 4,);
                $options['2'] = array('year' => 'aaa?', 'month' => 5,);
                $options['3'] = array('year' => '</html>', 'month' => 5,);
  		$options['4'] = array('year' => '2011', 'month' => 'aaa',);
                $options['5'] = array('year' => '2011', 'month' => '',);
                $options['6'] = array('year' => '2011', 'month' => 3724728734,);
                $options['7'] = array('year' => '<[in]>', 'month' => 3724728734,);

                $i=1;
                foreach($options as $option) {
                    $result = $p->find($type,$option);
                    if(isset($result['0'])){
                        $this->assertNull($result['0'], '[month]異常系'.$i);
                    }else {
                        $this->assertNull(null, '[month]異常系'.$i);
                    }
                    //pr($result);
                    //pr($type.','.$option['year'].','.$option['month']);
                    $i++;
                }
	}
}
?>
