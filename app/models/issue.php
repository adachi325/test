<?php
class Issue extends AppModel {
	var $name = 'Issue';
//	var $validate = array(
//		'line_id' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'title' => array(
//			'notempty' => array(
//				'rule' => array('notempty'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Line' => array(
			'className' => 'Line',
			'foreignKey' => 'line_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Content' => array(
			'className' => 'Content',
			'foreignKey' => 'issue_id',
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
		'Present' => array(
			'className' => 'Present',
			'foreignKey' => 'issue_id',
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
		'Theme' => array(
			'className' => 'Theme',
			'foreignKey' => 'issue_id',
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

	function find($type, $options = array())
	{
		$m = $this->alias;

		// add released method

		switch($type) {
		case 'released':
			$cond = array("{$m}.release_date <=" => date('Y-m-d H:i:s'));
			$order = array("{$m}.release_date DESC, {$m}.id DESC");
			$content_order = 'DESC';

			if (isset($options['line'])) {
				$cond["Line.category_name"] = $options['line'];
				if ($options['line'] == 'baby') {
					$order = array("{$m}.id ASC"); 
					$content_order = 'ASC';
				}
				unset($options['line']);
			}

			return parent::find('all', Set::merge(
				array(
					'conditions' => $cond,
					'order' => $order,
					'contain' => array('Line', 'Content' => array('order' => array("Content.release_date {$content_order}"))),
				),
				$options
			));

			break;
		case 'month':
			$line_id;
			if (isset($options['line_id'])) {
				$line_id = $options['line_id'];
				unset($options['line_id']);
			}

			$cond = array(
				"{$m}.release_date >=" => date('Y-m-1 0:0:0'),
				"{$m}.release_date <" => date('Y-m-1 0:0:0', mktime(0, 0, 0, date("m") + 1, date("d"), date("Y")) ),
			);

			$this->contain('Content');
			if (!empty($line_id)) {
				$cond["{$m}.line_id"] = $line_id;
			}

			$ret = parent::find('all', set::merge(
				array(
					'conditions' => $cond,
					'order' => "{$m}.release_date DESC",
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
