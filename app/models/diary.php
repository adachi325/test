<?php
App::import('Model', 'Child');
App::import('Model', 'Theme');
App::import('Model', 'Present');
App::import('Model', 'Month');
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
		'Month' => array(
			'className' => 'Month',
			'foreignKey' => '',
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
		
		//メールプレフィックス除去
		$to = $data['to'];
		if (!ereg("^".Configure::read('Defaults.receive_mail_prefix'), $to)) {
			return false;
		}
		$to = ereg_replace("^".Configure::read('Defaults.receive_mail_prefix'), "", $to);
		
		//@以降除去
		$to = ereg_replace("@.*", "", $to);
		
		//宛先アドレス有効判定
		$to_splits = split('\.', $to);
		if (count($to_splits) != 4) {//user_id, child_id, theme_id, hash
			return false;
		}
		
		//add
		$request = array(
			'user_id' => $to_splits[0],
			'child_id' => $to_splits[1],
			'theme_id' => $to_splits[2],
			'hash' => $to_splits[3],
		);
		if (!empty($data['subject'])) {
			$request['subject'] = $data['subject'];
		}
		if (!empty($data['body'])) {
			$request['body'] = $data['body'];
		}
		if (!empty($data['image'])) {
			$request['image'] = $data['image'];
		}
		
		return $this->add($request);
	}
	
	//思い出登録
	function add($data) {
		
		pr($data);
		
		if (empty($data)) {
			return false;
		}
		
		//user_id & child_id
		$child = ClassRegistry::init('Child');
		$child->contain('User');
		$child_data = $child->find('first', array('conditions' => array('User.id' => $data['user_id'], 'Child.id' => $data['child_id'])));
		if (empty($child_data)) {
			return false;
		}
		
		//theme_id
		$theme = ClassRegistry::init('Theme')->find('first', array('conditions' => array('Theme.id' => $data['theme_id'])));
		if (empty($theme)) {
			return false;
		}
		
		//hash
		if (strlen($data['hash']) != Configure::read('Diary.hash_length')) {
			return false;
		}
		
		//has_image
		$data['has_image'] = !empty($data['image']);
		
		//present_id
		$data['present_id'] = $this->__getNextPresentId($data['child_id']);
		
		echo $data['present_id'];

//		if (!$this->save($data)) {
//			return false;
//		}
//		
//		$diary_id = $this->Child->getLastInsertId();
		
		//画像保存
		
		
		
		
		
		
		return true;
	}
	
	function __getNextPresentId($child_id) {
		
		//今月のプレゼント一覧
		$presents = ClassRegistry::init('Present')->find('month', array('order' => 'Present.present_type ASC'));
//		pr($presents);
		
		//今月獲得したプレゼント一覧
		$child_presents = ClassRegistry::init('Child')->find('present', array(
			'conditions' => array(
				'Child.id' => $child_id,
				'Month.year' => date('Y'),
				'Month.month' => date('n'),
			)
		));
//		pr($child_presents);
		
		if (count($presents) <= count($child_presents)) {
			return null;
		}
		
		//今月投稿した思い出一覧
		$diaries = ClassRegistry::init('Child')->find('diary', array(
			'conditions' => array(
				'Child.id' => $child_id,
				'Month.year' => date('Y'),
				'Month.month' => date('n'),
			)
		));
//		pr($diaries);
		
		$next_present_idx = count($child_presents);
		return $presents[$next_present_idx]['Present']['id'];
	}
}
?>