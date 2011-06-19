<?php
$image_path;
if ($hanamaru['Diary']['has_image']) {
  $image_path = sprintf(Configure::read('Diary.image_path_rect'), $hanamaru['Diary']['child_id'], $hanamaru['Diary']['id']);
} else {
  $image_path = "omoide_nophoto.gif";
} 
?>

<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo $bgcolor; ?>">
<tr>
<td width="25%" rowspan="2" align="left" valign="top">
<?php echo $this->Html->image($image_path, array("alt" => "子ども画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); ?></td>
<td colspan="2" align="left" valign="top"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br /><span style="font-size:x-small;"><span style="color:#339900;"><?php echo $html->link(h($hanamaru['Diary']['title']), '/diaries/info/' . $hanamaru['Diary']['id'], array('style' => "color:#339900;")); ?></span></a></span></td>
</tr>
<tr>
<td colspan="2" align="left" valign="top"><span style="font-size:x-small; color:#333333;"><?php echo nl2br(h($hanamaru['Diary']['body'])); ?></span></td>
</tr>
<tr>
<td></td>

<td align="left" valign="middle"><?php echo $this->Html->image("icn_hanamaru.gif", array("alt" => "はなまる", "border" => "0", "style" => "margin:1px 3px 0 0;")); ?><span style="font-size:x-small; color:#FF0000;"><?php echo $hanamaru['Diary']['hanamaru_count']; ?>ｺ</span></td>
<td align="right" valign="middle"><span style="font-size:x-small; color:#666666;"><?php echo $this->Time->format('n月j日', $hanamaru['Diary']['modified']); ?></span></td>
</tr></table>
