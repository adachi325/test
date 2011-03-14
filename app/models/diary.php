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
	
	//思い出登録
	function addByEmail($data) {
		
		if (empty($data)) {
			return false;
		}
		
		//メール有効判定
		if (empty($data['to'])) {
			return false;
		}
		
		$to_params = split('.', $data['to']);
		
		if (count($to_params) != 4) {//user_id, child_id, theme_id, hash
			return false;
		}
		
		
		//登録先決定
	}
	
	//思い出登録
	function add($data) {
		
		if (empty($data)) {
			return false;
		}
/*		
		//思い出登録
		//登録結果戻し

		//登録処理
		if($this->save($data)){
			$request = array();
			$request['Child'] = $data['Child']['0'];
			//今登録UserID取得
			$nowInsertId = $this->getLastInsertId();
			$request['Child']['user_id'] = $nowInsertId;
			//子供登録
			if($this->Child->save($request)){
				//今登録子供ID取得
				$nowInsertChildId = $this->Child->getLastInsertId();
				$userData = array();
				$userData['User']['id'] = $nowInsertId;
				$userData['User']['last_selected_child'] = $nowInsertChildId;
				//最終子供ID更新
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