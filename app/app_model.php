<?php

App::import('Lib', 'LazyModel.LazyModel');

class AppModel extends LazyModel {

	public $actsAs = array(
		'Containable',
		'AutoTransaction',
	);

        //cent OS 対策
        function alphaNumeric($check) {
            $_this =& Validation::getInstance();
            $_this->__reset();
            $_this->check = $check;

            if (is_array($check)) {
                    $_this->_extract($check);
            }

            if (empty($_this->check) && $_this->check != '0') {
                    return false;
            }
            $_this->regex = '/^[a-z\d]*$/i';
            return $_this->_check();
        }

}

