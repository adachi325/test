<?php

App::import('Shell', 'AppShell');
class UpgradeShell extends AppShell {
	
	function main() {
		$this->addhash();
		$this->sethash();
	}

	function addhash() {
		$User =& ClassRegistry::init('User');
		$Child =& ClassRegistry::init('Child');

		echo '-----'.PHP_EOL;
		$data = $User->query('ALTER TABLE users ADD hash VARCHAR(10) DEFAULT NULL;');
		if ($data) {
			echo 'add hash to users'.PHP_EOL;
		}
		$data = $Child->query('ALTER TABLE children ADD hash VARCHAR(10) DEFAULT NULL;');
		if ($data) {
			echo 'add hash to children'.PHP_EOL;
		}
		echo '-----'.PHP_EOL;

	}

	function sethash() {
		$this->User =& ClassRegistry::init('User');
		$this->Child =& ClassRegistry::init('Child');
		
		$this->User->contain();
		$users = $this->User->find('all');
		foreach ($users as $user) {
			$this->User->save_hashcode($user['User']['id']);
		}

		$this->Child->contain();
		$children = $this->Child->find('all');
		foreach ($children as $child) {
			$this->Child->save_hashcode($child['Child']['id']);
		}
	}


}
