

<a name="top" id="top"></a>
<div style="font-size:x-small; color:#333333;">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="85%"><?php echo $this->Html->image("txt_hop.gif", array("width" => "100%", "alt" => "")); ?></td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="85%"><span style="font-size:x-small; color:#e61953;">3～4歳向けｺｰｽ</span>
</td>
<td width="10%">&nbsp;</td>
</tr>
</table>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<div>
<?php
if(count($contents) > 0):
?>

<table width="100%" cellpadding="0" cellspacing="0">

<?php 
$ii = 0;
foreach($contents as $content):
    $color = ($ii % 2 == 0) ? " bgcolor='#ffefef'" : " bgcolor='#ffffff'";
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
<span style="color:#333333;"><?php echo h($content['Issue']['title']); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php 
if ($ii < 3) {
    if ((strlen($url) > 4) && (substr($url, 0, 4) == "http")) {
        // ベネッセ向け画像に変換
    }
    if (file_exists(IMAGES.$content['Content']['path'].'.gif')) {
        echo $this->Html->image($content['Content']['path'].'.gif', array("width" => "20%", "alt" => "", "align" => "top", "style" => "float:left; margin:0 3px 3px 0;")); 
    } else {
        //echo $this->Html->image("icn_puchi.gif", array("width" => "20%", "alt" => "", "align" => "top", "style" => "float:left; margin:0 3px 3px 0;")); 
    }
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


