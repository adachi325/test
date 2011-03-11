<?php

App::import('Shell', 'AppShell');
class ReceiveMailShell extends AppShell {
	
	const STOP_FILE_PATH = "../../app/tmp/stop.file";
	const MAIL_DIR_NEW = "/home/iida/Maildir/new/";
	const MAIL_DIR_DONE_NORMAL = "/home/iida/Maildir/done/normal/";
	const MAIL_DIR_DONE_ERROR = "/home/iida/Maildir/done/error/";
	
	function main() {
		if ($this->_checkStopFile()) {
			echo "other process is running.\n";
			return;
		}
		
		$this->_createStopFile();
		$this->_execute();
		$this->_removeStopFile();
	}
	
	function _checkStopFile() {
		return file_exists(ReceiveMailShell::STOP_FILE_PATH);
	}
	
	function _createStopFile() {
		$body = getmypid();
		$fp = fopen(ReceiveMailShell::STOP_FILE_PATH, "w");
		flock($fp, LOCK_EX);
		fwrite($fp, $body, strlen($body));
		flock($fp, LOCK_UN);
		rewind($fp);
		fclose($fp);
		echo "stop file created.\n\n";
	}
	
	function _removeStopFile() {
		if (file_exists(ReceiveMailShell::STOP_FILE_PATH)) {
			unlink(ReceiveMailShell::STOP_FILE_PATH);
		}
		echo "\nstop file removed.\n";
	}
	
	function _execute() {
		while (($filename = $this->_getOldestFile()) !== false) {
			$is_error = !$this->_processMail($filename);
			$this->_moveFile($filename, $is_error);
		}
	}
	
	function _getOldestFile() {
		if ($dir = opendir(ReceiveMailShell::MAIL_DIR_NEW)) {
			$oldest_file = null;
			$oldest_time = null;
			while (($file = readdir($dir)) !== false) {
				if (!is_dir($file)) {
					echo date("F d Y H:i:s.", filemtime(ReceiveMailShell::MAIL_DIR_NEW.$file));
					echo "$file\n";
					
					$temp_time = filemtime(ReceiveMailShell::MAIL_DIR_NEW . $file);
					if ($oldest_file == null
							||	$oldest_time > $temp_time) {
						$oldest_time = $temp_time;
						$oldest_file = $file;
					}

				}
			}
			closedir($dir);
			
			if ($oldest_file == null) {
				echo "nofile\n";
				return false;
			} else {
				echo "\noldest_file = \n";
				echo date("F d Y H:i:s.", filemtime(ReceiveMailShell::MAIL_DIR_NEW.$oldest_file));
				echo "$oldest_file\n";
				return $oldest_file;
			}
		}
	}
	
	function _moveFile($filename, $is_error=false) {
		$filepath_from = ReceiveMailShell::MAIL_DIR_NEW . $filename;
		if (is_file($filepath_from) === false) {
			return;
		}
		$filepath_to = ($is_error ? ReceiveMailShell::MAIL_DIR_DONE_ERROR : ReceiveMailShell::MAIL_DIR_DONE_NORMAL) . $filename;
		rename($filepath_from, $filepath_to);
	}
	
	function _processMail($filename) {
		$filepath = ReceiveMailShell::MAIL_DIR_NEW . $filename;
		if (is_file($filepath) === false) {
			return false;
		}
		
		//Dirayモデル呼び出し（思い出登録）
		
		return true;
	}
	
/*
	function user() {
		TransactionManager::begin();
		if ($result = ClassRegistry::init('User')->cleanup() {
			TransactionManager::commit();
		} else {
			TransactionManager::rollback();
		}

		$this->_debug($result);
	}
*/

}