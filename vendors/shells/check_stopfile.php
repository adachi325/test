<?php

App::import('Shell', 'AppShell');
class CheckStopfileShell extends AppShell {
	
	const STOP_FILE_PATH = "../../app/tmp/stop.file";
	const MAIL_DIR_NEW = "/home/iida/Maildir/new/";
	const MAIL_DIR_DONE_NORMAL = "/home/iida/Maildir/done/normal/";
	const MAIL_DIR_DONE_ERROR = "/home/iida/Maildir/done/error/";
	const PS_LOG_FILE_PATH = "../../app/tmp/ps_log.txt";
	
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
	}
	
	function _stopfileExists() {
		return file_exists(CheckStopfileShell::STOP_FILE_PATH);
	}
	
	function _readStopfile() {
		$fp = fopen(CheckStopfileShell::STOP_FILE_PATH, "r");
		$pid = feof($fp) ? null : fgets($fp);
		fclose($fp);
		return $pid;
	}
	
	function _isRunningPid($pid) {
		$command = 'ps x|grep "shimajiro/cake/console receive_mail" > ' . CheckStopfileShell::PS_LOG_FILE_PATH;
		$result = passthru($command, $ret);
		
		$is_running_pid = false;
		$fp = fopen(CheckStopfileShell::PS_LOG_FILE_PATH, "r");
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
		if (file_exists(CheckStopfileShell::STOP_FILE_PATH)) {
			unlink(CheckStopfileShell::STOP_FILE_PATH);
		}
	}
	

}