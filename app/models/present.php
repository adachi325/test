<?php
class Present extends AppModel {
	var $name = 'Present';
	var $validate = array(
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
		'present_type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'present_path' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'present_thumbnail_path' => array(
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
		'Theme' => array(
			'className' => 'Theme',
			'foreignKey' => 'theme_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Month' => array(
			'className' => 'Month', 
			'foreignKey' => 'month_id',
		),
	);

	var $hasAndBelongsToMany = array(
		'Child' => array(
			'className' => 'Child',
			'joinTable' => 'child_presents',
			'foreignKey' => 'present_id',
			'associationForeignKey' => 'child_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

	function find($type, $options = array()) {
		$m = $this->alias;

		// add released method
		switch($type) {
		case 'type':
			$cond = array();

			if (isset($options['type'])) {
				$cond["{$m}.type"] = $options['type'];
				unset($options['type']);
			}
	
			if (isset($options['child_id'])) {
				$ChildPresent =& ClassRegistry::init('ChildPresent');
				$ChildPresent->contain();
				$present_ids = $ChildPresent->find('all', array(
					'fields' => array('id', 'present_id'), 
					'conditions' => array('child_id' => $options['child_id']),
				));

				if (is_array($present_ids)) {
					$cond["{$m}.id"] = Set::combine($present_ids, '{n}.ChildPresent.id', '{n}.ChildPresent.present_id');
				}

				unset($options['child_id']);
			}

			$this->contain(array('Month', 'Child'));

			$ret = parent::find('all', set::merge(
				array(
					'conditions' => $cond,
				),
				$options
			));
			return $ret;

			break;
		case 'month':
			$cond = array(
				"Month.year" => date('Y'),
				"Month.month" => date('n'),
			);

			if (isset($options['type'])) {
				$cond["{$m}.type"] = $options['type'];
				unset($options['type']);
			}

			$this->contain(array('Month'));

			$ret = parent::find('all', set::merge(
				array(
					'conditions' => $cond,
				),
				$options
			));
			return $ret;

			break;
		
		default:
			return parent::find($type, $options);
			break;

		}
	}

}
?>
