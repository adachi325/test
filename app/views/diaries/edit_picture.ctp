<?php
$id = $diary['Diary']['id'];
?>

<?php echo $this->Html->image("ttl_memory.gif", array("alt" => "思い出記録", "width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="center">
<span style="color:#ff6666;font-size:x-small;"><?php echo h($this->data['Diary']['title']); ?></span><br /></td>
</tr>
<tr>
<td colspan="2" align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php if ($this->data['Diary']['has_image']) : ?>
  <?php echo $this->Html->image($this->data['Diary']['temppath']['image_path_thumb']); ?>
<?php endif; ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?></td>
</tr>
<tr>
<td colspan="2" align="left"><span style="font-size:x-small; color:#333333;"><?php echo nl2br(h($this->data['Diary']['body'])); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br /></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_picture/{$id}/1/?guid=ON", "inputDefaults" => array("div" => false, "label" => false))); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("左に90度"); ?>
<?php echo $this->Form->end(); ?>
</td>
<td align="center">
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_picture/{$id}/-1/?guid=ON", "inputDefaults" => array("div" => false, "label" => false))); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("右に90度"); ?>
<?php echo $this->Form->end(); ?>
</td>
</tr>

<tr>
<td colspan="2" align="center">
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_picture_confirm/{$id}/?guid=ON", "inputDefaults" => array("div" => false, "label" => false))); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("確認"); ?>
<?php echo $this->Form->end(); ?>
</td>
</tr>

</table>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

