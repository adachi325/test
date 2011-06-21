<a name="top" id="top"></a>
<div style="font-size:x-small; color:#333333;">
<div style="background-color:#ffff99;text-align:center;" align="center"><?php echo $this->Html->image("top_nypage_main.gif", array("alt" => "ケータイしまじろうひろば×ドコモコミュニティ", "width" => "100%", "border" => "0", "style" => "margin-bottom:2px;")); ?>
<div align="left">
<?php 
if (!empty($uidErrorStr)) { 
	echo $this->element('session_timeout');
}
?>
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffff99">
<tr><td align="center"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="font-size:x-small">ｹﾞｰﾑや動画で遊んで<br />素敵に写真が残せる<?php $this->Ktai->emoji(0xE741); ?></span><br />
<span style="font-size:medium;"><?php $this->Ktai->emoji(0xE6FA); ?><a href="<?php echo $this->Html->url('/navigations/prev/2'); ?>">今すぐ登録!(無料)</a><?php $this->Ktai->emoji(0xE6FA); ?></span><br />
<span style="font-size:x-small"><?php $this->Ktai->emoji(0xE688); ?>3ｷｬﾘｱ対応<?php $this->Ktai->emoji(0xE694); ?></span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></td></tr>
</table>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td align="right"><span style="font-size:xx-small;">
※別途ﾊﾟｹｯﾄ通信料がかかります<br />
ｻ-ﾋﾞｽ詳細は<a href="<?php echo $this->Html->url('/navigations/prev/1'); ?>"><span style="color:#0033ff">こちら</span></a><br />
登録済みの方は<a href="<?php echo $this->Html->url("/users/login/"); ?>"><span style="color:#0033ff">こちら</span></a></span></td></tr>
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<div align="center" style="font-size:x-small">↓3つのｺﾝﾃﾝﾂが楽しめます↓</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</td>
</tr>
</table>

<div style="background-color:#ffcc00;">
<div style="background-color:#ffffff;"><?php echo $this->Html->image("tab_btn01_on.gif", array("alt" => "育児なう", "width" => "33%", "border" => "0")); ?><a href="<?php echo $this->Html->url('/diaries/top'); ?>"><?php echo $this->Html->image("tab_btn02.gif", array("alt" => "思い出記録", "width" => "33%", "border" => "0", "class" => "test")); ?></a><a href="<?php echo $this->Html->url('/lines/top'); ?>"><?php echo $this->Html->image("tab_btn03.gif", array("alt" => "こどもちゃれんじ", " width" => "33%", "border" => "0", "class" => "test")); ?></a></div>
<div style="background-color:#ffcc00;"><?php echo $this->Html->image("spacer.gif", array("height" => "2", "width" => "1")); ?></div>
<div align="center" style="background-color:#ffff99;text-align:center">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td align="center"><span style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />
<span style="color:#663300">
育児に関するﾆｭーｽや<br />お友達の様子をﾁｪｯｸしよう♪</span><br />
<span style="color:#333333">ｶﾝﾀﾝ登録で情報が見られるよ</span><?php $this->Ktai->emoji(0xE6ED); ?></span><br />
<span style="font-size:medium;"><?php $this->Ktai->emoji(0xE6FA); ?><a href="<?php echo $this->Html->url('/navigations/prev/2'); ?>">今すぐ登録!(無料)</a><?php $this->Ktai->emoji(0xE6FA); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</td></tr>
</table>
</div>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />

<?php
echo $this->element('timeline/categories');
?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />

<?php /* テーマサンプル 手動です */ ?>
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#ffffcc">
<tr>
<td width="25%" rowspan="2" align="left" valign="top">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Html->image("icn_green_aboutfriend.gif", array("alt" => "お友達の様子", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br /><?php echo $this->Html->image("theme/theme_22.gif", array("alt" => "子ども画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); ?></td>
<td colspan="3" align="left" valign="top">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="<?php echo $this->Html->url('/navigations/prev/1'); ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">今週のお出かけ</span></a></td>
</tr>
<tr>
<td colspan="3" align="left" valign="top">
    <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
    <span style="font-size:x-small;color:#333333;">動物園にやってきました｡楽しいね♪</span><br /><div align="right" style="text-align:right;color:#339933;margin-top:10px;font-size:x-small">2才0ｶ月のお友達</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></td>
</tr>
<tr>
<td valign="middle" nowrap="nowrap" style="white-space:nowrap;">&nbsp;</td>
<td align="left" valign="middle" width="25%"><a href="<?php echo $this->Html->url('/navigations/prev/1'); ?>"><?php echo $this->Html->image("icn_hanamaru_btn.gif", array("alt" => "はなまる", "width" => "100%", "style" => "margin:4px 2px 4px 0;")); ?></a></td>
<td align="left" valign="middle" width="20%"><span style="font-size:x-small; color:#FF0000;">5ｺ</span></td>
<td align="right" valign="middle" width="30%"><span style="font-size:x-small; color:#666666;">6月24日</span></td>
</tr>
</table>

<!-- タイムライン -->
<?php echo $this->element('timeline/items_guest'); ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />
<table width="100%" border="0">
<tr>
<td align="center"><a href="<?php echo $this->Html->url('/navigations/prev/1'); ?>"><?php echo $this->Html->image("bt_more.gif", array("alt" => "もっと見る", "width" => "80%", "border" => "0")); ?></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php
// ドコモコミュニティのリンク先を設定する
if ($this->Ktai->is_imode()) {
  $docomo_commu_url = 'http://docomo-community.cp05.docomo.ne.jp/djs/index.xhtml';
} else {
  $docomo_commu_url = 'http://docomo-community.com/djs/index.xhtml';
}
?>
<a href="<?php echo $docomo_commu_url ?>"><?php echo $this->Html->image("docomo_commu_banner.gif", array("alt" => "ドコモコミュニティ", "width" => "100%", "border" => "0")); ?></a><br />
</td>
</tr>
</table>
<!-- ページトップへ -->
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="right" style="text-align:right;"><span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE6E0); ?><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></span></div>
<br />
