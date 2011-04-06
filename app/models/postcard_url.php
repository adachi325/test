<?php
class PostcardUrl extends AppModel {
	var $name = 'PostcardUrl';
	var $validate = array(
		'child_id' => array(
			array(
                            'rule' => 'notEmpty',
                            'last' => true,
			),
			array(
                            'rule' => 'numeric',
                            'last' => true,
			),
		),
		'token' => array(
			array(
                            'rule' => 'notEmpty',
                            'last' => true,
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
		)
	);

	function isValiable($token) {
		$m = $this->alias;

		$count = $this->find('count', array('conditions' => array("{$m}.token" => $token)) );

		return ($count > 0);
	}

}
?>
