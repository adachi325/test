<?php
/* Hanamaru Fixture generated on: 2011-05-16 16:05:21 : 1305529941 */
class HanamaruFixture extends CakeTestFixture {
	var $name = 'Hanamaru';
	var $table = 'hanamarus';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'type' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'comment' => '記事のタイプ
1: 思い出記録、2: ニュース、 3:占い'),
		'external_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'comment' => '記事タイプ先に紐づくID'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'comment' => 'はなまるをつけたユーザーID'),
		'owner_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'comment' => 'はなまるをもらったユーザーID
外部コンテンツの場合は、別途定める'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'type' => 1,
			'external_id' => 1,
			'user_id' => 1,
			'owner_id' => 1,
			'created' => '2011-05-16 16:12:21',
			'modified' => '2011-05-16 16:12:21'
		),
		array(
			'id' => 2,
			'type' => 1,
			'external_id' => 1,
			'user_id' => 1,
			'owner_id' => 1,
			'created' => '2011-05-16 16:12:21',
			'modified' => '2011-05-16 16:12:21'
		),
		array(
			'id' => 3,
			'type' => 1,
			'external_id' => 1,
			'user_id' => 1,
			'owner_id' => 2,
			'created' => '2011-05-16 16:12:21',
			'modified' => '2011-05-16 16:12:21'
		),
	);

}
?>
