<?php
class Present extends AppModel {

	var $name = 'Present';
	var $validate = array(
		'issue_id' => array('numeric'),
		'present_type' => array('notempty'),
		'present_path' => array('notempty'),
		'present_thumbnail_path' => array('notempty')
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

	var $hasAndBelongsToMany = array(
		'Child' => array(
			'className' => 'Child',
			'joinTable' => 'child_presents',
			'foreignKey' => 'present_id',
			'associationForeignKey' => 'child_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>