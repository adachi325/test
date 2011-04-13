<div>
<?php
if(count($contents) > 0):
echo '<table>';
$ii = 0;
foreach($contents as $content):
?>

<?php if ($content['Content']['release_date'] < date('Y-m-d H:i:s') and $ii < 3): ?>
<tr>
<td width="1" valign="top"><span style="font-size:x-small; color:#cc0000;"><?php echo $content['Issue']['title'] ?></span></td>
</tr>
<tr>
<?php 
$url = $content['path'];
if ((strlen($url) > 4) && (substr($url, 0, 4) == "http")) {
} else {
	$url = $this->Html->url(DS.$url.DS);
}
?>
<td width="229" align="left"><a href="<?php echo $url; ?>" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;"><?php echo h($content['Content']['title']); ?></span></a></td>
</tr>

<?php
$ii++;
endif; ?>
<?php
endforeach;
echo '</table>';
endif;
?>
<div align="right" style="text-align:right;"><?php $this->Ktai->emoji(0xE691); ?><a href="<?php echo $this->Html->url('/ap/baby/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">もっとみる</span></a></div>
</div>
