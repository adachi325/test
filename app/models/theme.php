<?php
class Theme extends AppModel {

	var $name = 'Theme';
	var $validate = array(
		'issue_id' => array('numeric'),
		'title' => array('notempty'),
		'release_week' => array('notempty'),
		'release_date' => array('date')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Issue' => array(
			'className' => 'Issue',
			'foreignKey' => 'issue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Diary' => array(
			'className' => 'Diary',
			'foreignKey' => 'theme_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>