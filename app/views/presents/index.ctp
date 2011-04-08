
<?php
$year = (isset($year)) ? $year : date('Y');
$month = (isset($month)) ? $month : date('n');
$date = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));

$next = date("Y-m-d", strtotime("+1 month", strtotime($date)));
$prev = date("Y/m/d",strtotime("-1 month", strtotime($date)));
?>

<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

<?php echo $this->Html->image("txt_present.gif", array("width" => "100%")); ?><br />
<span style="font-size:x-small;">思い出を記録に残すと､毎月ｽﾃｷなﾌﾟﾚｾﾞﾝﾄがもらえます♪</span><br />

<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left"><span style="font-size:x-small;"><span style="color:#339933;">・</span><?php echo $month; ?>月のﾌﾟﾚｾﾞﾝﾄ一覧</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></td>
</tr>
<tr>
<td width="25%">
<?php echo $this->Html->image($presents[0]['Present']['present_thumbnail_path'], array("width" => "100%")); ?>
</td>
<td width="75%" valign="top" align="left"><span style="font-size:x-small;">1回目の記録でもらえる<br />
<span style="font-size:medium;">【<span style="color:#ff3366;">思い出背景</span>】</span></span></td>
</tr>
</table>
<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="25%">
<?php echo $this->Html->image($presents[1]['Present']['present_thumbnail_path'], array("width" => "100%")); ?>
</td>
<td width="75%" valign="top" align="left"><span style="font-size:x-small;">2回目の記録でもらえる<br />
<span style="font-size:medium;">【<span style="color:#ff3366;">ﾃﾞｺﾒ絵文字</span>】</span></span></td>
</tr>
</table>
<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="25%">
<?php echo $this->Html->image($presents[2]['Present']['present_thumbnail_path'], array("width" => "100%")); ?>
</td>
<td width="75%" valign="top" align="left"><span style="font-size:x-small;">3回目の記録でもらえる<br />
<span style="font-size:medium;">【<span style="color:#ff3366;">待受Flash</span>】</span></span></td>
</tr>
</table>
<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="25%">
<?php echo $this->Html->image($presents[3]['Present']['present_thumbnail_path'], array("width" => "100%")); ?>
</td>
<td width="75%" valign="top" align="left"><span style="font-size:x-small;">4回目の記録でもらえる<br />
<span style="font-size:medium;">【<span style="color:#ff3366;">ﾎﾟｽﾄｶｰﾄﾞ</span>】</span></span></td>
</tr>
</table>
<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<span style="color:#339933;">・</span>他の月のﾌﾟﾚｾﾞﾝﾄを見る<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left">
<?php if (date('Y-m-d', mktime(0, 0, 0, ($beforeFlag['month']['month']-1), 1, $beforeFlag['month']['year'])) != date('Y-m-d', strtotime($prev))) :?>
<a href="<?php echo $this->Html->url('/presents/index/'.date('Y/n', strtotime($prev)).'/'); ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">前月</span></a>
<?php endif; ?>
</td>

<td align="right">
<?php if (date('Y-m-d') > date('Y-m-d', strtotime($next))): ?>
<a href="<?php echo $this->Html->url('/presents/index/'.date('Y/n', strtotime($next)).'/' );?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">次月</span></a>
<?php endif; ?>
</td>

</tr>
</table>
<?php echo $this->Html->image("line_obj01.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<?php echo $this->Html->image("txt_write.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?>
<span style="color:#339933;">・</span><a href="<?php echo $this->Html->url('/themes/index/'); ?>" style="color:#339900;"><span style="color:#339900;"><?php echo $month; ?>月の思い出を書く</span></a><br />

<?php echo $this->Html->image("line_obj01.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<?php echo $this->Html->image("txt_presentlist.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
 
獲得したﾌﾟﾚｾﾞﾝﾄを確認しよう!<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#339933;">・</span><a href="<?php echo $this->Html->url('/presents/present_list/1');?>" style="color:#339900;"><span style="color:#339900;">ﾃﾞｺﾒ絵文字</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#339933;">・</span><a href="<?php echo $this->Html->url('/presents/present_list/2');?>" style="color:#339900;"><span style="color:#339900;">待受Flash</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#339933;">・</span><a href="<?php echo $this->Html->url('/presents/present_list/3');?>" style="color:#339900;"><span style="color:#339900;">ﾎﾟｽﾄｶｰﾄﾞ</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#339933;">・</span><a href="<?php echo $this->Html->url('/presents/present_list/-1');?>" style="color:#339900;"><span style="color:#339900;">入会ﾌﾟﾚｾﾞﾝﾄ</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

