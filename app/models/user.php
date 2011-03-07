<?php

class User extends AppModel {

	var $name = 'User';
        public $uses = array('User');
    
	var $validate = array(
		'loginid' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。。',
			),
			array(
                            'rule' => array('maxLength', 20),
                            'message' => '文字数が多すぎます。',
			),
			array(
                            'rule' => 'alphaNumeric',
                            'message' => '半角英数字で入力してください。',
			),
		),

		'new_loginid' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => 'isUnique',
                            'message' => '既に存在しているIDです。',
			),
			array(
                            'rule' => array('maxLength', 20),
                            'message' => '文字数が多すぎます。',
			),
			array(
                            'rule' => 'alphaNumeric',
                            'message' => '半角英数字で入力してください。',
			),
		),

		'loginpassword' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => 'alphaNumeric',
                            'message' => '半角英数字で入力してください。',
			),
		),

		'new_password' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => 'alphaNumeric',
                            'message' => '半角英数字で入力してください。',
			),
		),

		'row_password' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => 'alphaNumeric',
                            'message' => '半角英数字で入力してください。',
			),
		),

		'nickname' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => array('maxLength', 32),
                            'message' => '文字数が多すぎます。',
			),
		),

		'birth_year' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => array('maxLength', 4),
                            'message' => '日付がおかしいです。。',
			),
		),

		'birth_month' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => array('maxLength', 2),
                            'message' => '日付がおかしいです。',
			),
		),

		'sex' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
		),

		'benesse_user' => array(
			array(
                            'rule' => 'numeric',
                            'message' => '選択された値が不正です。',
			),
		),

		'dc_user' => array(
			array(
                            'rule' => 'numeric',
                            'message' => '選択された値が不正です。',
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
	function register($data)
	{
                //登録処理
                if($this->save($data)){
                    //今登録UserID取得
                    $request['Child']['user_id'] = $this->getLastInsertId();
                    //子供登録
                    if($this->Child->save($request)){
                        return true;
                    }
                }
                return false;
	}

}
?>