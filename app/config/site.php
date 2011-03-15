<?php 

$config['Lines'] = array (
	'categories' => array(
		'baby',
		'petit_f',
		'petit',
		'pocket',
		'hop',
		'step',
		'jump',
	),
);

$config['Present'] = array(
	'type' => array(
		'背景画像' => 0,
		'教材コンテンツ' => 1, 
		'待受FLASH' => 2, 
		'ポストカード' => 3,
	),
	'membersonly' => array(
		'会員限定' => -1,
	)
);


$config['Defaults'] = array(
	'domain' => 'shimajiro-dev.com',
	'receive_mail_user' => 'iida',
	'receive_mail_prefix' => 'diary_',
);

$config['Mail'] = array(
	'from_addresses' => array(
		'admin' => array('address' => 'admin@' . $config['Defaults']['domain'], 'signature' => __('しまじろうひろば管理者')),
		'info' => array('address' => 'info@' . $config['Defaults']['domain'], 'signature' => __('しまじろうひろばサポート')),
	),
	'to_addresses' => array(
		'error' => array('address' => 'iida@designare.jp', 'signature' => __('しまじろうひろば管理者')),
	),
	'subjects' => array(
		'error' => __('【しまじろうひろば】障害通知'),
	),
	'text' => array(
		'error' => __('メール処理で障害発生しました'."\r\n"),
	),
);

$config['ReceiveMail'] = array(
	'stopfile_path' => '../../app/tmp/stop.file',
	'ps_log_path' => '../../app/tmp/ps.log',
	'mail_dir_new' => '/home/'.$config['Defaults']['receive_mail_user'].'/Maildir/new/',
	'mail_dir_done_normal' => '/home/'.$config['Defaults']['receive_mail_user'].'/Maildir/done/normal/',
	'mail_dir_done_error' => '/home/'.$config['Defaults']['receive_mail_user'].'/Maildir/done/error/',
);

$config['Diary'] = array(
	'hash_length' => 4,
);

