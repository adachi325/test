<?php
/* Issue Fixture generated on: 2011-03-31 14:03:14 : 1301549534 */
class IssueFixture extends CakeTestFixture {
	var $name = 'Issue';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'line_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'release_date' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'line_id' => 1,
			'title' => '一月号',
			'release_date' => '2011-03-31 14:32:14',
			'created' => '2011-03-31 14:32:14',
			'modified' => '2011-03-31 14:32:14'
		),
		array(
			'id' => 2,
			'line_id' => 1,
			'title' => '2月号',
			'release_date' => '2011-03-31 14:32:14',
			'created' => '2011-03-31 14:32:14',
			'modified' => '2011-03-31 14:32:14'
		),
		array(
			'id' => 3,
			'line_id' => 2,
			'title' => '3月号',
			'release_date' => '2011-03-31 14:32:14',
			'created' => '2011-03-31 14:32:14',
			'modified' => '2011-03-31 14:32:14'
		),
		array(
			'id' => 4,
			'line_id' => 3,
			'title' => '12月号',
			'release_date' => '2011-03-31 14:32:14',
			'created' => '2011-03-31 14:32:14',
			'modified' => '2011-03-31 14:32:14'
		),
	);
}
?>