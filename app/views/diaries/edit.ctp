
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_confirm?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<?php echo $this->Form->hidden('id');?>
<?php echo $this->Form->hidden('has_image');?>

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<?php if ($this->data['Diary']['has_image']) { 
	echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $this->data['Diary']['child_id'], $this->data['Diary']['id']),
		 array("style" => "margin:10px 0;"));
} else {
	echo $this->Html->image("memory_pic.jpg", array("style" => "margin:10px 0;"));
}
?><br />
</td>
</tr>
<tr>
<td align="left">
<span style="color:#666666;font-size:x-small">※写真の変更はできません｡<br />
写真を変更する場合は､記録を一度削除し､再送信してください｡</span><br />
</td>
</tr>
<tr>
<td align="left"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
ﾀｲﾄﾙ<span style="color:#ff6600;"> 全角20文字以内</span><br />
<?php echo $this->Form->input("title", array("type" => "text", "style" => "font-size:x-small;width:100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="left"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
本文<span style="color:#ff6600;"> 全角5000文字以内</span><br />
<?php echo $this->Form->input("body", array("type" => "texterea", "style" => "font-size:x-small;width:100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("確認"); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>

