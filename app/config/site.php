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
		 0 => '背景画像',
		 1 => 'デコメ絵文字',
		 2 => '待受FLASH',
		 3 => 'ポストカード',
	),
	'membersonly' => array(
		-1 => '会員限定',
	),
        'path' => array(
                'diaryback_h' => 'present/template/diaryback/diaryback_%s%s_header.jpg',
                'diaryback_f' => 'present/template/diaryback/diaryback_%s%s_footer.jpg',
                'decome' => 'present/template/decome/%s.gif',
                'screen' => 'present/template/screen/%s.swf',
                'screen_thum' => 'present/template/screen/%s_thumb.jpg',
                'postcard' => 'present/template/postcard/%s.jpg',
                'postcard_thum' => 'present/template/postcard/%s_thumb.jpg',
                'postcard_output' => 'present/output/postcard/%s.jpg',
                'member_flash' => 'present/template/member_flash/%s.swf',
                'member_flash_thum' => 'present/template/member_flash/%s_thumb.jpg',
	),
);

$config['Defaults'] = array(
	'domain' => 'shimajiro-dev.com',
	'receive_mail_user' => 'iida',
	'receive_mail_prefix' => 'diary_',
);

$config['Mail'] = array(
	'from_addresses' => array(
		'admin' => array('address' => 'admin@' . $config['Defaults']['domain'], 'signature' => __('しまじろうひろば管理者', true)),
		'info' => array('address' => 'info@' . $config['Defaults']['domain'], 'signature' => __('しまじろうひろばサポート', true)),
	),
	'to_addresses' => array(
		'error' => array('address' => 'iida@designare.jp', 'signature' => __('しまじろうひろば管理者', true)),
	),
	'subjects' => array(
		'error' => __('【しまじろうひろば】障害通知', true),
	),
	'text' => array(
		'error' => __('メール処理で障害発生しました', true).PHP_EOL,
	),
);

$config['ReceiveMail'] = array(
	'stopfile_path' => APP . "tmp/stop.file",
	'ps_log_path' => APP . "app/tmp/ps.log",
	'mail_dir_new' => '/home/'.$config['Defaults']['receive_mail_user'].'/Maildir/new/',
	'mail_dir_done_normal' => '/home/'.$config['Defaults']['receive_mail_user'].'/Maildir/done/normal/',
	'mail_dir_done_error' => '/home/'.$config['Defaults']['receive_mail_user'].'/Maildir/done/error/',
);

$config['Diary'] = array(
	'hash_length' => 4,
	'image_thumb_size' => 200,
	'image_rect_size' => 100,
	'image_filesize_max' => 2000000,
	'image_path_original' => "photo/%s/%s_original.jpg",
	'image_path_thumb' => "photo/%s/%s_thumb.jpg",
	'image_path_rect' => "photo/%s/%s_rect.jpg",
);
