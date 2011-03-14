<?php
class Diary extends AppModel {
	var $name = 'Diary';
	var $validate = array(
		'child_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'theme_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'hash' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'has_image' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
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
		'Theme' => array(
			'className' => 'Theme',
			'foreignKey' => 'theme_id',
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
	
	//�v���o�o�^
	function addByEmail($data) {
		
		if (empty($data)) {
			return false;
		}
		
		//���[���L������
		if (empty($data['to'])) {
			return false;
		}
		
		$to_params = split('.', $data['to']);
		
		if (count($to_params) != 4) {//user_id, child_id, theme_id, hash
			return false;
		}
		
		
		//�o�^�挈��
	}
	
	//�v���o�o�^
	function add($data) {
		
		if (empty($data)) {
			return false;
		}
/*		
		//�v���o�o�^
		//�o�^���ʖ߂�

		//�o�^����
		if($this->save($data)){
			$request = array();
			$request['Child'] = $data['Child']['0'];
			//���o�^UserID�擾
			$nowInsertId = $this->getLastInsertId();
			$request['Child']['user_id'] = $nowInsertId;
			//�q���o�^
			if($this->Child->save($request)){
				//���o�^�q��ID�擾
				$nowInsertChildId = $this->Child->getLastInsertId();
				$userData = array();
				$userData['User']['id'] = $nowInsertId;
				$userData['User']['last_selected_child'] = $nowInsertChildId;
				//�ŏI�q��ID�X�V
				if($this->Child->sevaLastChild($userData)){
					return true;
				}
				return false;
			}
			return false;
		}
		return false;
*/

	}
}
?>