<?php /* 132 あげたはなまる一覧 */ ?>

<?php echo $this->Html->image("pagetitle_gave_hanamaru.gif", array("alt" => "あげたはなまる一覧", "width" => "100%", "border" => "0")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="center" style="text-align:center;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="font-size:x-small;"><?php echo $paginator->counter(array('format' => "全%count%件　%start%件〜%end%件を表示"));?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?></div>

<?php
// 背景色(シマシマ)の決定
for ($i = 0; $i < count($hanamarus); $i++) {
  $bgcolor = "";
  if ($i % 2 == 0) {
    $bgcolor = "#ffffcc";
  } else {
    $bgcolor = "#ffffff";
  }
?>
<?php echo $this->element('hanamarus/diary', array('hanamaru' => $hanamarus[$i], 'bgcolor' => $bgcolor));?>
<?php } ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" border="0">
<tr>
<td width="50%" align="left"><span style="font-size:x-small; color:#666666;"><?php echo $paginator->prev('前へ', array("style" => "color:#666666"), null, array('class' => 'disabled')); ?></span></td>
<td width="50%" align="right"><span style="font-size:x-small; color:#339900;"><?php echo $paginator->next('次へ', array("style" => "color:#339900"), null, null, array('class' => 'disabled')); ?></span></td>
</tr>
</table>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>
