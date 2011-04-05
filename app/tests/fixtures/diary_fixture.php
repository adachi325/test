<?php
/* Diary Fixture generated on: 2011-03-31 14:03:10 : 1301549530 */
class DiaryFixture extends CakeTestFixture {
	var $name = 'Diary';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'child_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'month_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'theme_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'present_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'hash' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 16, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'body' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'has_image' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'error_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 4, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'child_id' => array('column' => 'child_id', 'unique' => 0), 'theme_id' => array('column' => 'theme_id', 'unique' => 0), 'present_id' => array('column' => 'present_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'child_id' => 1,
			'month_id' => 1,
			'theme_id' => 1,
			'present_id' => 1,
			'hash' => 'Lorem ipsum do',
			'title' => 'Lorem ipsum dolor ',
			'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'has_image' => 1,
			'error_code' => 'Lo',
			'created' => '2011-03-31 14:32:10',
			'modified' => '2011-03-31 14:32:10'
		),
		array(
			'id' => 2,
			'child_id' => 1,
			'month_id' => 2,
			'theme_id' => 1,
			'present_id' => 1,
			'hash' => 'Lorem ipsum do',
			'title' => 'Lorem ipsum dolor ',
			'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'has_image' => 1,
			'error_code' => 'Lo',
			'created' => '2011-03-31 14:32:10',
			'modified' => '2011-03-31 14:32:10'
		),
	);
}
?>