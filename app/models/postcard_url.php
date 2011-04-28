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

	function isValiable($token, $with_delete = false) {
		$m = $this->alias;

		$data = $this->find('first', array('conditions' => array("{$m}.token" => $token)) );
		if (empty($data)) {
			return false;
		}

		$exp = date('Y-m-d H:i:s', mktime(date('H') - Configure::read('Present.postcard.valid_hours')) );
		if ($data['PostcardUrl']['created'] > $exp) {
			return true;
		}

		// exec only has record and $exp failed.
		if ($with_delete) {
			$this->delete($data['PostcardUrl']['id']);
		}

		return false;
	}

	function getExpiredUrls() {
		$m = $this->alias;

		$exp = date('Y-m-d H:i:s', mktime(date('H') - Configure::read('Present.postcard.valid_hours')) );
		$data = $this->find('all', array('conditions' => array("{$m}.created <" => $exp, )));

		return $data;
	}
}
?>
