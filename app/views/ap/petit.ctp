<a name="top" id="top"></a>
<div style="font-size:x-small; color:#333333;">

<?php echo $this->Html->image("ttl_challenge.gif", array("alt" => "こどもちゃれんじ", "width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="85%"><?php echo $this->Html->image("txt_petit.gif", array("width" => "100%", "alt" => "")); ?></td>
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
<div align="left" style="text-align:left;"><span style="color:#ff9900;"><?php $this->Ktai->emoji(0xE727); ?></span><a href="<?php echo $this->Html->url('/ap/petit/index/'); ?>" style="color:#ff3333;"><span style="color:#ff3333; font-size:x-small;">詳しく見る</span></a></div>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<a name="check" id="check"></a>
<div style="background:#f3dfc4;">
<?php echo $this->Html->image("petit_magane.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("petit_maganeimg.gif", array("width" => "30%", "align" => "left", "style" => "float:left; margin-right:5px;")); ?>
ご一緒に､お子さんの気持ちがわかる｢こどもめがね｣で見てみませんか?<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></div>
<div align="left" style="text-align:left;"><span style="color:#ff9900;"><?php $this->Ktai->emoji(0xE727); ?></span><a href="http://shimajiromobile.benesse.ne.jp/ap1/petit/advice/" style="color:#ff3333;"><span style="color:#ff3333;">今月の質問をﾁｪｯｸする</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</div>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<a name="diary" id="diary"></a>
<div style="background:#f4b7c8;">
<?php echo $this->Html->image("petit_kiroku.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("petit_kirokuimg.gif", array("width" => "30%", "align" => "left", "style" => "float:left; margin-right:5px;")); ?>
お子さんの成長を記念に残していきませんか?<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></div>
<div align="left" style="text-align:left;"><span style="color:#ff9900;"><?php $this->Ktai->emoji(0xE727); ?></span><a href="http://shimajiromobile.benesse.ne.jp/ap1/petit/reflection/" style="color:#ff3333;"><span style="color:#ff3333;">きろくをみる</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</div>


<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<a name="community" id="community"></a>
<div style="background:#b4cd59;">
<?php echo $this->Html->image("petit_taiken.gif", array("width" => "100%")); ?><br />
子育てのｱｲﾃﾞｨｱやﾜｻﾞを共有できるひろば!<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<div align="left" style="text-align:left;"><span style="color:#ff9900;"><?php $this->Ktai->emoji(0xE727); ?></span><a href="http://shimajiromobile.benesse.ne.jp/ap1/petit/taiken/" style="color:#ff3333;"><span style="color:#ff3333;">みんなの体験談へ</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</div>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<?php $this->element('default/room'); ?>

