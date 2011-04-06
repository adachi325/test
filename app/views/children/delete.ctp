
<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

子どもの情報を削除してよろしいですか｡<br />
<?php echo $this->Html->image("dot_line_gray.gif", array("style" => "margin:10px 0; width:100%")); ?><br />

<?php echo $this->Form->create('Child', array('url' => '/children/delete?guid=ON', 'inputDefaults' => array('div' => false, 'label' => false))); ?>
<?php echo $form->hidden('check', array('value'=> $this->data['Child']['id'])); ?>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<?php echo $this->Form->submit('削除', array('div' => false, 'label' => false)); ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="#" style="color:#666666;"><span style="color:#666666;">ｷｬﾝｾﾙ</a></span>
</td>
</tr>
</table>

<?php $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

