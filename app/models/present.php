<?php
class Present extends AppModel {
	var $name = 'Present';
	var $validate = array(
		'present_type' => array(
			array(
                            'rule' => 'notEmpty',
                            //'message' => '必須項目です',
			),
			array(
                            'rule' => 'numeric',
                            //'message' => '半角数字以外ご利用できません',
			),
		),
		'present_path' => array(
			array(
                            'rule' => 'notEmpty',
                            //'message' => '必須項目です',
			),
		),
		'present_thumbnail_path' => array(
			array(
                            'rule' => 'notEmpty',
                            //'message' => '必須項目です',
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
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
			// to paginate option //
			$cond = array();

			if (isset($options['type'])) {
				$cond["{$m}.present_type"] = $options['type'];
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

			$this->contain(array('Month'));

			$ret = parent::find('all', set::merge(
				array(
					'conditions' => $cond,
				),
				$options
			));
			return $ret;

			break;
		case 'month':
			// year, monthのデフォルト値（現在の日付を使用）
			// optionに値が指定された場合、condの値はoptionで指定された値に上書きされます
			$cond = array(
				"Month.year" => date('Y'),
				"Month.month" => date('n'),
			);

			if (isset($options['year'])) {
				$cond['Month.year'] = $options['year'];
				unset($options['year']);
			}

			if (isset($options['month'])) {
				$cond['Month.month'] = $options['month'];
				unset($options['month']);
			}

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
