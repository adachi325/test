<a name="top" id="top"></a>
<div style="font-size:x-small; color:#333333;">
<div style="background-color:#ff9900;"><?php echo $this->Html->image("top_nypage_main.gif", array("alt" => "ケータイしまじろうひろば×ドコモコミュニティ", "width" => "100%", "border" => "0", "style" => "margin-bottom:2px;")); ?></div>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<!-- お知らせ -->
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

<?php foreach($newslist as $news): ?>

<tr>
<td width="25%" align="left" valign="top" nowrap="nowrap" style="white-space:nowrap"><span style="font-size:x-small; color:#FF0000;">&nbsp;<?php echo ($news['news']['start_at'] > date("Y-m-d H:i:s", strtotime("-7 day"))) ? $this->Ktai->emoji(0xE6DD, false) : '&nbsp;･'; ?><?php echo $this->Time->format('n/j', $news['news']['start_at']); ?></span></td>
<td align="left" width="70%"><span style="font-size:x-small; color:#FF0000;"><?php echo $this->Wikiformat->makeLink($news['news']['title']); ?></span></td>
</tr>
<?php endforeach; ?>

</table>
<!-- お知らせ -->

<!-- FIXME: 確認のためのリンクです、削除する際はエレメントも削除してください app/view/elements/default/test_link.ctp -->
<?php echo $this->element('default/test_link'); ?>


<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<div style="background-color:#ffcc00;">
<div style="background-color:#ffffff;"><?php echo $this->Html->image("tab_btn01_on.gif", array("alt" => "育児なう", "width" => "33%", "border" => "0")); ?><a href="<?php echo $this->Html->url('/diaries/top/'); ?>"><?php echo $this->Html->image("tab_btn02.gif", array("alt" => "思い出記録", "width" => "33%", "border" => "0", "class" => "test")); ?></a><a href="<?php echo $this->Html->url('/lines/top/'); ?>"><?php echo $this->Html->image("tab_btn03.gif", array("alt" => "こどもちゃれんじ", " width" => "33%", "border" => "0", "class" => "test")); ?></a></div>
<div style="background-color:#ffcc00;"><?php echo $this->Html->image("spacer.gif", array("height" => "2", "width" => "1")); ?></div>
<div style="background-color:#ffff99;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffff99">
<tr>
<td width="25%" rowspan="4" align="left" valign="top"><?php echo $this->Html->image("album_pic01_02.jpg", array("alt" => "子ども画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); ?></td>
<td><?php echo $this->Html->image("spacer.gif", array()); ?></td>
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
<div align="center" style="text-align:center;"><a href="#"><?php echo $this->Html->image("docomo_commu_banner.gif", array("alt" => "ドコモコミュニティ", "width" => "80%", "border" => "0")); ?></a></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td><span style="font-size:x-small; color:#ff9900;">▼ｶﾃｺﾞﾘ別に見る</span><br /><span style="font-size:x-small; color:#333333;"><a href="#" style="color:#0099FF;"><span style="color:#0099FF;">ﾆｭｰｽ</span></a>｜<a href="#"><span style="color:#9933CC;">心理ﾃｽﾄ</span></a>｜<a href="#"><span style="color:#339900;">お友達の様子</span></a><br />
<a href="#"><span style="color:#ff9900;">お知らせ</span></a>｜<a href="#"><span style="color:#ff9900;">すべて</span></a></span></td>
</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#ffffcc">
<tr>
<td width="25%" rowspan="2" align="left" valign="top"><?php echo $this->Html->image("icn_green_aboutfriend.gif", array("alt" => "お友達の様子", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br /><?php echo $this->Html->image("album_pic01_02.jpg", array("alt" => "子ども画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); ?></td>
<td colspan="2" align="left" valign="top"><a href="#"style="color:#339900;"><span style="font-size:x-small; color:#339900;">テーマサンプルタイトルタイトル</span></a></td>
</tr>
<tr>
<td colspan="2" align="left" valign="top"><span style="font-size:x-small;"><span style="color:#333333;">テキストテキストテキストテキストテキストテキストテキストテキストテ</span><br /><span style="color:#339933;">●才●ヶ月のお友達</span></span></td>
</tr>
<tr>
<td valign="middle"><a href="#"><?php echo $this->Html->image("icn_hanamaru_btn.gif", array("alt" => "はなまる", "width" => "100%", "style" => "margin:0 0 3px 0;")); ?></a></td>
<td align="left" valign="middle"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?><br /><?php echo $this->Html->image("spacer.gif", array("width" => "4", "height" => "1")); ?><span style="font-size:x-small; color:#FF0000;">10ｺ</span></td>
<td align="right" valign="middle"><span style="font-size:x-small; color:#666666;">5月5日</span></td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
<tr>
<td width="25%" rowspan="2" align="left" valign="top" nowrap="nowrap" style="white-space:nowrap; font-size:x-small; color:#ff9900;"><?php echo $this->Html->image("icn_yellow_oshirase.gif", array("alt" => "お知らせ", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br />
<?php echo $this->Html->image("pic_oshirase_present.gif", array("alt" => "プレゼント画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); ?></td>
<td colspan="2" align="left" valign="top"><a href="#" style="color:#ff9900;"><span style="font-size:x-small; color:#ff9900;">ﾌﾟﾚｾﾞﾝﾄ</span></a></td>
</tr>
<tr>
<td colspan="2" align="left" valign="top"><span style="font-size:x-small; color:#333333;">テキストテキストテキストテキスト</span></td>
</tr>
<tr>
<td valign="middle" nowrap="nowrap" style="white-space:nowrap; font-size:x-small; color:#333333;"></td>
<td align="left" valign="top"></td>
<td align="right" valign="middle"><span style="font-size:x-small; color:#666666;">5月5日</span></td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#ffffcc">
<tr>
<td width="25%" rowspan="2" align="left" valign="top" style=" font-size:x-small; color:#ff9900;"><?php echo $this->Html->image("icn_bule_news.gif", array("alt" => "ニュース", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br /><?php echo $this->Html->image("album_pic02.jpg", array("alt" => "プレゼント画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); ?></td>
<td colspan="2" align="left" valign="top"><a href="#" style="color:#0099FF;"><span style="font-size:x-small; color:#0099FF;">テーマサンプルタイトル</span></a></td>
</tr>
<tr>
<td colspan="2" align="left" valign="top"><span style="font-size:x-small; color:#333333;">テキストテキストテキストテキストテキストテキストテキストテキストテ(共同通信社)</span></td>
</tr>
<tr>
<td valign="middle" nowrap="nowrap" style="white-space:nowrap;"><a href="#"><?php echo $this->Html->image("icn_attention.gif", array("alt" => "注目", "width" => "100%", "style" => "margin:0 0 3px 0;")); ?></a></td>
<td align="left" valign="middle"><?php echo $this->Html->image("spacer.gif", array("width" => "4", "height" => "1")); ?><span style="font-size:x-small; color:#FF0000;">10ｺ</span></td>
<td align="right" valign="middle"><span style="font-size:x-small; color:#666666;">5月5日</span></td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
<tr>
<td width="25%" rowspan="2" align="left" valign="top" nowrap="nowrap" style="white-space:nowrap; font-size:x-small; color:#ff9900;"><?php echo $this->Html->image("icn_purple_psycho.gif", array("alt" => "心理テスト", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br />
<?php echo $this->Html->image("pic_psycho01.gif", array("alt" => "プレゼント画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); ?></td>
<td colspan="2" align="left" valign="top"><a href="802.html" style="color:#9933CC;"><span style="font-size:x-small; color:#9933CC;">気づいていないあなたのｵﾊﾞさんﾀｲﾌﾟ</span></a></td>
</tr>
<tr>
<td colspan="2" align="left" valign="top"><span style="font-size:x-small; color:#333333;">もうすぐ梅雨入り｡あなたがまず準備することは?<br />
<a href="802.html#psycho1" style="color:#9933CC;"><span style="color:#9933CC;">【1.傘を買う】</span></a><br />
<a href="802.html#psycho2" style="color:#9933CC;"><span style="color:#9933CC;">【2.布団を干す】</span></a><br />
<a href="802.html#psycho3" style="color:#9933CC;"><span style="color:#9933CC;">【3.冷蔵庫の掃除】</span></a><br />
</span>
</td>
</tr>
<tr>
<td valign="middle" nowrap="nowrap" style="white-space:nowrap; font-size:x-small; color:#333333;"></td>
<td align="left" valign="top" style="font-size:x-small;"></td>
<td align="right" valign="middle"><span style="font-size:x-small; color:#666666;">5月5日</span></td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#ffffcc">
<tr>
<td width="25%" rowspan="2" align="left" valign="top" nowrap="nowrap" style="white-space:nowrap; font-size:x-small; color:#ff9900;"><?php echo $this->Html->image("icn_yellow_oshirase.gif", array("alt" => "お知らせ", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br />
<?php echo $this->Html->image("pic_oshirase_omoide.gif", array("alt" => "子ども画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); ?></td>
<td colspan="2" align="left" valign="top"><a href="#" style="color:#ff9900;"><span style="font-size:x-small; color:#ff9900;">思い出ﾃｰﾏ更新!</span></a></td>
</tr>
<tr>
<td colspan="2" align="left" valign="top">
<span style=" font-size:x-small; color:#ff9900;">&nbsp;･思い出記録タイトル<br />&nbsp;･思い出記録タイトル</span><br />
<span style="font-size:x-small; color:#333333;">今日はどんなことがあったかな?お子さんの成長をかわいく残そう!</span></td>
</tr>
<tr>
<td valign="middle" style="font-size:x-small; color:#333333;"></td>
<td align="left" valign="top" style="font-size:x-small;"></td>
<td align="right" valign="middle"><span style="font-size:x-small; color:#666666;">5月5日</span></td>
</tr>
</table>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />
<table width="100%" border="0">
<tr>
<td align="center"><a href="#"><?php echo $this->Html->image("bt_more.gif", array("alt" => "もっと見る", "border" => "0")); ?></a></td>
</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />

