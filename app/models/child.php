<?php
class Child extends AppModel {

	var $name = 'Child';
	var $validate = array(
		'user_id' => array('numeric'),
		'line_id' => array('numeric'),
		'nickname' => array('notempty'),
		'birth_year' => array('notempty'),
		'birth_month' => array('notempty'),
		'sex' => array('notempty'),
		'benesse_user' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Line' => array(
			'className' => 'Line',
			'foreignKey' => 'line_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ChildPresent' => array(
			'className' => 'ChildPresent',
			'foreignKey' => 'child_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Diary' => array(
			'className' => 'Diary',
			'foreignKey' => 'child_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PostcardUrl' => array(
			'className' => 'PostcardUrl',
			'foreignKey' => 'child_id',
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