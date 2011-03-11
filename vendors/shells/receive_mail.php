<?php

App::import('Shell', 'AppShell');
App::import('Vendor', 'QdmailReceiver');

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
		echo "stop file created.\n";
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
				echo "\n".date("F d Y H:i:s.", filemtime(ReceiveMailShell::MAIL_DIR_NEW . $oldest_file));
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
		
		if (!($fp = fopen($filepath, "rb"))) {
			return false;
		}
		$maildata = fread($fp, filesize($filepath));
		
		$receiver = QdmailReceiver::start('direct', $maildata);
		$header = $receiver->header();

		$params = array();
		$params['to'] = isset($header['to'][0]['mail']) ? $header['to'][0]['mail'] : null;

		$params['subject'] = isset($header['subject']['name']) ? $header['subject']['name'] : null;

		$receiver->bodyAutoSelect();
		$params['body'] = !empty($receiver->body['text']['value']) ? $receiver->body['text']['value'] : null;

		var_dump($params);

		$images = $this->_getImageAttachments($receiver);
		$params['image'] = ($images !== null) ? $images[0] : null;
		
		//Dirayモデル呼び出し（思い出登録）
//		return ClassRegistry::init('Diary')->import($params);

		return true;
	}
	
	function _getImageAttachments(&$receiver) {
		return $this->_getAttachments($receiver->attach());
	}

	function _getAttachments($attach) {
		if (!empty($attach) && is_array($attach)) {
			$images = $this->__extractAttachments($attach);
		} else {
			$images = $this->__checkIphonesInvalidBody($receiver);
		}
		return $images;
	}

	function __checkIphonesInvalidBody(&$receiver) {
		if (!isset($receiver->body['attach'])) {
			return null;
		}
		return $this->__extractAttachments($receiver->body['attach']);
	}

	function __extractAttachments($attach) {
		if (Set::numeric(array_keys($attach))) {
			return Set::extract($attach, '/value');
		} elseif (isset($attach['value'])) {
			return array($attach['value']);
		}
		return null;
	}

}