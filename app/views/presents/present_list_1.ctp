
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_present.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_decome.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table>
<?php if (count($items)): ?>

<span style="font-size:x-small;">端末のﾒﾆｭｰから画像保存してお使いください｡</span><br />
<table width="100%" cellpadding="0" cellspacing="0">

<?php for($i = 0; $i < count($items);  $i++): ?>

<tr>
<td align="center" width="50%" height="30">
<?php echo $this->Html->image($items[$i]['Present']['present_path'], array("style" => "margin:5px 0;")); ?>
</td>
<td align="center" width="50%" height="30">
<?php $i++; ?>
<?php if (isset($items[$i])): ?>
<?php echo $this->Html->image($items[$i]['Present']['present_path'], array("style" => "margin:5px 0;")); ?>
<?php endif; ?>
</td>
</tr>

<?php endfor; ?>

</table>

<br /><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left">
<?php if ($this->Paginator->hasPrev()): ?>
<?php echo $this->Paginator->prev('<span style="font-size:x-small; color:#339900;">前へ</span>', array('style' => 'color:#339900;', 'escape' => false)); ?>
<?php endif; ?>
</td>
<td align="right">
<?php if ($this->Paginator->hasNext()): ?>
<?php echo $this->Paginator->next('<span style="font-size:x-small; color:#339900;">次へ</span>', array('style' => 'color:#339900;', 'escape' => false)); ?>
<?php endif; ?>
</td>
</tr>
</table>

<?php else: ?>
<p>登録されていません</p>
<?php endif; ?>

<br /><br />

