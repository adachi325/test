
<?php if(count($contents) > 0): ?>

<?php 
$ii = 0;
foreach($contents as $content):
?>

<?php if ($content['Content']['release_date'] < date('Y-m-d H:i:s')): ?>

<div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<?php 
$url = $content['Content']['path'];
if ((strlen($url) > 4) && (substr($url, 0, 4) == "http")) {
} else {
	$url = $this->Html->url(DS.$url.DS);
}
?>

<span style="color:#cc0000;"><?php
echo ($content['Content']['release_date'] > date("Y-m-d H:i:s", strtotime("-7 day"))) ? $this->Ktai->emoji(0xE6DD, false) : '&nbsp;･' ; 
?></span><a href="<?php echo $url; ?>" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;"><?php echo h($content['Content']['title']); ?></span></a><br />
</div>

<?php 
$ii++; 
if ($ii > 3) {
	break;
}
?>
<?php endif; ?>
<?php endforeach; ?>

<?php endif; ?>

<div align="right" style="text-align:right;"><?php $this->Ktai->emoji(0xE691); ?><a href="<?php echo $this->Html->url('/ap/pocket/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">もっとみる</span></a><br /></div>

<div align="center" style="text-align:center"><?php echo $this->Html->image('dot_line_pink.gif'); ?></div>

<div style="font-size:x-small;">
<span style="color:#cc0000;">&nbsp;･</span><a href="<?php echo "http://shimajiromobile.benesse.ne.jp/ap1/pocket/advice/"; ?>" style="color:#ff3333;"><span style="color:#ff3333;">ﾁｪｯｸ&ｱﾄﾞﾊﾞｲｽ</span></a>
</div>
<div style="font-size:x-small;">
<span style="color:#cc0000;">&nbsp;･</span><a href="<?php echo 'http://shimajiromobile.benesse.ne.jp/ap1/pocket/taiken/'; ?>" style="color:#ff3333;"><span style="color:#ff3333;">体験談のひろば</span></a>
</div>
<div style="font-size:x-small;">&nbsp;<span style="font-size:x-small;color:#cc0000">※ﾍﾞﾈｯｾのｻｲﾄに移動します｡</span></div>

