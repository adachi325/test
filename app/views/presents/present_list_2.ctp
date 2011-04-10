
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<?php echo $this->Html->image("txt_flash.gif", array("width" => "100%")); ?><br />

<?php if (count($items)): ?>

お子さんの写真とお好きなﾃﾝﾌﾟﾚｰﾄを選んで､ｵﾘｼﾞﾅﾙの待受Flashをつくろう!<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />

お好きなﾃﾝﾌﾟﾚｰﾄを選んでください｡<br />
<table cellpadding="0" cellspacing="0" width="100%">

<?php for($i = 0; $i < count($items);  $i++): ?>

<tr>
<td align="center" width="50%">
<?php
extract($items[$i]['Present']);
echo $this->Html->image($present_thumbnail_path, array("width" => "90", "height" => "120", "style" => "margin:5px 0;", "url" => "/presents/select/flash/{$id}/"));
?>
</td>

<td align="center" width="50%">
<?php $i++; ?>
<?php if (isset($items[$i])): ?>
<?php
extract($items[$i]['Present']);
echo $this->Html->image($present_thumbnail_path, array("width" => "90", "height" => "120", "style" => "margin:5px 0;", "url" => "/presents/select/flash/{$id}/"));
?>
<?php endif; ?>
</td>
</tr>

<?php endfor; ?>

</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left">
<?php if ($this->Paginator->hasPrev()): ?>
<?php echo $paginator->prev('<span style="font-size:x-small; color:#339900;">前へ</span>', array('style' => 'color:#339900;', 'escape' => false), null, array('style' => 'color:#339900;', 'escape' => false)); ?>
<?php endif; ?>
</td>
<td align="right">
<?php if ($this->Paginator->hasNext()): ?>
<?php echo $paginator->next('<span style="font-size:x-small; color:#339900;">次へ</span>', array('style' => 'color:#339900;', 'escape' => false), null, array('style' => 'color:#339900;', 'escape' => false)); ?>
<?php endif; ?>
</td>
</tr>
</table>

<?php else: ?>
<p>登録されていません</p>
<?php endif; ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

