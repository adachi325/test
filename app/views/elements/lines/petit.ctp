
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
<div align="left" style="text-align:left;"><span style="color:#333333; font-size:x-small;">【生活習慣ｱﾌﾟﾘ】</span></div>

<table width="100%" cellpadding="0" cellspacing="0">

<?php
if(count($contents) > 0):
?>

<table width="100%" cellpadding="0" cellspacing="0">

<?php 
$ii = 0;
$prev = "";
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
<?php 
if ($prev != $content['Issue']['title']): 
    $prev = $content['Issue']['title'];
?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
●<span style="color:#333333;"><?php echo h($content['Issue']['title']); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php endif; ?>
<?php 
if ($ii < 3) {
    $opt = array("width" => "20%", "alt" => "", "align" => "top", "style" => "float:left; margin:0 3px 3px 0;");
    if ((strlen($url) > 4) && (substr($url, 0, 4) == "http")) {
        if ($url == 'http://shimajiromobile.benesse.ne.jp/ap1/petit/reflection/') { echo $this->Html->image('ap/petit/reflection.gif', $opt); }
        if ($url == 'http://shimajiromobile.benesse.ne.jp/ap1/petit/advice/') { echo $this->Html->image('ap/petit/advice.gif', $opt); }
        if ($url == 'http://shimajiromobile.benesse.ne.jp/ap1/petit/taiken/') { echo $this->Html->image('ap/petit/taiken.gif', $opt); }
        if ($url == 'http://shimajiromobile.benesse.ne.jp/ap1/petit/navi/') { echo $this->Html->image('ap/petit/navi.gif', $opt); }
    } else {
        if (file_exists(IMAGES.$content['Content']['path'].'.gif')) {
            echo $this->Html->image($content['Content']['path'].'.gif', $opt); 
        } else {
            //echo $this->Html->image("icn_puchi.gif", $opt); 
        }
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

</table>
<?php endif; ?>

