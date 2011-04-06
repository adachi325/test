<?php
class ChildPresent extends AppModel {
	var $name = 'ChildPresent';
	var $validate = array(
		'child_id' => array(
			array(
                            'rule' => 'notEmpty',
                            //'message' => '必須項目です',
			),
			array(
                            'rule' => 'numeric',
                            //'message' => '半角数字以外ご利用できません',
			),
		),
		'present_id' => array(
			array(
                            'rule' => 'notEmpty',
                            //'message' => '必須項目です',
			),
			array(
                            'rule' => 'numeric',
                            //'message' => '半角数字以外ご利用できません',
			),
		),
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