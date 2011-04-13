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

	//未来日生年月日チェック(Child用)
	function checkBirthDayChild() {
		if (($this->data['Child']['birth_year'] > date('Y')) OR (
                     $this->data['Child']['birth_year'] >= date('Y') AND
                     $this->data['Child']['birth_month'] > (date('m')+0))) {
			return false;
		} else {
			return true;
		}
        }

	//未来日生年月日チェック(User用)
	function checkBirthDayUser() {
		if (($this->data['User']['birth_year'] > date('Y')) OR (
                     $this->data['User']['birth_year'] >= date('Y') AND
                     $this->data['User']['birth_month'] > (date('m')+0))) {
			return false;
		} else {
			return true;
		}
        }

        //ぜい弱性チェック
	function checkRegisterLoginIdtoPassword() {

                if(empty($this->data)){
                    return false;
                }

                $id='';
                if(isset($this->Auth)) {
                    $id = $this->Session->read('Auth.User.id');
                }else if(isset($this->data['User']['loginid'])) {
                    $id = $this->data['User']['loginid'];
                } else {
                    return false;
                }

                $password='';
                if(isset($this->data['User']['new_password'])) {
                    $password = $this->data['User']['new_password'];
                } else if(isset($this->data['User']['password'])) {
                    $password = $this->data['User']['password'];
                } else {
                    return false;
                }

                if($id !== $password){
                    return true;
                }
                
                return false;
        }
}

