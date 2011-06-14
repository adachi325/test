

<a name="top" id="top"></a>
<div style="font-size:x-small; color:#333333;">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="85%"><?php echo $this->Html->image("txt_petit.gif", array("width" => "100%", "alt" => "")); ?></td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="85%"><span style="font-size:x-small; color:#e61953;">5～6歳向けｺｰｽ</span>
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
    $color = ($ii % 2 == 0) ? " bgcolor='ffefef'" : "";
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
<!--
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;"><?php echo h($content['Issue']['title']); ?>●○○○○　○ｶ月号</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
-->
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


