<?php
App::import('Shell', 'AppShell');

class Step3DbMigrationShell extends AppShell {

    /*
     * STEP3用のDBを構築します。
     */
    function main() {
        $this->addColumnsToContentsTable();
    }

    function addColumnsToContentsTable() {
        $User =& ClassRegistry::init('User');

        echo '-----'.PHP_EOL;
        $data = $User->query('ALTER TABLE contents 
            ADD COLUMN android_flag TINYINT(1) NOT NULL DEFAULT 0 ;');
        
        $task = "add android_flag to contents table.";
        $result = $data ? "SUCCESS:" : "FAILED:";
        echo $result.$task.PHP_EOL;
        echo '-----'.PHP_EOL;
    }

}
