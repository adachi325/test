
<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

���e�����m�F�̏㤢�o�^����݂������Ă��������<br />
<?php echo $this->Html->image("dot_line_gray.gif", array("style" => "margin:10px 0; width:100%")); ?><br />

<?php echo $form->create('Child', array('action' => 'register_complete?guid=ON'));?>

<?php extract($this->data['Child']); ?>

<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
���q�ǂ���Ư�Ȱ�<br />
<?php echo $nickname; ?><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
���q�ǂ��̐���<br />
<?php
if($sex == 1) {
    echo '���̎q';
} else {
    echo '�j�̎q';
}
?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
���q�ǂ��̐��N��<br />
<?php echo $birth_year; ?>�N <?php echo $birth_month; ?>��<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
���q�ǂ��̔N��<br />
<?php echo $lines[$line_id]; ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
�����ǂ������񂶂����p��<br />
<?php
if($benesse_user == 1){
    echo '�͂�';
} else {
    echo '������';
} ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit('�o�^'); ?>
<?php echo $this->Form->end(); ?>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->create('Child', array('action' => 'register?guid=ON'));?>
<?php echo $this->Form->end('�߂�');?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>

</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

