<?php
/* Issue Test cases generated on: 2011-03-10 14:03:37 : 1299733297*/
App::import('Model', 'Issue');

class IssueTestCase extends CakeTestCase {
	var $fixtures = array('app.issue', 'app.line', 'app.child', 'app.user', 'app.child_present', 'app.present', 'app.diary', 'app.theme', 'app.postcard_url', 'app.content');

	function startTest() {
		$this->Issue =& ClassRegistry::init('Issue');
	}

	function endTest() {
		unset($this->Issue);
		ClassRegistry::flush();
	}

	function createLineData() {
		$i = $this->Issue;

		$categories = Configure::read('Lines.categories');
		$Line =& ClassRegistry::init('Line');
		
		$Line->contain();
		foreach($categories as $category) {
			$Line->create();
			$data = array('Line' => array(
				'title' => "{$category} title",
				'description' => "{$category} description",
				'category_name' => $category,
			));
			$Line->save($data);
		}

		$lines = $Line->find('all');
	}

	function createIssueData()
	{
		$Issue =& $this->Issue;

		$categories = Configure::read('Lines.categories');
		$Line =& ClassRegistry::init('Line');
		
		foreach($categories as $category) {
			$line = $Line->find('first', array('conditions' => array('Line.category_name' => $category)));

			for ($i = 0; $i < 5; $i++) {
				$Issue->create();
				$data = array('Issue' => array(
					'title' => "tilte {$i}",
					'line_id' => $line['Line']['id'],
					'release_date' => date('Y-m-d', mktime(0, 0, 0, date("m") + ($i - 2), date("d"), date("Y")) ),
				));
				$Issue->save($data);
			}
		}

	}


	function testAll()
	{
                $i = $this->Issue;
                $type = "released";

                //正常系[released]
                $options = array();
                $options['0'] = array('line' => 'baby');
                $options['1'] = array('line' => 'petit');
                $options['2'] = array('line' => 'pocket');

                $r=1;
                foreach($options as $option) {
                    $result = $i->find($type, $option);
                    $this->assertNotNull($result, '正常系[released]'.$r);
                    //pr($result);
                    //pr($option);
                    $r++;
                }

                //異常系[released]
                $options = array();
                $options['0'] = array('line' => 'ベイビー');
                $options['1'] = array('line' => '');

                $r=1;
                foreach($options as $option) {
                    $result = $i->find($type, $option);
                    if(empty($result['0'])){
                        $this->assertNull(null, '異常系[released]'.$r);
                    } else {
                        $this->assertNull($result, '異常系[released]'.$r);
                    }
                    //pr($result);
                    //pr($option);
                    $r++;
                }

                $type = "month";

                //正常系[month]
//                $options = array();
//                $options['0'] = array('line_id' => '1');
//                $options['1'] = array('line_id' => '2');
//                $options['2'] = array('line_id' => '3');
//
//                $r=1;
//                foreach($options as $option) {
//                    $result = $i->find($type, $option);
//                    $this->assertNotNull($result, '正常系[month]'.$r);
//                    //pr($result);
//                    //pr($option);
//                    $r++;
//                }


	}
}
?>
