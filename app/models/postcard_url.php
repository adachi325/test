<?php
class PostcardUrl extends AppModel {
	var $name = 'PostcardUrl';
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
		'token' => array(
			array(
                            'rule' => 'notEmpty',
                            //'message' => '必須項目です',
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
