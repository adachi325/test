
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

この思い出を削除してよろしいですか｡<br />
<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0")); ?>

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<span style="color:#ff6666;font-size:x-small;"><?php echo h($this->data['Diary']['title']); ?></span><br />
</td>
</tr>
<tr>
<td align="center">
<?php if ($this->data['Diary']['has_image']) { 
	echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $this->data['Diary']['child_id'], $this->data['Diary']['id']),
		 array("style" => "margin:10px 0;"));
} else {
	echo $this->Html->image("memory_pic.jpg", array("style" => "margin:10px 0;"));
}
?>
<br />
</td>
</tr>
<tr>
<td align="left"><span style="font-size:x-small; color:#333333;">
<?php echo h($this->data['Diary']['body']); ?></span></td>
</tr>
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
        <?php echo $form->create('Diary', array('url' => '/diaries/delete_complete?guid=ON'));?>
        <?php echo $form->hidden('check', array('value'=> $this->data['Diary']['id'])); ?>
        <?php echo $form->end('削除');?>
<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
        <?php echo $form->create('Diary', array('url' => '/diaries/info/'.$this->data['Diary']['id'].'?guid=ON'));?>
        <?php echo $form->end('取消');?>
<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>
</table><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

