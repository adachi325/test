<?php
/* ChildPresent Fixture generated on: 2011-03-31 14:03:32 : 1301549492 */
class ChildPresentFixture extends CakeTestFixture {
	var $name = 'ChildPresent';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'child_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'present_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'child_id' => array('column' => 'child_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'child_id' => 1,
			'present_id' => 1,
			'created' => '2011-03-31 14:31:32',
			'modified' => '2011-03-31 14:31:32'
		),
	);
}
?>