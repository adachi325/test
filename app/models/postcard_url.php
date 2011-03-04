<?php
class PostcardUrl extends AppModel {

	var $name = 'PostcardUrl';
	var $validate = array(
		'child_id' => array('numeric'),
		'token' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Child' => array(
			'className' => 'Child',
			'foreignKey' => 'child_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>