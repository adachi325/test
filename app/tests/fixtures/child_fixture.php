<?php
/* Child Fixture generated on: 2011-03-31 14:03:05 : 1301549525 */
class ChildFixture extends CakeTestFixture {
	var $name = 'Child';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'line_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'nickname' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'birth_year' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 4, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'birth_month' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'sex' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_general_ci', 'comment' => '1＝女、2＝男', 'charset' => 'utf8'),
		'iconId' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'benesse_user' => array('type' => 'boolean', 'null' => false, 'default' => NULL, 'comment' => 'false：非会員、true：会員'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'user_id' => array('column' => 'user_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'line_id' => 1,
			'nickname' => 'Lorem ipsum dolor sit amet',
			'birth_year' => 'Lo',
			'birth_month' => '',
			'sex' => 'Lorem ipsum dolor sit ame',
			'iconId' => 'Lorem ipsum dolor sit ame',
			'benesse_user' => 1,
			'created' => '2011-03-31 14:32:05',
			'modified' => '2011-03-31 14:32:05'
		),
	);
}
?>