<?php
/* Child Test cases generated on: 2011-03-31 14:03:08 : 1301549948*/
App::import('Model', 'Child');

class ChildTestCase extends CakeTestCase {
	var $fixtures = array('app.child', 'app.user', 'app.line', 'app.content', 'app.issue', 'app.present', 'app.month', 'app.diary', 'app.theme', 'app.child_present', 'app.postcard_url');

	function startTest() {
		$this->Child =& ClassRegistry::init('Child');
	}

	function endTest() {
		unset($this->Child);
		ClassRegistry::flush();
	}

	function testSaveLastChild() {
                $c =& $this->Child;

                //正常系
                $result = true;
                
                $data = array('User' => array('id' => '1','last_child_id' => '1'),);
		$this->assertTrue($c->SaveLastChild($data), '正常系');

                $data = array('User' => array('id' => '500','last_child_id' => '30000000'),);
		$this->assertTrue($c->SaveLastChild($data), '正常系');

                //異常系
		$this->assertFalse($c->SaveLastChild(null), '異常系');

	}

}
?>