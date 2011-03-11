<?php

App::import('Shell', 'AppShell');
class ReceiveMailShell extends AppShell {
	
	const STOP_FILE_PATH = "../../app/tmp/stop.file";
	
	function main() {
		
//		echo getmypid();
//		echo "\n";
//		echo ReceiveMailShell::STOP_FILE_PATH;
//		echo "\n";
		
		if ($this->checkStopFile()) {
			$this->removeStopFile();
		} else {
			$this->createStopFile();
		}
		
	}
	
	function checkStopFile() {
		return file_exists(ReceiveMailShell::STOP_FILE_PATH);
	}
	
	function createStopFile() {
		$body = getmypid();
		$fp = fopen(ReceiveMailShell::STOP_FILE_PATH, "w");
		flock($fp, LOCK_EX);
		fwrite($fp, $body, strlen($body));
		flock($fp, LOCK_UN);
		rewind($fp);
		fclose($fp);
	}
	
	function removeStopFile() {
		unlink(ReceiveMailShell::STOP_FILE_PATH);
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

	function rss() {
		
	}
*/

}