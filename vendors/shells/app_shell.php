<?php

class AppShell extends shell {
	function _debug($var) {
		if (configure::read() > 0) {
			$this->out(var_export($var, true));
		}
	}

	function _devlog($one, $two = null) {
		if (Configure::read() > 0) {
			return $this->log($one, $two);
		}
	}
}