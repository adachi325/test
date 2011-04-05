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


	function testFind()
	{
		//$this->createIssueData();
		//return;

		$i = $this->Issue;

		$type = "released";
		$options = array();
		$expected = array();

		$result = $i->find($type, $options);
		$this->assertEqual($result, $expected);
		
		$options = array('line' => 'baby');
		$expected = array();

		$result = $i->find($type, $options);
		$this->assertEqual($result, $expected);


		$type = "month";
		$options = array('conditions' => array('line_id' => '3'));
		$expected = array();

		$result = $i->find($type, $options);
		$this->assertEqual($result, $expected);
		pr($result);
	}

}
?>
