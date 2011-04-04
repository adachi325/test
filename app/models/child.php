<?php
App::import('Model', 'Diary');
class Child extends AppModel {
	var $name = 'Child';
	var $validate = array(
		'line_id' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です',
			),
                        array(
                            'rule' => array('custom', '/^[0|1|2|3|4|5]{1,}$/'),
                            'message' => '必須項目です'
                        ),
		),
		'nickname' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です',
			),
			array(
                            'rule' => array('maxLength', 6),
                            'message' => '6文字以内で入力してください',
			),
		),
		'birth_year' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です',
			),
			array(
                            'rule' => array('maxLength', 4),
                            'message' => '不正な値です',
			),
		),
		'birth_month' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です',
			),
			array(
                            'rule' => array('maxLength', 2),
                            'message' => '不正な値です',
			),
		),
		'sex' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です',
                        ),
                        array(
                            'rule' => array('custom', '/^[0|1]{1,}$/'),
                            'message' => '必須項目です'
                        ),
		),
		'benesse_user' => array(
                        array(
                            'rule' => array('custom', '/^[0|1]{1,}$/'),
                            'message' => '必須項目です'
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
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => true,
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Diary' => array(
			'className' => 'Diary',
			'foreignKey' => 'child_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => true,
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