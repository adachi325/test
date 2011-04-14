<?php

App::import('Shell', 'AppShell');
class CheckStopfileShell extends AppShell {
	
	function main() {
		if (!$this->_stopfileExists()) {
			return;
		}
		
		$pid = $this->_readStopfile();//pid is written in stopfile
		
		if ($pid === null
				|| $this->_isRunningPid($pid) === true) {
			return;
		}
		
		$this->_removeStopfile();
	}
	
	function _stopfileExists() {
		return file_exists(Configure::read('ReceiveMail.stopfile_path'));
	}
	
	function _readStopfile() {
		$fp = fopen(Configure::read('ReceiveMail.stopfile_path'), "r");
		$pid = feof($fp) ? null : fgets($fp);
		fclose($fp);
		return $pid;
	}
	
	function _isRunningPid($pid) {
		$command = 'ps x|grep "/cake/console receive_mail" > ' . Configure::read('ReceiveMail.ps_log_path');
		$result = passthru($command, $ret);
		
		$is_running_pid = false;
		$fp = fopen(Configure::read('ReceiveMail.ps_log_path'), "r");
		while (!feof($fp)) {
			$line = fgets($fp);
			if (ereg(".*$pid.*", $line) && ereg(".*php.*", $line)) {
				$is_running_pid = true;
				break;
			}
		}
		fclose($fp);
		
		if (file_exists(Configure::read('ReceiveMail.ps_log_path'))) {
			unlink(Configure::read('ReceiveMail.ps_log_path'));
		}
		
		return $is_running_pid;
	}
	
	function _removeStopfile() {
		if (file_exists(Configure::read('ReceiveMail.stopfile_path'))) {
			unlink(Configure::read('ReceiveMail.stopfile_path'));
		}
	}
	

}