
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

この思い出を削除してよろしいですか｡<br />
<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0")); ?>

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<span style="color:#ff6666;font-size:x-small;">初めてのハイハイ!</span><br />
</td>
</tr>
<tr>
<td align="center">
<?php echo $this->Html->image("memory_pic.jpg", array("style" => "margin:10px 0;")); ?><br />
</td>
</tr>
<tr>
<td align="left"><span style="font-size:x-small; color:#333333;">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</span></td>
</tr>
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->create('Diary', array('url' => '/diaries/delete_complete?guid=ON', "inputDefaults" => array("dev" => false, "label" => false))); ?>
<?php echo $form->hidden('check', array('value'=> $this->data['Diary']['id'])); ?>
<?php echo $this->Form->end("削除"); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->create('Diary', array('url' => '/diaries/info/'.$this->data['Diary']['id'].'?guid=ON', "inputDefaults" => array("dev" => false, "label" => false))); ?>
<?php echo $this->Form->end("ｷｬﾝｾﾙ"); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>
</table><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

