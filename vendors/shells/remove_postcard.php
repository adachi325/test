<?php

App::import('Shell', 'AppShell');
class RemovePostcardShell extends AppShell {
	
	function main() {
//		echo "RemovePostcardShell start.\n";
		
		$dirpath = WWW_ROOT . Configure::read('Present.postcard.output_dir');
		if ($dir = opendir($dirpath)) {
			while (($file = readdir($dir)) !== false) {
				if (!is_dir($file)
						&& !$this->_isAvailablePostcard($dirpath . $file)) {
					unlink($dirpath . $file);
				}
			}
			closedir($dir);
		}
		
//		echo "RemovePostcardShell end.\n";
	}
	
	function _isAvailablePostcard($filepath) {
		$hour_diff = (time() - filemtime($filepath)) / 3600;
		return $hour_diff <= Configure::read('Present.postcard.valid_hours');
	}

}