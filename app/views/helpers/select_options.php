<?php

class SelectOptionsHelper extends AppHelper {
	
	var $min_year = 2010;

	function getOption($options = array()) {
		$defaultOption = array(
			'min' => $this->min_year,
			'max' => date('Y'),
			'suffix' => '年',
			'reverse' => false,
			'interval' => 1);
		$settings = array_merge($defaultOption, $options);
		extract($settings);
		
		$options = array();

		for ($i = $min; $i <= $max; $i = $i + $interval) {
			$options += array($i => $i.$settings['suffix']);
		}
		
		if ($settings['reverse']) {
			$options = array_reverse($options, true);
		}

		return $options;
	}

	function getYearOption() {
		return $this->getOption();
	}

	function getMonthOption() {
		$option = array('min' => 1, 'max' => 12, 'suffix' => '月');
		return $this->getOption($option);
	}

	function getDayOption() {
		$option = array('min' => 1, 'max' => 31, 'suffix' => '日');
		return $this->getOption($option);
	}
}
?>
