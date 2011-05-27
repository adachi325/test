<div align="center" style="text-align:center;">
<?php echo $this->Html->image("main.gif", array("width" => "100%")); ?><br />
楽しく遊んで<br />成長の記録が残せる<span style="color:#339933"><?php $this->Ktai->emoji(0xe741); ?></span><br />
&lt;こどもちゃれんじ&gt;ｹｰﾀｲｻｲﾄ
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php if (!empty($uidErrorStr)) { ?>
<span style="color:#cc0000">入力画面で長時間放置されたためセッションが切断されました。</span><br />
<span style="color:#cc0000">再度登録を実行してください。</span><br />
<?php } ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="center" style="background:#ffff99; text-align:center;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#cc0000;">ﾌﾟﾛﾌｨｰﾙ登録で今なら<br />ｹﾞｰﾑﾌﾟﾚｾﾞﾝﾄ!</span><br />
<span style="font-size:medium;"><span style="color:#ff00ff;"><?php $this->Ktai->emoji(0xE6FA); ?></span><a href="<?php echo $this->Html->url('/navigations/prev/2'); ?>">今すぐ登録!(無料)</a><span style="color:#ff00ff;"><?php $this->Ktai->emoji(0xE6FA); ?></span></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
※ｻｰﾋﾞｽ利用料は<span style="color:#cc0000;">無料</span>です<br />
※別途ﾊﾟｹｯﾄ通信料がかかります<br />
※3ｷｬﾘｱ対応<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="right" style="text-align:right;">登録済みの方は<a href="<?php echo $this->Html->url("/users/login/"); ?>">こちら</a></div>
<div style="background:#ff9900;"><?php echo $this->Html->image("img_obj.gif", array("width" => "100%", "style" => "margin-bottom:1px;")); ?><br /></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_info.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_info.gif", array("width" => "100%")); ?></td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0">

<?php foreach($newslist as $news): ?>
<tr>
<td width="50" valign="top" nowrap="nowrap" style="white-space:nowrap"><span style="font-size:x-small;">
<span style="color:#ff9900;">
<span style="color:#ff9900;"><?php echo ($news['news']['start_at'] > date("Y-m-d H:i:s", strtotime("-7 day"))) ? $this->Ktai->emoji(0xE6DD, false) : '&nbsp;･'; ?></span>
</span><?php echo $this->Time->format('n/j', $news['news']['start_at']); ?></span>
</td>
<td align="left">
<span style="font-size:x-small;"><?php echo  $this->Wikiformat->makeLink($news['news']['title']); ?></span>
</td>
</tr>
<?php endforeach; ?>

</table>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php echo $this->Html->image("ttl_fun.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_mobile.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_challenge.gif", array("width" => "100%")); ?></td>
</tr>
</table>

<?php echo $this->Html->image("60pic_kodomo101.gif", array( "align" => "left", "style" => "float:left; margin-right:2px;")); ?>
&lt;こどもちゃれんじ&gt;教材と連動した年齢別ｺﾝﾃﾝﾂが楽しめる!<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?></div>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_orrange.gif", array()); ?></div>


<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_album.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_memory.gif", array("width" => "100%")); ?></td>
</tr>
</table>
<?php echo $this->Html->image("60pic_omoide101.gif", array("align" => "left", "style" => "float:left; margin-right:2px;")); ?>お子さんの成長がかわいく残せる!写真がたまるとﾎﾟｽﾄｶｰﾄﾞに♪<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?></div>

<div align="center" style="text-align:center;"><a href="<?php echo $this->Html->url('/navigations/prev/1');?>"><span style="color:#ff6600;">更に詳しく見る</span></a><span style="color:#cc0000;"><?php $this->Ktai->emoji(0xE6F5); ?></span></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<div align="center" style="background:#ffff99; text-align:center;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="font-size:medium;"><span style="color:#ff00ff;"><?php $this->Ktai->emoji(0xE6FA); ?></span><a href="<?php echo $this->Html->url('/navigations/prev/2'); ?>">今すぐ登録!(無料)</a><span style="color:#ff00ff;"><?php $this->Ktai->emoji(0xE6FA); ?></span></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div>

<?php echo $this->Html->image("ttl_challenge.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_mobile.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_course.gif", array("width" => "100%")); ?></td>
</tr>
</table>
<span style="color:#cc0000;">&nbsp;･</span><a href="<?php echo $this->Html->url('/ap/baby/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">0～1歳向け baby/ぷちﾌｧｰｽﾄ</span></a><br />
<span style="color:#cc0000;">&nbsp;･</span><a href="<?php echo $this->Html->url('/ap/petit/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">1～2歳向け ぷち</span></a><br />
<span style="color:#cc0000;">&nbsp;･</span><a href="<?php echo $this->Html->url('/ap/pocket/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">2～3歳向け ぽけっと</span></a><br />
<span style="color:#cc0000;">&nbsp;･</span><a href="<?php echo $this->Html->url('/ap/hop/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">3～4歳向け ほっぷ</span></a><br />
<span style="color:#cc0000;">&nbsp;･</span><a href="<?php echo $this->Html->url('/ap/step/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">4～5歳向け すてっぷ</span></a><br />
<span style="color:#cc0000;">&nbsp;･</span><a href="<?php echo $this->Html->url('/ap/jump/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">5～6歳向け じゃんぷ</span></a>


<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="center" style="text-align:center;"><a href="http://shimajiromobile.benesse.ne.jp/ap1/mail/?guid=ON"><?php echo $this->Html->image("bnr_melmaga.gif", array("width" => "83%", "border" => "0", "style" => "margin:10px 0 0;")); ?></a></div>
<div align="center" style="text-align:center;"><span style="font-size:x-small;color:#cc0000">※ﾍﾞﾈｯｾのｻｲﾄに移動します｡</span></div>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj02.gif", array()); ?></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_tv.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_tv.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table>
<span style="color:#cc0000;">&nbsp;･</span><a href="http://w.benesse.jp/gw/http/sv/front/Page.php?st=62&pg=3640&SESS=" style="color:#ff3333;"><span style="color:#ff3333;">しまじろうﾍｿｶ</span></a><br />
毎週月曜､朝7:30～8:00放送!<br />
新ｶﾝｶｸ☆ｷｯｽﾞ&nbsp;･ﾊﾞﾗｴﾃｨｰ｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#cc0000;">&nbsp;･</span><a href="http://w.benesse.jp/gw/http/sv/front/Page.php?st=58&pg=3641&SESS=" style="color:#ff3333;"><span style="color:#ff3333;">ｺﾝｻｰﾄ</span></a><br />
&lt;こどもちゃれんじ&gt;ｺﾝｻｰﾄの楽しい情報がいっぱい!<br />
<div style="font-size:x-small;">&nbsp;<span style="font-size:x-small;color:#cc0000">※ﾍﾞﾈｯｾのｻｲﾄに移動します｡</span></div>

<div align="right" style="text-align:right;"><span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE6E0); ?><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></span></div>
<br />
