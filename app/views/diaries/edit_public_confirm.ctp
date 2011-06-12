<?php /* 221 思い出記録 公開・非公開の設定 確認画面 */ ?>

<?php echo $this->Html->image("ttl_memory.gif", array("alt" => "思い出記録", "width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_public_complete?guid=ON", "inputDefaults" => array("div" => false, "label" => false))); ?>
<?php echo $this->Form->hidden('id');?>
<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<span style="font-size:x-small;"><?php echo h($this->data['Diary']['title']); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</td>
</tr>
<tr>
<td align="center">
<span style="font-size:x-small; color:#cc0000;">
<?php
$selection = array("1" => "公開する", "0" => "公開しない");
?>
<?php echo $selection[$this->data['Diary']['wish_public']]; ?>
</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</td>
</tr>
</table>

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("変更", array('div' => false)); ?>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_public?guid=ON", "inputDefaults" => array("div" => false, "label" => false))); ?>
<?php echo $this->Form->submit("戻る", array('div' => false)); ?>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>
</table>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

