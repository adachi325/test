
<a name="top" id="top"></a>
<div style="font-size:x-small; color:#333333;">

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

<div align="left" style="text-align:left;"><span style="font-size:medium; color:#cc0000;">こどもちゃれんじぷち</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
  <span style="font-size:medium; color:#cc0000;">ｽﾍﾟｼｬﾙｱﾌﾟﾘ&lt;教材と連動&gt;</span></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<div align="left" style="text-align:left;"><span style="color:#cc0000; font-size:x-small;">【生活習慣ｱﾌﾟﾘ】</span></div>

<div>
<?php
if(count($contents) > 0):
?>

<table width="100%" cellpadding="0" cellspacing="0">

<?php 
$ii = 0;
foreach($contents as $content):
    $color = $ii % 2 == 0 ? " bgcolor='ffefef'" : "";
?>

<?php if ($content['Content']['release_date'] < date('Y-m-d H:i:s')): ?>

<?php 
$url = $content['Content']['path'];
if ((strlen($url) > 4) && (substr($url, 0, 4) == "http")) {
} else {
	$url = $this->Html->url(DS.$url.DS);
}
?>

<tr>
<td<?php echo $color;?>><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
●<span style="color:#333333;"><?php echo h($content['Issue']['title']); ?><!--●○○○○　○ｶ月号--></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php 
if ($ii < 3) {
    echo $this->Html->image("icn_puchi.gif", array("alt" => "", "align" => "top", "style" => "float:left; margin:0 3px 3px 0;")); 
}
?>
<span style="color:#cc0000;"><?php 
echo ($content['Content']['release_date'] > date("Y-m-d H:i:s", strtotime("-7 day"))) ? ' '.$this->Ktai->emoji(0xE6DD, false) : ' &nbsp;･';
?></span><a href="<?php echo $url; ?>" style="color:#ff3333;"><span style="color:#ff3333;"><?php echo h($content['Content']['title']); ?></span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></div></td>
</tr>


<?php
$ii++;
endif; 
?>
<?php endforeach; ?>
<?php endif; ?>

</table>

<!--
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#ffefef"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Html->image("icn_puchi.gif", array("alt" => "", "align" => "top", "style" => "float:left; margin:0 3px 3px 0;")); ?><span style="color:#cc0000;"><?php $this->Ktai->emoji(0xE6DD); ?></span><a href="/dev.sugi.shimajiro/ap/petit/1104_16/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【動画】ﾄｲﾚでおしっこできるかな?</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Html->image("icn_puchi.gif", array("alt" => "", "align" => "top", "style" => "float:left; margin:0 3px 3px 0;")); ?><span style="color:#cc0000;">&nbsp;･</span><a href="/dev.sugi.shimajiro/ap/petit/1104_15/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【動画】みんなでﾄｲﾚ</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></div></td>
</tr>

<tr>
<td bgcolor="#ffefef"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Html->image("icn_puchi.gif", array("alt" => "", "align" => "top", "style" => "float:left; margin:0 3px 3px 0;")); ?><span style="color:#cc0000;">&nbsp;･</span><a href="/dev.sugi.shimajiro/ap/petit/1104_14/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【Flash】ﾄｲﾚでおしっこ</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></div></td>
</tr>

<tr>

<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#cc0000;">&nbsp;･</span><a href="/dev.sugi.shimajiro/ap/petit/1104_12/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【Flash】ﾄﾝﾄﾝﾄｲﾚ</span></a>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>
</tr>


<tr>
<td bgcolor="#ffefef"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104_13/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【Flash】しまじろうとﾄｲﾚに行こう！</span></a>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>
</tr>


<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104_11/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【Flash】いっしょにたべようおさそいﾎﾞｲｽ</span></a>

<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>
</tr>


<tr>
<td bgcolor="#ffefef"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104_10/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【動画】ｽﾌﾟｰﾝでぱっくんかみかみ</span></a>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>

</tr>


<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104_9/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【Flash】しまじろうといっぱいたべよう!</span></a>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>
</tr>


<tr>
<td bgcolor="#ffefef"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104_8/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【Flash】たべものおしゃべりﾊﾟｽﾞﾙであそぼう!</span></a>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>
</tr>


<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104_7/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【Flash】はみがきできた!</span></a>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>
</tr>


<tr>
<td bgcolor="#ffefef"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104_6/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【Flash】はみがきおさそいﾎﾞｲｽ</span></a>

<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>
</tr>


<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104_5/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【Flash】ﾑｼﾊﾞｲｷﾝをやっつけよう!ｹﾞｰﾑ</span></a>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>

</tr>


<tr>
<td bgcolor="#ffefef"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104_4/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【動画】｢ﾑｼﾊﾞｲｷﾝを やっつけよう!｣おはなし</span></a>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>
</tr>


<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104_3/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【着ﾒﾛ】はみがきﾐﾗｰの曲</span></a>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>
</tr>


<tr>
<td bgcolor="#ffefef"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104_2/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【動画】「はみがき だいすき はぶらしｼｭｯﾎﾟ」おはなし</span></a>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>
</tr>


<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104_1/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【WEB】仕上げみがきのﾎﾟｲﾝﾄ</span></a>

<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>
</tr>


<tr>
<td bgcolor="#ffefef"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">●○○○○　○ｶ月号</span><br /><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="/dev.sugi.shimajiro/ap/petit/1104/?csid=gkrq08vp9eodf9sg861dmgspc2" style="color:#ff3333;"><span style="color:#ff3333;">【Flash】しまじろうとはみがきしよう</span></a>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5", "alt" => "")); ?></div></td>

</tr>

</table>
-->

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<a name="check" id="check"></a>
<div style="background:#f3dfc4;">
<?php echo $this->Html->image("petit_magane.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("petit_maganeimg.gif", array("width" => "30%", "align" => "left", "style" => "float:left; margin-right:5px;")); ?>
ご一緒に､こどもの気持ちがわかる｢こどもﾒｶﾞﾈ｣で見てみませんか?<br clear="all" />
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


<!--

<div align="right" style="text-align:right;"><?php $this->Ktai->emoji(0xE691); ?><a href="<?php echo $this->Html->url('/ap/petit/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">もっとみる</span></a></div>
</div>
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif"); ?></div>
<div style="font-size:x-small;">
<span style="color:#cc0000;">&nbsp;･</span><a href="<?php echo 'http://shimajiromobile.benesse.ne.jp/ap1/petit/navi/'; ?>" style="color:#ff3333;"><span style="color:#ff3333;">生活習慣おたすけﾅﾋﾞ</span></a>
</div>
<div style="font-size:x-small;">
<span style="color:#cc0000;">&nbsp;･</span><a href="<?php echo "http://shimajiromobile.benesse.ne.jp/ap1/petit/advice/"; ?>" style="color:#ff3333;"><span style="color:#ff3333;">ﾁｪｯｸ&ｱﾄﾞﾊﾞｲｽ</span></a>
</div>
<div style="font-size:x-small;">
<span style="color:#cc0000;">&nbsp;･</span><a href="<?php echo "http://shimajiromobile.benesse.ne.jp/ap1/petit/reflection/"; ?>" style="color:#ff3333;"><span style="color:#ff3333;">たいけんのきろく</span></a>
</div>
<div style="font-size:x-small;">&nbsp;<span style="font-size:x-small;color:#cc0000">※ﾍﾞﾈｯｾのｻｲﾄに移動します｡</span></div>
<div style="font-size:x-small;">
<span style="color:#cc0000;">&nbsp;･</span><a href="<?php echo 'http://shimajiromobile.benesse.ne.jp/ap1/petit/taiken/'; ?>" style="color:#ff3333;"><span style="color:#ff3333;">体験談のひろば</span></a>
</div>
<div style="font-size:x-small;">&nbsp;<span style="font-size:x-small;color:#cc0000">※ﾍﾞﾈｯｾのｻｲﾄに移動します｡</span></div>

-->
