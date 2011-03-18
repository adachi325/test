<?php

App::import('Lib', 'LazyModel.LazyModel');

class AppModel extends LazyModel {

	public $actsAs = array(
		'Containable',
		'AutoTransaction',
	);

	//cent OS 対策
	function checkIDPassword($data) {
		
		$check = is_array($data) ? array_shift($data) : $data;
		if (preg_match('/[^\\dA-Z]/i',$check)) {
			return false;
		} else {
			return true;
		}
	}

	//rowパスワードチェック
	function checkRowPassword() {
		if ($this->data['User']['new_password'] !== $this->data['User']['row_password']) {
			return false;
		} else {
			return true;
		}
	}

}

