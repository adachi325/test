<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

���e�����m�F�̏㤢�o�^����݂������Ă��������<br />
<?php echo $this->Html->image("dot_line_gray.gif", array("style" => "margin:10px 0; width:100%")); ?><br />

<?php echo $this->Form->create('Child', array('inputDefaults' => array('url' => '/children/edit_complete?guid=ON', 'div' => false, 'label' => false))); ?>

<?php extract($this->data['Child']); ?>

<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
���q�ǂ���Ư�Ȱ�<br />
<?php echo h($nickname); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
���q�ǂ��̐���<br />
<?php
$sex_label = '';
if($sex == 1) {
    $sex_label = '��';
} else {
    $sex_label = '�j';
}
echo "{$sex_label}�̎q";
?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
���q�ǂ��̐��N��<br />
<?php echo "$birth_year�N $birth_month��"; ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
���q�ǂ��̔N��<br />
<?php echo $lines[$line_id]; ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
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
}
?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $form->end('�ύX');?>
<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $form->create('Child', array('url' => '/children/edit?guid=ON'));?>
<?php echo $form->end('�߂�');?>
<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>

</table>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

