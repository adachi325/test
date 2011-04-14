<?php

App::import('Shell', 'AppShell');
class RemovePostcardShell extends AppShell {
	
	function main() {

		$this->PostcardUrl =& ClassRegistry::init('PostcardUrl');
		
		$data = $this->PostcardUrl->getExpiredUrls();
		foreach($data as $url) {
			$file = WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output'), $url['PostcardUrl']['token']);
			$file_thum = WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_thum'), $url['PostcardUrl']['token']);

			$this->PostcardUrl->delete($data['PostcardUrl']['id']);

			$this->_safe_delete($file);
			$this->_safe_delete($file_thum);
		}
	}

	function _safe_delete($filename) {
		if (file_exists($filename)) { unlink($filename); }
	}

}
