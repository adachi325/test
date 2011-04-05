<?php
/* Content Fixture generated on: 2011-03-31 14:03:07 : 1301549527 */
class ContentFixture extends CakeTestFixture {
	var $name = 'Content';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'line_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'issue_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'path' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'コンテンツへの相対パス（ベネッセコンテンツは完全URL）', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'content_type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_general_ci', 'comment' => '0＝mail、1＝flash、2＝youtube、3＝他サイト遷移', 'charset' => 'utf8'),
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
			'issue_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'path' => 'ap\baby\1007',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'content_type' => 'Lorem ipsum dolor sit ame',
			'release_date' => '2011-03-31 14:32:07',
			'created' => '2011-03-31 14:32:07',
			'modified' => '2011-03-31 14:32:07'
		),
		array(
			'id' => 2,
			'line_id' => 1,
			'issue_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'path' => 'ap\hop\1006',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'content_type' => 'Lorem ipsum dolor sit ame',
			'release_date' => '2011-03-31 14:32:07',
			'created' => '2011-03-31 14:32:07',
			'modified' => '2011-03-31 14:32:07'
		),
		array(
			'id' => 3,
			'line_id' => 1,
			'issue_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'path' => 'ap\petit\1009',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'content_type' => 'Lorem ipsum dolor sit ame',
			'release_date' => '2011-03-31 14:32:07',
			'created' => '2011-03-31 14:32:07',
			'modified' => '2011-03-31 14:32:07'
		),
		array(
			'id' => 4,
			'line_id' => 1,
			'issue_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'path' => 'ap\pocket\1011',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'content_type' => 'Lorem ipsum dolor sit ame',
			'release_date' => '2011-03-31 14:32:07',
			'created' => '2011-03-31 14:32:07',
			'modified' => '2011-03-31 14:32:07'
		),
		array(
			'id' => 5,
			'line_id' => 1,
			'issue_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'path' => 'ap\step\1013',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'content_type' => 'Lorem ipsum dolor sit ame',
			'release_date' => '2011-03-31 14:32:07',
			'created' => '2011-03-31 14:32:07',
			'modified' => '2011-03-31 14:32:07'
		),
		array(
			'id' => 6,
			'line_id' => 1,
			'issue_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'path' => 'ap\hop\1007',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'content_type' => 'Lorem ipsum dolor sit ame',
			'release_date' => '2011-03-31 14:32:07',
			'created' => '2011-03-31 14:32:07',
			'modified' => '2011-03-31 14:32:07'
		),
		array(
			'id' => 7,
			'line_id' => 1,
			'issue_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'path' => 'ap\jump\1007_2',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'content_type' => 'Lorem ipsum dolor sit ame',
			'release_date' => '2011-03-31 14:32:07',
			'created' => '2011-03-31 14:32:07',
			'modified' => '2011-03-31 14:32:07'
		),
	);
}
?>