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
			'token' => 'Lorem ipsum dolor ',
			'created' => '2011-03-31 14:32:43',
			'modified' => '2011-03-31 14:32:43'
		),
	);
}
?>