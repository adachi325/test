
<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

ﾌﾟﾛﾌｨｰﾙを削除するとこれまでに送信した思い出がすべて消去されます｡<br /><br />
<span style="color:#cc0000;">本当にﾌﾟﾛﾌｨｰﾙを削除してよろしいですか｡</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />

<?php echo $this->Form->create('User', array("url" => "/users/delete?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<?php echo $form->hidden('check', array('value'=> 1)); ?>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("ﾌﾟﾛﾌｨｰﾙを削除する"); ?><br />
<?php echo $this->Form->end(); ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->create('User', array("url" => "/children/index?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<?php echo $this->Form->submit("ﾌﾟﾛﾌｨｰﾙを削除しない"); ?><br />
<?php echo $this->Form->end(); ?>
</td>
</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "20")); ?><br />


