<?php
class ChildPresent extends AppModel {

	var $name = 'ChildPresent';
	var $validate = array(
		'child_id' => array('numeric'),
		'present_id' => array('numeric')
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
		'Present' => array(
			'className' => 'Present',
			'foreignKey' => 'present_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>