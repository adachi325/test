
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_confirm?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<?php echo $this->Form->hidden('id');?>
<?php echo $this->Form->hidden('has_image');?>

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<?php if ($this->data['Diary']['has_image']) { ?>
<tr>
<td align="center">
<?php
	echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $this->data['Diary']['child_id'], $this->data['Diary']['id']),
		 array("style" => "margin:10px 0;"));
?>
<br />
</td>
</tr>
<?php } ?>
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
<tr>
<td align="left">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#666666;font-size:x-small">※絵文字･ﾃﾞｺﾒ絵文字はご利用できません｡</span><br />
<?php if($ktai->is_ezweb()) { ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#666666;font-size:x-small">※auをご利用の方は､全角512文字しか編集できません｡<br />
それ以上の文字数の場合は､お手数ですが再投稿してください｡</span><br />
<?php } ?>
</td>
</tr>
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>

