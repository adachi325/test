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
		$User =& ClassRegistry::init('User');
		$Child =& ClassRegistry::init('Child');
		
		echo '-----'.PHP_EOL;
		$User->contain();
		$users = $User->find('all');
		foreach ($users as $user) {
			if (!$User->save_hashcode($user['User']['id'])) {
				echo 'faild id:'.$user['User']['id'].PHP_EOL;
			}
		}
		echo 'add hash to users'.PHP_EOL;
		$Child->contain();
		$children = $Child->find('all');
		foreach ($children as $child) {
			if (!$Child->save_hashcode($child['Child']['id'])) {
				echo 'faild id:'.$child['Child']['id'].PHP_EOL;
			}
		}
		echo 'add hash to children'.PHP_EOL;
		echo '-----'.PHP_EOL;
	}


}
