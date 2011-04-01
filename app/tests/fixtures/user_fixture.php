<?php
/* User Fixture generated on: 2011-03-31 14:03:53 : 1301549573 */
class UserFixture extends CakeTestFixture {
	var $name = 'User';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'loginid' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_general_ci', 'comment' => 'ログイン用', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_general_ci', 'comment' => 'sha1ハッシュ', 'charset' => 'utf8'),
		'carrier' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_general_ci', 'comment' => '0＝dc、 1＝au、 2＝sb', 'charset' => 'utf8'),
		'uid' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'dc_user' => array('type' => 'boolean', 'null' => false, 'default' => NULL, 'comment' => 'false：非会員、true：会員(Docomo Community会員)'),
		'admin_user' => array('type' => 'boolean', 'null' => false, 'default' => NULL, 'comment' => 'false：一般会員、true：管理者'),
		'last_selected_child' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'comment' => '最後に表示していた子供ID'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'comment' => '作成日'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'comment' => '最終更新日'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'loginid' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'carrier' => 'Lorem ipsum dolor sit ame',
			'uid' => 'Lorem ipsum dolor sit amet',
			'dc_user' => 1,
			'admin_user' => 1,
			'last_selected_child' => 1,
			'created' => '2011-03-31 14:32:53',
			'modified' => '2011-03-31 14:32:53'
		),
	);
}
?>