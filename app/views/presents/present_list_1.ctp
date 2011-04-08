
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

<?php echo $this->Html->image("txt_decome.gif", array("width" => "100%")); ?><br />

<?php if (count($items)): ?>

<span style="font-size:x-small;">端末のﾒﾆｭｰから画像保存してお使いください｡</span><br />
<table width="100%" cellpadding="0" cellspacing="0">

<?php for($i = 0; $i < count($items);  $i++): ?>

<tr>
<td align="center" width="50%" height="30">
<?php echo $this->Html->image($items[$i]['Present']['present_thumbnail_path'], array("width" => "20", "height" => "20", "style" => "margin:5px 0;")); ?>
</td>
<td align="center" width="50%" height="30">
<?php $i++; ?>
<?php if (isset($items[$i])): ?>
<?php echo $this->Html->image($items[$i]['Present']['present_thumbnail_path'], array("width" => "20", "height" => "20", "style" => "margin:5px 0;")); ?>
<?php endif; ?>
</td>
</tr>

<?php endfor; ?>

</table>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left">
<?php echo $paginator->prev('<span style="font-size:x-small; color:#339900;">前へ</span>', array('style' => 'color:#339900;', 'escape' => false), null, array('style' => 'color:#339900;', 'escape' => false)); ?>
</td>
<td align="right">
<?php echo $paginator->next('<span style="font-size:x-small; color:#339900;">次へ</span>', array('style' => 'color:#339900;', 'escape' => false), null, array('style' => 'color:#339900;', 'escape' => false)); ?>
</td>
</tr>
</table>

<?php else: ?>
<p>登録されていません</p>
<?php endif; ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

