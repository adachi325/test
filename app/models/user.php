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
			),
			array(
                            'rule' => 'isUnique',
                            'message' => '既に使用されているIDです',
                            'on'=>'create',
			),
			array(
                            'rule' => array('between', 4, 20),
                            'message' => '4文字から20文字以内で入力してください',
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字以外ご利用できません',
			),
		),
		'loginpassword' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です',
			),
			array(
                            'rule' => array('between', 4, 16),
                            'message' => 'ﾊﾟｽﾜｰﾄﾞは4文字から16文字以内です',
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字以外ご利用できません',
			),
		),
		'new_password' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です',
			),
			array(
                            'rule' => array('between', 4, 16),
                            'message' => 'ﾊﾟｽﾜｰﾄﾞは4文字から16文字以内です',
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字以外ご利用できません',
			),
		),
		'row_password' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です',
			),
			array(
                            'rule' => array('between', 4, 16),
                            'message' => 'ﾊﾟｽﾜｰﾄﾞは4文字から16文字以内です',
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字以外ご利用できません',
			),
			array(
                            'rule' => 'checkRowPassword',
                            'message' => 'パスワードが一致しません。',
			),
		),
		'dc_user' => array(
                        array(
                            'rule' => array('custom', '[0|1]'),
                            'message' => '不正な値です'
                        ),
		),
		'uid' => array(
                        array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
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
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => array('between', 4, 20),
                            'message' => '4文字から20文字以内で入力してください',
			),
			array(
                            'rule' => 'checkIDPassword',
                            'message' => '半角英数字以外ご利用できません',
			),
		),
            //リマインド時に利用するためのダミーフィールド
		'nickname' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => array('maxLength', 20),
                            'message' => '6文字以内で入力してください',
			),
		),
            //リマインド時に利用するためのダミーフィールド
		'birth_year' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => array('maxLength', 4),
                            'message' => '不正な値です',
			),
		),
            //リマインド時に利用するためのダミーフィールド
		'birth_month' => array(
			array(
                            'rule' => 'notEmpty',
                            'message' => '必須項目です。',
			),
			array(
                            'rule' => array('maxLength', 2),
                            'message' => '不正な値です',
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
