<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_public_complete?guid=ON", "inputDefaults" => array("div" => false, "label" => false))); ?>
<?php echo $this->Form->hidden('id');?>

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<!-- start: タイトル -->
<tr>
<td align="left">
<span style="font-size:x-small">
<?php echo $this->data['Diary']['title']; ?>
</span>
</td>
</tr>
<!-- end: タイトル -->
<!-- start: 公開設定 -->
<tr>
<td align="left">
<span style="font-size:x-small">
<?php
$selection = array("1" => "公開する", "0" => "公開しない");
?>
<?php echo $selection[$this->data['Diary']['wish_public']]; ?>
</span>
</td>
</tr>
<!-- end: 公開設定 -->

<!-- start: 変更ボタン -->
<tr>
<td align="center">
<?php echo $this->Form->submit("変更"); ?>
</td>
</tr>
<!-- end: 変更ボタン -->
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_public?guid=ON", "inputDefaults" => array("div" => false, "label" => false))); ?>
<table width="100%">
<tr>
<td align="center">
<?php echo $this->Form->submit("戻る"); ?>
</td>
</tr>
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>

