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

$config['LinesString'] = array (
	'strings' => array(
		1 => 'baby/ぷちﾌｧｰｽﾄ',
		2 => 'ぷち',
		3 => 'ぽけっと',
		4 => 'ほっぷ',
		5 => 'すてっぷ',
		6 => 'じゃんぷ',
	),
	'age' => array(
		'baby' => array('0～1歳向けｺｰｽ', '#ee86b4'),
		'petit_f' => array('1歳前後向けｺｰｽ', '#e61953'),
		'petit' => array('1～2歳向けｺｰｽ', '#e61953'),
		'pocket' => array('2～3歳向けｺｰｽ', '#ffcc00'),
		'hop' => array('3～4歳向けｺｰｽ', '#00b0ec'),
                'step' => array('4～5歳向けｺｰｽ', '#009933'),
		'jump' => array('5～6歳向けｺｰｽ', '#0066cc'),
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
                'diaryback_t' => 'present/template/diaryback/diaryback_%s%s_thumb.gif',
                'decome' => 'present/template/decome/%s.gif',
                'screen' => 'present/template/screen/%s.swf',
                'screen_thum' => 'present/template/screen/%s_thumb.jpg',
                'screen_output' => 'img/photo/%s/%s.swf',
                'postcard' => 'present/template/postcard/%s.png',
                'postcard_thum' => 'present/template/postcard/%s_thumb.jpg',
                'postcard_output' => 'present/output/postcard/%s.jpg',
                'postcard_output_thum' => 'present/output/postcard/%s_thumb.jpg',
                'member_flash' => 'present/template/member_flash/%s.swf',
                'member_flash_thum' => 'present/template/member_flash/%s_thumb.jpg',
	),
	'postcard' => array(
		'valid_hours' => 72,
		'output_dir' => 'present/output/postcard/',
	),
);

$config['Defaults'] = array(
	'domain' => 'shimajiro-dev.com',
	'receive_mail_prefix' => 'diary_',
        'docomo_community' => 'diary@docomo-community.com',
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
	'stopfile_path' => APP . "tmp/receive_mail/stop.file",
	'ps_log_path' => APP . "tmp/receive_mail/ps.log",
	'mail_dir_new' => APP . "tmp/receive_mail/new/",
	'mail_dir_done_normal' => APP . "tmp/receive_mail/done/normal/",
	'mail_dir_done_error' => APP . "tmp/receive_mail/done/error/",
);

$config['Diary'] = array(
	'hash_length' => 4,
	'image_filesize_max' => 2000000,
	'image_size_thumb' => 220,		//このサイズ内に元の比率で収まるようにリサイズ
	'image_size_rect' => 75,		//正方形
	'image_size_postcard' => 210,	//正方形
	'image_path_original' => "photo/%s/%s_original.jpg",	//一時保存用
	'image_path_thumb' => "photo/%s/%s_thumb.jpg",			//比率保持サムネイル
	'image_path_rect' => "photo/%s/%s_rect.jpg",			//正方形サムネイル
	'image_path_postcard' => "photo/%s/%s_postcard.jpg",	//ポストカード用
	'title_len_max' => 20,
	'body_len_max' => 5000,
	'error_filesize_over' => 'E001',
	'error_out_of_jpeg' => 'E002',
);

$config['Child'] = array(
        'icon_on_path' => 'common/icon_%s_on.gif',
        'icon_off_path' => 'common/icon_%s_off.gif',
        'child_tab_color' => array(
            0 => '#FFFA8E',
            1 => '#CCFFFF',
            2 => '#FFCCFF',
        ),
        'Initial_registration_presents' => array(
            0 => '1',
            1 => '2',
		),
        'birthday_years' => 8,
);

$config['Error'] = array(
        'nothingUid' => array(
            'dc' => '「iMENU」→「お客様サポート」→「各種設定(確認・変更・利用)」→「iモードID通知設定」',
            'ez' => '「EZメニュー」→「機能」→「時間/料金/申込」→「各種申込」→「EZ番号通知設定」',
            'sb' => '「Yahoo!ケータイ」→「設定・申込」→「端末・サービス設定」→「ユーザーID通知設定」',
        ),
);
 
