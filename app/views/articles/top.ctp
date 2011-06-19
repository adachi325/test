<div style="background-color:#ff9900;"><?php echo $this->Html->image("top_nypage_main.gif", array("alt" => "ケータイしまじろうひろば×ドコモコミュニティ", "width" => "100%", "border" => "0", "style" => "margin-bottom:2px;")); ?></div>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<?php 
if (!empty($uidErrorStr)) { 
	echo $this->element('session_timeout');
}
?>

<!-- お知らせ -->
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

<?php foreach($newslist as $news): ?>
<tr>
<td width="25%" align="left" valign="top" nowrap="nowrap" style="white-space:nowrap"><span style="font-size:x-small; color:#FF0000;">&nbsp;<?php echo ($news['News']['start_at'] > date("Y-m-d H:i:s", strtotime("-7 day"))) ? $this->Ktai->emoji(0xE6DD, false) : '&nbsp;･'; ?><?php echo $this->Time->format('n/j', $news['News']['start_at']); ?></span></td>
<td align="left" width="70%"><span style="font-size:x-small; color:#FF0000;"><?php echo $this->Wikiformat->makeLink($news['News']['title']); ?></span></td>
</tr>
<?php endforeach; ?>

</table>
<!-- お知らせ -->

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<div style="background-color:#ffcc00;">
<div style="background-color:#ffffff;"><?php echo $this->Html->image("tab_btn01_on.gif", array("alt" => "育児なう", "width" => "33%", "border" => "0")); ?><a href="<?php echo $this->Html->url('/diaries/top/'); ?>"><?php echo $this->Html->image("tab_btn02.gif", array("alt" => "思い出記録", "width" => "33%", "border" => "0", "class" => "test")); ?></a><a href="<?php echo $this->Html->url('/lines/top/'); ?>"><?php echo $this->Html->image("tab_btn03.gif", array("alt" => "こどもちゃれんじ", " width" => "33%", "border" => "0", "class" => "test")); ?></a></div>
<div style="background-color:#ffcc00;"><?php echo $this->Html->image("spacer.gif", array("height" => "2", "width" => "1")); ?></div>
<div style="background-color:#ffff99;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffff99">
<tr>
<td width="25%" rowspan="4" align="left" valign="top">
	<?php
	$img = '';
	$opt = array("alt" => "子ども画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;");

	if(empty($prof_diary)) {
		$img = $this->Html->image('profile.gif', $opt);
	} else {
		$img = $html->image(
			sprintf(Configure::read('Diary.image_path_rect'), $prof_diary['Diary']['child_id'], $prof_diary['Diary']['id']),
			array_merge($opt, array('url'=>'/diaries/info/'.$prof_diary['Diary']['id'].'/' )) );
	}

	echo $img;
	?>
</td>
<td><?php echo $this->Html->image("spacer.gif", array("height" => "5")); ?></td> 
</tr>
<tr>
<td align="left" valign="top"><span style="font-size:x-small; color:#333333;"><?php echo h($this->Session->read('Auth.User.loginid')); ?>さん</span></td>
</tr>
<tr>
<td align="left" valign="top"><span style="font-size:x-small; color:#333333;">もらった</span><?php echo $this->Html->image("icn_hanamaru.gif", array("style" => "margin-right:2px; margin-right:2px;")); ?><a href="<?php echo $this->Html->url('/hanamarus/received/'); ?>"><span style="font-size:x-small; color:#FF0000;"><?php echo $hanamaru_received;?>ｺ</span></a></td>
</tr>
<tr>
<td align="left" valign="top"><span style="font-size:x-small; color:#333333;">あげた</span><?php echo $this->Html->image("icn_hanamaru.gif", array("style" => "margin-right:2px; margin-right:2px;")); ?><a href="<?php echo $this->Html->url('/hanamarus/gave/'); ?>"><span style="font-size:x-small; color:#FF0000;"><?php echo $hanamaru_gave;?>ｺ</span></a></td>
</tr>
</table>
</div>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />
<div align="center" style="text-align:center; font-size:x-small; color:#666666;">
ﾆｭｰｽやお友達の様子などが､<br />
次々と更新されていきます!</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />

<?php echo $this->element('timeline/categories'); ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />

<!-- timeline -->
<?php echo $this->element('timeline/items'); ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />
<?php
// フィルタリング条件ごとに105-1b 育児なうのURLを作成する
$url = '/articles/timeline/';
if (isset($this->params['pass'][0])) {
  $url .= $this->params['pass'][0] . '/';
}
?>
<table width="100%" border="0">
<tr>
<td align="center"><a href="<?php echo $this->Html->url($url); ?>"><?php echo $this->Html->image("bt_more.gif", array("alt" => "もっと見る", "border" => "0")); ?></a><br />
<?php
// ドコモコミュニティのリンク先を設定する
$docomo_commu_url = 'http://docomo-community.cp05.docomo.ne.jp/djs/index.xhtml';
if ($this->Ktai->is_imode()) {
  $docomo_commu_url = 'http://docomo-community.cp05.docomo.ne.jp/djs/index.xhtml';
} else {
  $docomo_commu_url = 'http://docomo-community.com/djs/index.xhtml';
}
?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<a href="<?php echo $docomo_commu_url; ?>"><?php echo $this->Html->image("docomo_commu_banner.gif", array("alt" => "ドコモコミュニティ", "width" => "100%", "border" => "0")); ?></a><br />
</td>
</tr>
</table>
<!-- ページトップへ -->
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="right" style="text-align:right;"><span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE6E0); ?><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></span></div>
<br />

