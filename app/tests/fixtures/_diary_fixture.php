<?php
/* Month Fixture generated on: 2011-03-14 13:03:17 : 1300075217 */
class DiaryFixture extends CakeTestFixture {
	var $name = 'Diary';
/*
	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'child_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'theme_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'present_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10),
		'hash' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 16, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'body' => array('type' => 'text', 'null' => false, 'default' => NULL, 'length' => 2, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'has_image' => array('type' => 'boolean', 'null' => false, 'default' => NULL, 'length' => 1),
		'error_code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 4, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);*/

	var $records = array(
		array(
			'id' => 1,
			'child_id' => 1,
			'theme_id' => 1,
			'present_id' => 1,
			'hash' => 'abcd',
			'title' => 'あいうえお',
			'body' => '本文はこちらです',
			'has_image' => 0,
			'error_code' => "",
			'created' => '2011-03-14 13:00:17',
			'modified' => '2011-03-14 13:00:17',
		),
	);
}
?>