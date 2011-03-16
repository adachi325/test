<?php
App::import('Model', 'Diary');
class Child extends AppModel {
	var $name = 'Child';
	var $validate = array(
		'line_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'nickname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'birth_year' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength',12),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'birth_month' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength',2),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sex' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'iconId' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'benesse_user' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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

        //最後に操作した子供情報を更新する
        function saveLastChild($data){
            if(empty($data)){
                return false;
            }
            if($this->User->save($data)){
                return true;
            }
            return false;
        }

	function find($type, $options = array()) {
		$m = $this->alias;

		// add released method
		switch($type) {
		case 'diary':
		
			if (!isset($options['conditions']['Child.id'])) {
				return null;
			}
			
			$Diary =& ClassRegistry::init('Diary');
			$Diary->contain();
				
			$params = array(
				'conditions' => array(
					'Diary.child_id' => $options['conditions']['Child.id'],
				),
			);
			
			if (isset($options['conditions']['Month.year']) && isset($options['conditions']['Month.month'])) {
				$params['joins'][] = array(
					'type' => 'INNER',
					'alias' => 'Month',
					'table' => 'months',
					'conditions' => array(
						'Month.year' => $options['conditions']['Month.year'],
						'Month.month' => $options['conditions']['Month.month'],
						'Month.id' => 'Diary.month_id',
					)
				);
			}
			
			return $Diary->find('all', $params);

			break;
		
		case 'present':
		
			if (!isset($options['conditions']['Child.id'])) {
				return null;
			}
			
			$Present =& ClassRegistry::init('Present');
				
			if (isset($options['conditions']['Month.year']) && isset($options['conditions']['Month.month'])) {
				$Present->contain('Month');
				$params = array(
					'conditions' => array(
						'Month.year' => $options['conditions']['Month.year'],
						'Month.month' => $options['conditions']['Month.month'],
					),
				);
			}
			
			$params['joins'][] = array(
				'type' => 'INNER',
				'alias' => 'ChildPresent',
				'table' => 'child_presents',
				'conditions' => array(
					'Present.id = ChildPresent.present_id',
					'ChildPresent.child_id' => $options['conditions']['Child.id'],
				)
			);
			
			return $Present->find('all', $params);
			
			break;
		
		default:
			return parent::find($type, $options);
			break;

		}
	}

}
?>