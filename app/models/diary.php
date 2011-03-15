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
		'month_id' => array(
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
			'foreignKey' => 'month_id',
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
		
		//���[���v���t�B�b�N�X����
		$to = $data['to'];
		if (!ereg("^".Configure::read('Defaults.receive_mail_prefix'), $to)) {
			return false;
		}
		$to = ereg_replace("^".Configure::read('Defaults.receive_mail_prefix'), "", $to);
		
		//@�ȍ~����
		$to = ereg_replace("@.*", "", $to);
		
		//����A�h���X�L������
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
	
	//�v���o�o�^
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
		
		//month_id
		$data['month_id'] = $theme['Theme']['month_id'];
		
		//hash
		if (strlen($data['hash']) != Configure::read('Diary.hash_length')) {
			return false;
		}
		
		//has_image
		$data['has_image'] = !empty($data['image']);
		
		//present_id:�e�[�}�̌��ɕR�Â��v���[���g���擾���Ȃ���΂����Ȃ��I
		$data['present_id'] = $this->__getNextPresentId($data['child_id'], $theme['Month']['year'], $theme['Month']['month']);
		echo $data['present_id'];
		
		if (!$this->save($data)) {
			return false;
		}
		
		//child_present
		if (!empty($data['present_id'])) {
			$request = array();
			$request['child_id'] = $data['child_id'];
			$request['present_id'] = $data['present_id'];
			$ChildPresent =& ClassRegistry::init('ChildPresent');
			$ChildPresent->save($request);
		}
		
		$diary_id = $this->Child->getLastInsertId();
		
		//�摜�ۑ�
		
		
		
		
		
		
		return true;
	}
	
	function __getNextPresentId($child_id, $year, $month) {
		
		//�e�[�}���̃v���[���g�ꗗ
		$presents = ClassRegistry::init('Present')->find('month', array(
			'year' => $year,
			'month' => $month,
			'order' => 'Present.present_type ASC'
		));
		//pr($presents);
		
		//�e�[�}���Ɋl�������v���[���g�ꗗ
		$child_presents = ClassRegistry::init('Child')->find('present', array(
			'conditions' => array(
				'Child.id' => $child_id,
				'Month.year' => $year,
				'Month.month' => $month,
			)
		));
		//pr($child_presents);
		
		if (count($presents) <= count($child_presents)) {
			return null;
		}
		
		//�e�[�}���ɓ��e�����v���o�ꗗ
		$diaries = ClassRegistry::init('Child')->find('diary', array(
			'conditions' => array(
				'Child.id' => $child_id,
				'Month.year' => $year,
				'Month.month' => $month,
			)
		));
		//pr($diaries);
		
		$next_present_idx = count($child_presents);
		return $presents[$next_present_idx]['Present']['id'];
	}
}
?>
