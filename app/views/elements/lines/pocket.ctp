
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
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
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


<a name="check" id="check"></a>
<div style="background:#fcf8e4;">
<?php echo $this->Html->image('pocket_sansai.gif', array('width'=>'100%')); ?><br />
お子さんに合ったｵﾑﾂはずれのｱﾄﾞﾊﾞｲｽ<br clear="all" />

<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></div>
<div align="center" style="text-align:center;"><a href="http://shimajiromobile.benesse.ne.jp/ap1/petit/advice/" style="color:#ff3333;"><span style="color:#ff3333;">今月の質問をﾁｪｯｸする</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</div>

<div align="center" style="text-align:center"><?php echo $this->Html->image('dot_line_pink.gif'); ?></div>

<a name="community" id="community"></a>
<div style="background:#b4cd59;">
<?php echo $this->Html->image('pocket_taiken.gif', array('width'=>'100%')); ?><br />
一緒にいろんなｱｲﾃﾞｨｱを共有するひろば!<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<div align="center" style="text-align:center;"><a href="http://shimajiromobile.benesse.ne.jp/ap1/petit/taiken/" style="color:#ff3333;"><span style="color:#ff3333;">みんなの体験談へ</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</div>

<div align="center" style="text-align:center"><?php echo $this->Html->image('dot_line_pink.gif'); ?></div>

