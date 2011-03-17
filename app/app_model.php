<?php

App::import('Lib', 'LazyModel.LazyModel');

class AppModel extends LazyModel {

	public $actsAs = array(
		'Containable',
		'AutoTransaction',
	);

        function checkIDPassword($data) {
                $check = is_array($data) ? array_shift($data) : $data;
                if (preg_match('/[^\\dA-Z]/i',$check)) {
                        return false;
                } else {
                        return true;
                }
        }

}

