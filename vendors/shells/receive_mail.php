<?php

App::import('Shell', 'AppShell');
App::import('Vendor', 'QdmailReceiver');
class ReceiveMailShell extends AppShell {
	
	function main() {
		
		$this->_saveMail();
		
		
		
		if ($this->_stopfileExists()) {
			echo "other process is running.\n";
			return;
		}
		
		try {
			$this->_createStopfile();
			$this->_execute();
			$this->_removeStopfile();
		} catch(Exception $e) {
			$this->sendErrorMail($e->getMessage());
			$this->_removeStopfile();
			exit();
		}
		
	}
	
	function _saveMail() {
		$stdin = file_get_contents('php://stdin');
		$filename = microtime() . '.' . getmypid() . '.' . Configure::read('Defaults.domain');
		$filepath = Configure::read('ReceiveMail.mail_dir_new') . $filename;
		$fp = fopen($filepath, "w");
		flock($fp, LOCK_EX);
		fwrite($fp, $stdin, strlen($stdin));
		flock($fp, LOCK_UN);
		rewind($fp);
		fclose($fp);
		
//		chmod($filepath, 0777);
	}
	
	function _stopfileExists() {
		return file_exists(Configure::read('ReceiveMail.stopfile_path'));
	}
	
	function _createStopfile() {
		$body = getmypid();
		$fp = fopen(Configure::read('ReceiveMail.stopfile_path'), "w");
		flock($fp, LOCK_EX);
		fwrite($fp, $body, strlen($body));
		flock($fp, LOCK_UN);
		rewind($fp);
		fclose($fp);
		echo "stopfile was created.\n";
	}
	
	function _removeStopfile() {
		if (file_exists(Configure::read('ReceiveMail.stopfile_path'))) {
			unlink(Configure::read('ReceiveMail.stopfile_path'));
		}
		echo "\nstopfile was removed.\n";
	}
	
	function _execute() {
		while (($filename = $this->_getOldestMail()) !== false) {
			try {
		echo "_execute _processMail\n";
				$is_error = !$this->_processMail($filename);
//				$this->_moveMail($filename, $is_error);
				$this->_deleteMail($filename);//ログは残さない
			} catch(Exception $e) {
//				$this->_moveMail($filename, true);
				$this->_deleteMail($filename);//ログは残さない
				throw new Exception($e->getMessage());
			}
		}
	}
	
	function _getOldestMail() {
		if ($dir = opendir(Configure::read('ReceiveMail.mail_dir_new'))) {
			$oldest_file = null;
			$oldest_time = null;
			
			while (($file = readdir($dir)) !== false) {
				if (!is_dir($file)) {
					$temp_time = filemtime(Configure::read('ReceiveMail.mail_dir_new') . $file);
					if ($oldest_file == null
							||	$oldest_time > $temp_time) {
						$oldest_time = $temp_time;
						$oldest_file = $file;
					}
				}
			}
			closedir($dir);
			
			if ($oldest_file == null) {
				return false;
			} else {
				return $oldest_file;
			}
		}
	}
	
	function _moveMail($filename, $is_error=false) {
		$filepath_from = Configure::read('ReceiveMail.mail_dir_new') . $filename;
		if (is_file($filepath_from) === false) {
			return;
		}
		$filepath_to = ($is_error ? Configure::read('ReceiveMail.mail_dir_done_error') : Configure::read('ReceiveMail.mail_dir_done_normal')) . $filename;
		rename($filepath_from, $filepath_to);
	}
	
	function _deleteMail($filename) {
		$filepath = Configure::read('ReceiveMail.mail_dir_new') . $filename;
		if (is_file($filepath) === false) {
			return;
		}
		unlink($filepath);
	}
	
	function _processMail($filename) {
	
		$filepath = Configure::read('ReceiveMail.mail_dir_new') . $filename;
		
		if (!($fp = fopen($filepath, "rb"))) {
			return false;
		}
		$maildata = fread($fp, filesize($filepath));
		fclose($fp);
		
		$receiver = QdmailReceiver::start('direct', $maildata);
		//$receiver->unitedCharset( 'UTF-8' );
		$header = $receiver->header();

		$params = array();
		$params['to'] = isset($header['to'][0]['mail']) ? $header['to'][0]['mail'] : "";
		
		$params['subject'] = isset($header['subject']['name']) ? $header['subject']['name'] : "";
		
		$receiver->bodyAutoSelect();

		if(!empty($receiver->body['text']['value'])){
		    $receiver->body['text']['value'] = mb_convert_encoding($receiver->body['text']['value'], "ISO-2022-JP" , "sjis");
		}

		$params['body'] = !empty($receiver->body['text']['value']) ? $receiver->body['text']['value'] : "";

		$images = $this->_getImageAttachments($receiver);
		$params['images'] = ($images !== null) ? $images : array();
		
		//Dirayモデル呼び出し（思い出登録）
		return ClassRegistry::init('Diary')->importMail($params);
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
	
	function sendErrorMail($message) {
		App::import('Component', 'Qdmail');
		$mail = new Qdmail();
		$mail->to(Configure::read('Mail.to_addresses.error.address'), Configure::read('Mail.to_addresses.error.signature'));
		$mail->from(Configure::read('Mail.from_addresses.admin.address'), Configure::read('Mail.from_addresses.admin.signature'));
		$mail->subject(Configure::read('Mail.subjects.error'));
		$mail->text(Configure::read('Mail.text.error').$message);
		$mail->send();
	}

}