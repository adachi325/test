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
                            'message' => '必須項目です',
                            'last' => true,
			),
			array(
                            'rule' => 'isUnique',
                            'message' => 'このIDは既に登録されています',
                            'on'=>'create',
                            'last' => true,
			),
			array(
                            'rule' => array('between', 4, 12),
                            'message' => '4～12文字で入力してください',
                            'last' => true,
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字で入力してください',
                            'last' => true,
			),
		),
		'loginpassword' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です',
                            'last' => true,
			),
			array(
                            'rule' => array('between', 6, 12),
                            'message' => '6～12文字で入力してください',
                            'last' => true,
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字で入力してください',
                            'last' => true,
			),
		),
		'new_password' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です',
                            'last' => true,
			),
			array(
                            'rule' => array('between', 6, 12),
                            'message' => '6～12文字で入力してください',
                            'last' => true,
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字で入力してください',
                            'last' => true,
			),
		),
		'row_password' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です',
                            'last' => true,
			),
			array(
                            'rule' => array('between', 6, 12),
                            'message' => '6～12文字で入力してください',
                            'last' => true,
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字で入力してください',
                            'last' => true,
			),
			array(
                            'rule' => 'checkRowPassword',
                            'message' => 'ﾊﾟｽﾜｰﾄﾞが一致しません',
                            'last' => true,
			),
		),
		'dc_user' => array(
                        array(
                            'rule' => array('custom', '/^[0-1]{1}$/'),
                            'message' => '不正な値です',
                            'last' => true,
                        ),
		),
		'uid' => array(
                        array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
                            'last' => true,
			),
			array(
                            'rule' => 'isUnique',
                            'message' => 'この端末は既に登録されています。',
                            'on'=>'create',
                            'last' => true,
			),
		),
            //リマインド時に利用するためのダミーフィールド
		'remindId' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
                            'last' => true,
			),
			array(
                            'rule' => array('between', 4, 12),
                            'message' => '4～12文字で入力してください',
                            'last' => true,
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字で入力してください',
                            'last' => true,
			),
		),
            //リマインド時に利用するためのダミーフィールド
		'nickname' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
                            'last' => true,
			),
			array(
                            'rule' => array('maxLength', 6),
                            'message' => '6文字以内で入力してください',
                            'last' => true,
			),
		),
            //リマインド時に利用するためのダミーフィールド
		'birth_year' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
                            'last' => true,
			),
			array(
                            'rule' => array('between', 4, 4),
                            'message' => '不正な値です',
                            'last' => true,
			),
		),
            //リマインド時に利用するためのダミーフィールド
		'birth_month' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
                            'last' => true,
			),
			array(
                            'rule' => array('between', 1, 2),
                            'message' => '不正な値です',
                            'last' => true,
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
                }
            }
                $this->Child->set($data);
                if (!$this->Child->validates()) {
                    pr($this->Child->validationErrors);
                }
                $this->set($data);
                if (!$this->validates()) {
                    pr($this->validationErrors);
                }
            return false;
        }

}
?>
