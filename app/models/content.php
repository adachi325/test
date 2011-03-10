<?php
class Content extends AppModel {
	var $name = 'Content';
	var $validate = array(
		'line_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'issue_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'path' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'content_type' => array(
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
		'Line' => array(
			'className' => 'Line',
			'foreignKey' => 'line_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Issue' => array(
			'className' => 'Issue',
			'foreignKey' => 'issue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	function find($type, $options = array())
	{
		// code...
	}

	function isReleased($path = null)
	{
		if ($path) {
			$m = $this->alias;
			$url = $path;
			$data = $this->find('first', array('conditions' => array("{$m}.path" => $url)));
		}

		return false;
	}


}
?>
