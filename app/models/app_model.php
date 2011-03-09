<?php

App::import('Plugin', 'LazyModel.LazyModel');

//レイジモーデル継承
class AppModel extends LazyModel {

    public $defaultOption = 'default';
    public $actsAs = array(
            'AutoTransaction',
    );

    public function onError() {
            $message = $this->getDataSource()->error;
            throw new DatabaseError($message);
    }

    // TODO: test, move to common validation
    public function arrayNotEmpty($check) {
            $value = current((array)$check);

            if (!is_array($value)) {
                    return Validation::notEmpty($check);
            }
            return !empty($value);
    }
}
