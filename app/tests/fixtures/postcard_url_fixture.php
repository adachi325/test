<?php
/* PostcardUrl Fixture generated on: 2011-03-31 14:03:43 : 1301549563 */
class PostcardUrlFixture extends CakeTestFixture {
	var $name = 'PostcardUrl';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'child_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'token' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'child_id' => array('column' => 'child_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'child_id' => 1,
			'token' => '1234 ',
			'created' => '2011-03-31 14:32:43',
			'modified' => '2011-03-31 14:32:43'
		),
		array(
			'id' => 2,
			'child_id' => 1,
			'token' => '1232234 ',
			'created' => '2011-03-31 14:32:43',
			'modified' => '2011-03-31 14:32:43'
		),
		array(
			'id' => 3,
			'child_id' => 2,
			'token' => '8902345',
			'created' => '2011-03-31 14:32:43',
			'modified' => '2011-03-31 14:32:43'
		),
		array(
			'id' => 4,
			'child_id' => 3,
			'token' => '9898212314 ',
			'created' => '2011-03-31 14:32:43',
			'modified' => '2011-03-31 14:32:43'
		),
		array(
			'id' => 5,
			'child_id' => 3,
			'token' => '222222222',
			'created' => '2011-03-31 14:32:43',
			'modified' => '2011-03-31 14:32:43'
		),
		array(
			'id' => 6,
			'child_id' => 3,
			'token' => '222222222',
			'created' => '2011-03-31 14:32:43',
			'modified' => '2011-03-31 14:32:43'
		),
	);
}
?>