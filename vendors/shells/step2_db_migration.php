<?php
App::import('Shell', 'AppShell');

class Step2DbMigrationShell extends AppShell {

  /*
   * STEP2用のDBを構築します。
   * 前提:
   *   - Step1のDBがあること。
   *   - Step1残課題で変更されたDB構成を取り込んでいること。(upgradeシェルを実行してください。)
   */
  function main() {
    /* 新規テーブル作成 */
    $this->createArticlesTable();
    $this->createHanamarusTable();
    $this->createAttentionsTable();

    /* 既存テーブルにカラムを追加 */
    $this->addColumnsToDiariesTable();
  }

  function createArticlesTable() {
    $sql = "CREATE TABLE `articles` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
              `body` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
              `type` int(10) NOT NULL COMMENT '記事のタイプ\n1: 思い出記録、2: ニュース、3: 心理テスト、4: お知らせ',
              `external_id` bigint(10) NOT NULL COMMENT '記事タイプ先に紐づくID',
              `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '画像ファイルのパス',
              `release_date` datetime NOT NULL COMMENT 'リリース日時',
              `expire_date` datetime NOT NULL COMMENT '終了日時',
              `created` datetime NOT NULL,
              `modified` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB";

    $User =& ClassRegistry::init('User');

    echo '-----'.PHP_EOL;
    $data = $User->query($sql);

    $task = "create articles table";
    $result = $data ? "SUCCESS:" : "FAILED:";
    echo $result.$task.PHP_EOL;
    echo '-----'.PHP_EOL;
  }

  function createHanamarusTable() {
    $sql = "CREATE TABLE `hanamarus` (
            `id` int(10) NOT NULL AUTO_INCREMENT,
            `type` int(10) NOT NULL COMMENT '記事のタイプ\n1: 思い出記録、2: ニュース、 3:心理テスト',
            `external_id` bigint(10) NOT NULL COMMENT '記事タイプ先に紐づくID',
            `user_id` int(10) NOT NULL COMMENT 'はなまるをつけたユーザーID',
            `owner_id` int(10) NOT NULL COMMENT 'はなまるをもらったユーザーID\n外部コンテンツの場合は、別途定める',
            `created` datetime NOT NULL,
            `modified` datetime NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB";

    $User =& ClassRegistry::init('User');

    echo '-----'.PHP_EOL;
    $data = $User->query($sql);

    $task = "create hanamarus table.";
    $result = $data ? "SUCCESS:" : "FAILED:";
    echo $result.$task.PHP_EOL;
    echo '-----'.PHP_EOL;
  }

  function createAttentionsTable() {
    $sql = "CREATE TABLE `attentions` (
            `id` int(10) NOT NULL AUTO_INCREMENT,
            `type` int(10) NOT NULL,
            `external_id` bigint(10) NOT NULL,
            `user_id` int(10) NOT NULL,
            `created` datetime NOT NULL,
            `modified` datetime NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB;";

    $User =& ClassRegistry::init('User');

    echo '-----'.PHP_EOL;
    $data = $User->query($sql);
    $task = "create attentions table.";
    $result = $data ? "SUCCESS:" : "FAILED:";
    echo $result.$task.PHP_EOL;
    echo '-----'.PHP_EOL;
  }

  function addColumnsToDiariesTable() {
    $User =& ClassRegistry::init('User');

    echo '-----'.PHP_EOL;
    $data = $User->query('ALTER TABLE diaries
      ADD COLUMN wish_public TINYINT(1) NOT NULL DEFAULT 0,
      ADD COLUMN permit_status INT(10) NOT NULL DEFAULT 0,
      ADD COLUMN `identify_token` BIGINT(10) NULL DEFAULT NULL;');
    $task = "add wish_public, permit_status, identify_token to diaries table.";
    $result = $data ? "SUCCESS:" : "FAILED:";
    echo $result.$task.PHP_EOL;
    echo '-----'.PHP_EOL;
  }

}
