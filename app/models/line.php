<?php
class Line extends AppModel {

	var $name = 'Line';
	var $validate = array(
		'title' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Child' => array(
			'className' => 'Child',
			'foreignKey' => 'line_id',
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
		'Content' => array(
			'className' => 'Content',
			'foreignKey' => 'line_id',
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
		'Issue' => array(
			'className' => 'Issue',
			'foreignKey' => 'line_id',
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
        
	function findAll(){
		return $this->findAll();
	}
}
?>