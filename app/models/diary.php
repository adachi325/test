<?php
class Diary extends AppModel {

	var $name = 'Diary';
	var $validate = array(
		'child_id' => array('numeric'),
		'theme_id' => array('numeric'),
		'hush_cord' => array('numeric'),
		'title' => array('notempty'),
		'description' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Child' => array(
			'className' => 'Child',
			'foreignKey' => 'child_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Theme' => array(
			'className' => 'Theme',
			'foreignKey' => 'theme_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>