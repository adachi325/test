<?php
/* Month Fixture generated on: 2011-03-31 14:03:20 : 1301549540 */
class MonthFixture extends CakeTestFixture {
	var $name = 'Month';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'year' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 4, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'month' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'year' => '2011',
			'month' => '3',
			'created' => '2011-03-31 14:32:20',
			'modified' => '2011-03-31 14:32:20'
		),
		array(
			'id' => 2,
			'year' => '2011',
			'month' => '4',
			'created' => '2011-04-01 14:32:20',
			'modified' => '2011-04-01 14:32:20'
		),
		array(
			'id' => 3,
			'year' => '2011',
			'month' => '5',
			'created' => '2011-05-01 14:32:20',
			'modified' => '2011-05-01 14:32:20'
		),
	);
}
?>