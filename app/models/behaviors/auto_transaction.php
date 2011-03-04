<?php

App::import('Lib', 'TransactionManager', false);

class AutoTransactionBehavior extends ModelBehavior {
	var $started = array();
	var $settings = array();
	var $defaultSettings = array(
		'auto' => true,
	);

	function autoTransaction($model, $auto = true) {
		$this->settings[$model->name]['auto'] = $auto;
	}

	function setup($model, $settings = array()) {
		if (!isset($this->started[$model->useDbConfig])) {
			$this->started[$model->useDbConfig] = false;
		}

		$this->settings[$model->name] = Set::merge($this->defaultSettings, $settings);
	}

	function started($model) {
		return !empty($this->started[$model->useDbConfig]);
	}

	function _startedByOther($model) {
		return !$this->started($model) && TransactionManager::started($model->useDbConfig);
	}

	function _determineAutoTransaction($model, $start = true) {
		if ($this->settings[$model->name]['auto']) {
			if ($start) {
				return !TransactionManager::started($model->useDbConfig);
			} else {
				return !$this->_startedByOther($model);
			}
		}
		return false;
	}

	function _transaction($model, $start = true) {
		$this->started[$model->useDbConfig] = $start;
		return $start ? TransactionManager::begin($model->useDbConfig) : TransactionManager::commit($model->useDbConfig);
	}

	function beforeSave($model) {
		if ($this->_determineAutoTransaction($model, true)) {
			$this->_transaction($model);
		}
		return true;
	}

	function afterSave($model, $created) {
		if ($this->_determineAutoTransaction($model, false)) {
			$this->_transaction($model, false);
		}
		return true;
	}

	function beforeDelete($model, $cascade = true) {
		if ($this->_determineAutoTransaction($model, true)) {
			$this->_transaction($model);
		}
		return true;
	}

	function afterDelete($model) {
		if ($this->_determineAutoTransaction($model, false)) {
			$this->_transaction($model, false);
		}
		return true;
	}
}