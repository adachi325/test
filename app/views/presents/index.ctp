
<?php
$year = (isset($year)) ? $year : date('Y');
$month = (isset($month)) ? $month : date('n');
$date = date("Y/m/d", mktime(0, 0, 0, $month, 1, $year));

$next = date("Y/m/d", strtotime("+1 month", strtotime($date)));
$prev = date("Y/m/d", strtotime("-1 month", strtotime($date)));

$sampleMonth = (mb_strlen($month)==1) ? '0'.$month : $month ;
?>

<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_present.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_present.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table>

<span style="font-size:x-small;">思い出を記録に残すと､毎月ｽﾃｷなﾌﾟﾚｾﾞﾝﾄがもらえます♪</span><br />

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<table width="100%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left"><span style="font-size:x-small;"><span style="color:#339933;">・</span><?php echo $month; ?>月のﾌﾟﾚｾﾞﾝﾄ一覧</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></td>
</tr>
<tr>
<td width="25%">
<?php
echo $this->Html->image(sprintf(Configure::read('Present.sample.0'), $year, $sampleMonth), array("width" => "100%"));
?>
</td>
<td width="75%" valign="top" align="left"><span style="font-size:x-small;">1回目の記録でもらえる<br />
<span style="font-size:medium;">【<span style="color:#ff3366;">思い出背景</span>】</span></span></td>
</tr>
</table>
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<table width="100%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="25%">
<?php
echo $this->Html->image(sprintf(Configure::read('Present.sample.1'), $year, $sampleMonth), array("width" => "100%"));
?>
</td>
<td width="75%" valign="top" align="left"><span style="font-size:x-small;">2回目の記録でもらえる<br />
<span style="font-size:medium;">【<span style="color:#ff3366;">ﾃﾞｺﾒ絵文字</span>】</span></span></td>
</tr>
</table>
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<table width="100%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="25%">
<?php
echo $this->Html->image(sprintf(Configure::read('Present.sample.2'), $year, $sampleMonth), array("width" => "100%"));
?>
</td>
<td width="75%" valign="top" align="left"><span style="font-size:x-small;">3回目の記録でもらえる<br />
<span style="font-size:medium;">【<span style="color:#ff3366;">待受Flash</span>】</span></span></td>
</tr>
</table>
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<table width="100%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="25%">
<?php
echo $this->Html->image(sprintf(Configure::read('Present.sample.3'), $year, $sampleMonth), array("width" => "100%"));
?>
</td>
<td width="75%" valign="top" align="left"><span style="font-size:x-small;">4回目の記録でもらえる<br />
<span style="font-size:medium;">【<span style="color:#ff3366;">ﾎﾟｽﾄｶｰﾄﾞ</span>】</span></span></td>
</tr>
</table>
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<span style="color:#339933;">・</span>他の月のﾌﾟﾚｾﾞﾝﾄを見る<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left">
<?php if (date('Y-m-d', mktime(0, 0, 0, ($beforeFlag['month']['month'] - 1), 1, $beforeFlag['month']['year'])) != date('Y-m-d', strtotime($prev))) :?>
<a href="<?php echo $this->Html->url('/presents/index/'.date('Y/n', strtotime($prev)).'/'); ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">前月</span></a>
<?php endif; ?>
</td>

<td align="right">
<?php if (date('Y-m-d') > date('Y-m-d', strtotime($next))): ?>
<a href="<?php echo $this->Html->url('/presents/index/'.date('Y/n', strtotime($next)).'/'); ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">次月</span></a>
<?php endif; ?>
</td>

</tr>
</table>
<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj01.gif"); ?></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_write.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_write.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table>
<span style="color:#339933;">・</span><a href="<?php echo $this->Html->url('/themes/index/diary/'.$year.'/'.$month.'/'); ?>" style="color:#339900;"><span style="color:#339900;"><?php echo $month; ?>月の思い出を書く</span></a><br />

<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj01.gif"); ?></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_present.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_presentlist.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table><a name="presents" id="presents"></a>
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

