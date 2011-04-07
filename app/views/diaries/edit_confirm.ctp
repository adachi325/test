
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

この内容に変更してよろしいですか｡<br />内容修正の場合は｢戻る｣ﾎﾞﾀﾝを押して前の画面に戻って行ってください｡<br />
<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0")); ?>

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<span style="color:#ff6666;font-size:x-small;">初めてのハイハイ!</span><br />
</td>
</tr>
<tr>
<td align="center">
<?php 
if ($this->data['Diary']['has_image']) {
	echo $this->Html->image(sprintf(Configure::read('Diary.image_path_thumb'), $this->data['Diary']['child_id'], $this->data['Diary']['id']), array("style" => "margin:10px 0;"));
} else {
	echo $this->Html->image("memory_pic.jpg", array("style" => "margin:10px 0;")); 
}
?><br />
</td>
</tr>
<tr>
<td align="left"><span style="font-size:x-small; color:#333333;"><?php echo h($this->data['Diary']['body']); ?></span></td>
</tr>
<tr>
<td align="center">
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_complete?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<?php echo $this->Form->submit("変更"); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<?php echo $this->Form->submit("戻る"); ?>
</td>
</tr>
</table><br />
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

