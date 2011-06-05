<?php /* 131 もらったはなまる一覧 */ ?>

<?php echo $this->Html->image("pagetitle_get_hanamaru.gif", array("alt" => "もらったはなまる一覧", "width" => "100%", "border" => "0")); ?><br />
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
<td width="50%" align="left"><span style="font-size:x-small; color:#666666;">
<?php if ($paginator->hasPrev()) : ?>
<a href="<?php echo $this->Html->url('/hanamarus/received/page:' . $page . '?guid=ON&' . session_name() . '=' . session_id()); ?>" style="color:#666666">前へ</a>
<?php else : ?>
前へ
<?php endif; ?>
</span></td>
<td width="50%" align="right"><span style="font-size:x-small; color:#339900;">
<?php if ($paginator->hasNext()) : ?>
<a href="<?php echo $this->Html->url('/hanamarus/received/page:' . $page . '?guid=ON&' . session_name() . '=' . session_id()); ?>" style="color:#339900">次へ</a>
<?php else : ?>
次へ
<?php endif; ?>
</span></td>
</tr>
</table>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>
