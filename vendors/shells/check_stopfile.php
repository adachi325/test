<?php

App::import('Shell', 'AppShell');
//App::import('Shell', 'ReceiveMailShell');
class CheckStopfileShell extends AppShell {
	
	function main() {
		if (!$this->_stopfileExists()) {
			echo "no stopfile exists.\n";
			return;
		}
		
		$pid = $this->_readStopfile();//pid is written in stopfile
		
		if ($pid === null
				|| $this->_isRunningPid($pid) === true) {
			echo "pid is running.($pid)\n";
			return;
		}
		
		$this->_removeStopfile();
		echo "\nstopfile was removed.\n";
		
//		ClassRegistry::init('ReceiveMail')->main();
//		$receiveMail->main();
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
		$command = 'ps x|grep "shimajiro/cake/console receive_mail" > ' . Configure::read('ReceiveMail.ps_log_path');
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
		return $is_running_pid;
	}
	
	function _removeStopfile() {
		if (file_exists(Configure::read('ReceiveMail.stopfile_path'))) {
			unlink(Configure::read('ReceiveMail.stopfile_path'));
		}
	}
	

}