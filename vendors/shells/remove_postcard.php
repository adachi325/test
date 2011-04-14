<?php

App::import('Shell', 'AppShell');
class RemovePostcardShell extends AppShell {
	
	public $uses = array('PostcardUrl');

	function main() {

		$data = $this->PostcardUrl->testGetExpiredUrls();
		foreach($data as $url) {
			$file = WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output'), $url['PostcardUrl']['token']);
			$file_thum = WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_thum'), $url['PostcardUrl']['token']);

			$this->_safe_delete($file);
			$this->_safe_delete($file_thum);
		}
	}

	function _safe_delete($filename) {
		if (file_exists($filename)) { unlink($filename); }
	}

}
