<?php
class Content extends AppModel {

	var $name = 'Content';
	var $validate = array(
		'line_id' => array('numeric'),
		'issue_id' => array('numeric'),
		'title' => array('notempty'),
		'path' => array('notempty'),
		'content_type' => array('notempty'),
		'release_date' => array('date')
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

}
?>