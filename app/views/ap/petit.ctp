<a name="top" id="top"></a>
<div style="font-size:x-small; color:#333333;">
<!-- 背景グリーンタブ -->
<div style="background-color:#339933;">
<div><?php echo $this->Html->image("top_nypage_main.gif", array("alt" => "ケータイしまじろうひろば×ドコモコミュニティ", "width" => "100%", "border" => "0")); ?></div>
<div style="background-color:#ff6699;">
<div style="background-color:#339933;"><a href="<?php echo $this->Html->url('/');?>"><?php echo $this->Html->image("tab_btn01_green.gif", array("alt" => "育児なう", "width" => "33%", "border" => "0")); ?></a><a href="<?php echo $this->Html->url('/diaries/top/')?>"><?php echo $this->Html->image("tab_btn02_green.gif", array("alt" => "思い出記録", "width" => "33%", "border" => "0", "class" => "test")); ?></a><?php echo $this->Html->image("tab_btn03_on_green.gif", array("alt" => "こどもちゃれんじ", " width" => "33%", "border" => "0", "class" => "test")); ?></div> 
<div style="background-color:#ff6699;"><?php echo $this->Html->image("spacer.gif", array("height" => "2", "width" => "1")); ?></div>
<div style="background-color:#ffff99;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffd4d4">
<tr><td align="center"><span style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />
<span style="color:#cc3366">年齢別の&lt;こどもちゃれんじ&gt;<br />ｽﾍﾟｼｬﾙｱﾌﾟﾘや動画が楽しめる!</span><br />
<span style="color:#333333">登録で年齢別に表示されます♪</span></span><br />
<span style="font-size:medium;"><?php $this->Ktai->emoji(0xE6FA); ?><a href="<?php echo $this->Html->url('/navigations/prev/2'); ?>">今すぐ登録!(無料)</a><?php $this->Ktai->emoji(0xE6FA); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</td></tr>
</table>
</div>
</div>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="85%">
<?php echo $this->Html->image("txt_petit.gif", array("width" => "100%", "alt" => "こどもちゃれんじぷち")); ?>
</td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="85%"><span style="font-size:x-small; color:#e61953;">1～2歳向けｺｰｽ</span>
</td>
<td width="10%">&nbsp;</td>
</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<a href="#check" style="color:#ff3333;"><span style="color:#ff3333;">ﾁｪｯｸ&amp;ｱﾄﾞﾊﾞｲｽ</span></a> / <a href="#diary" style="color:#ff3333;"><span style="color:#ff3333;">たいけんのきろく</span></a> / <a href="#community" style="color:#ff3333;"><span style="color:#ff3333;">体験談のひろば</span></a><br />

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>
<div align="center" style="text-align:center;"><?php echo $this->Html->image("40_shimajiro.gif", array("width" => "100%", "alt" => "スペシャルアプリ")); ?></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<div align="left" style="text-align:left;"><span style="color:#ff9900;"><?php $this->Ktai->emoji(0xE691); ?></span><a href="<?php echo $this->Html->url('/ap/petit/index/'); ?>" style="color:#ff3333;"><span style="color:#ff3333; font-size:x-small;">詳しく見る</span></a></div>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<a name="check" id="check"></a>
<div style="background:#f3dfc4;">
<?php echo $this->Html->image("petit_magane.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("petit_maganeimg.gif", array("width" => "30%", "align" => "left", "style" => "float:left; margin-right:5px;")); ?>
ご一緒に､お子さんの気持ちがわかる｢こどもめがね｣で見てみませんか?<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></div>
<div align="left" style="text-align:left;"><span style="color:#ff9900;"><?php $this->Ktai->emoji(0xE691); ?></span><a href="http://shimajiromobile.benesse.ne.jp/ap1/petit/advice/" style="color:#ff3333;"><span style="color:#ff3333;">今月の質問をﾁｪｯｸする</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</div>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<a name="diary" id="diary"></a>
<div style="background:#f4b7c8;">
<?php echo $this->Html->image("petit_kiroku.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("petit_kirokuimg.gif", array("width" => "30%", "align" => "left", "style" => "float:left; margin-right:5px;")); ?>
お子さんの成長を記念に残していきませんか?<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></div>
<div align="left" style="text-align:left;"><span style="color:#ff9900;"><?php $this->Ktai->emoji(0xE691); ?></span><a href="http://shimajiromobile.benesse.ne.jp/ap1/petit/reflection/" style="color:#ff3333;"><span style="color:#ff3333;">記録をみる</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</div>


<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<a name="community" id="community"></a>
<div style="background:#b4cd59;">
<?php echo $this->Html->image("petit_taiken.gif", array("width" => "100%")); ?><br />
子育てのｱｲﾃﾞｨｱやﾜｻﾞを共有できるひろば!<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<div align="left" style="text-align:left;"><span style="color:#ff9900;"><?php $this->Ktai->emoji(0xE691); ?></span><a href="http://shimajiromobile.benesse.ne.jp/ap1/petit/taiken/" style="color:#ff3333;"><span style="color:#ff3333;">みんなの体験談へ</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</div>


<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "20")); ?><br />
<?php echo $this->Html->image("ttl_fun.gif", array("alt" => "このサイトの楽しみ方", "width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%" align="left"><?php echo $this->Html->image("icn_oyako.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_ikujinau.gif", array("alt" => "育児なう", "width" => "100%")); ?></td>
</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Html->image("60pic_ikujinau.gif", array("width" => "25%", "align" => "left", "style" => "float:left; margin-right:5px;")); ?>
子どもに関するﾆｭｰｽや日替わり占い､他のお友達の思い出などが見られる!<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?></div>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_orrange.gif", array()); ?></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_mobile.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_challenge.gif", array("alt" => "こどもちゃれんじ", "width" => "100%")); ?></td>
</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Html->image("60pic_kodomo101.gif", array("width" => "25%", "align" => "left", "style" => "float:left; margin-right:5px;")); ?>
&lt;こどもちゃれんじ&gt;教材と連動した年齢別ｺﾝﾃﾝﾂが楽しめる!<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?></div>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_orrange.gif", array()); ?></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_album.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_memory.gif", array("alt" => "思い出記録", "width" => "100%")); ?></td>
</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Html->image("60pic_omoide101.gif", array("width" => "25%", "align" => "left", "style" => "float:left; margin-right:5px;")); ?>お子さんの成長がかわいく残せる!写真がたまるとﾎﾟｽﾄｶｰﾄﾞに♪<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?></div>

<div align="center" style="text-align:center;"><a href="<?php echo $this->Html->url('/navigations/prev/1');?>"><span style="color:#ff6600;">更に詳しく見る</span></a><span style="color:#cc0000;"><?php $this->Ktai->emoji(0xE6F5); ?></span></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffff99">
<tr><td align="center"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="font-size:x-small">ｹﾞｰﾑや動画で遊んで<br />素敵に写真が残せる<?php $this->Ktai->emoji(0xE741); ?></span><br />
<span style="font-size:medium;"><?php $this->Ktai->emoji(0xE6FA); ?><a href="<?php echo $this->Html->url('/navigations/prev/2'); ?>">今すぐ登録!(無料)</a><?php $this->Ktai->emoji(0xE6FA); ?></span><br />
<span style="font-size:x-small"><?php $this->Ktai->emoji(0xE688); ?>3ｷｬﾘｱ対応<?php $this->Ktai->emoji(0xE694); ?></span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></td></tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />


<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_mobile.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_course.gif", array("alt" => "各コースの教材", "width" => "100%")); ?></td>
</tr>
</table>

<?php echo $this->element('default/room'); ?>



<!-- ページトップへ -->
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="right" style="text-align:right;"><span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE6E0); ?><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></span></div>
<br />

