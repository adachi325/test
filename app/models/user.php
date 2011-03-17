<?php

class User extends AppModel {
	/**
	 * 使用するコンポーネント
	 * @var array
	 */
	var $components = array('ktai');

    	//ktaiライブラリ設定
	public $ktai;
        
	var $name = 'User';
        public $uses = array('User');
    
	var $validate = array(
		'loginid' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。。',
			),
			array(
                            'rule' => 'isUnique',
                            'message' => '既に存在しているIDです。',
                            'on'=>'create',
			),
			array(
                            'rule' => array('maxLength', 20),
                            'message' => '文字数が多すぎます。',
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字で入力してください。',
			),
		),

		'loginpassword' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字で入力してください。',
			),
		),

		'new_password' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字で入力してください。',
			),
		),

		'row_password' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字で入力してください。',
			),
			array(
                            'rule' => 'checkRowPassword',
                            'message' => '入力されたパスワードが一致しません。',
			),
		),
		'dc_user' => array(
			array(
                            'rule' => 'numeric',
                            'message' => '選択された値が不正です。',
			),
		),
		'uid' => array(
                        array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。。',
			),
			array(
                            'rule' => 'isUnique',
                            'message' => 'この端末は既に登録されています。',
                            'on'=>'create',
			),
		),
            //リマインド時に利用するためのダミーフィールド
		'remindId' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。。',
			),
			array(
                            'rule' => array('maxLength', 20),
                            'message' => '文字数が多すぎます。',
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字で入力してください。',
			),
		),
            //リマインド時に利用するためのダミーフィールド
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
            //リマインド時に利用するためのダミーフィールド
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
            //リマインド時に利用するためのダミーフィールド
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Child' => array(
			'className' => 'Child',
			'foreignKey' => 'user_id',
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

	//新規会員登録
	function _register($data)
	{
            if (empty($data)) {
                return false;
            }
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
                    if($this->Child->saveLastChild($userData)){
                        return true;
                    }
                    return false;
                }
                return false;
            }
            return false;
	}


}
?>
