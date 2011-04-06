<?php
/* Present Fixture generated on: 2011-03-31 14:03:46 : 1301549566 */
class PresentFixture extends CakeTestFixture {
	var $name = 'Present';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'month_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'present_type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_general_ci', 'comment' => '0＝壁紙、1＝デコメ絵文字、2＝待受けflash、3＝ポストカード', 'charset' => 'utf8'),
		'present_path' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'present_thumbnail_path' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'month_id' => array('column' => 'month_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'month_id' => 1,
			'present_type' => '1',
			'present_path' => 'Lorem ipsum dolor sit amet',
			'present_thumbnail_path' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-03-31 14:32:46',
			'modified' => '2011-03-31 14:32:46'
		),
		array(
			'id' => 2,
			'month_id' => 2,
			'present_type' => '2',
			'present_path' => 'Lorem ipsum dolor sit amet',
			'present_thumbnail_path' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-03-31 14:32:46',
			'modified' => '2011-03-31 14:32:46'
		),
		array(
			'id' => 3,
			'month_id' => 1,
			'present_type' => '2',
			'present_path' => 'Lorem ipsum dolor sit amet',
			'present_thumbnail_path' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-03-31 14:32:46',
			'modified' => '2011-03-31 14:32:46'
		),
		array(
			'id' => 4,
			'month_id' => 1,
			'present_type' => '3',
			'present_path' => 'Lorem ipsum dolor sit amet',
			'present_thumbnail_path' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-03-31 14:32:46',
			'modified' => '2011-03-31 14:32:46'
		),
		array(
			'id' => 5,
			'month_id' => 2,
			'present_type' => '3',
			'present_path' => 'Lorem ipsum dolor sit amet',
			'present_thumbnail_path' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-03-31 14:32:46',
			'modified' => '2011-03-31 14:32:46'
		),
		array(
			'id' => 6,
			'month_id' => 3,
			'present_type' => '1',
			'present_path' => 'Lorem ipsum dolor sit amet',
			'present_thumbnail_path' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-03-31 14:32:46',
			'modified' => '2011-03-31 14:32:46'
		),
		array(
			'id' => 7,
			'month_id' => 3,
			'present_type' => '3',
			'present_path' => 'Lorem ipsum dolor sit amet',
			'present_thumbnail_path' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-03-31 14:32:46',
			'modified' => '2011-03-31 14:32:46'
		),
	);
}
?>