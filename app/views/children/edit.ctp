
<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

�ȉ��������͂̏㤢�m�F����݂������Ă��������<br />
<?php echo $this->Html->image("dot_line_gray.gif", array("style" => "margin:10px 0; width:100%")); ?><br />

<?php echo $form->create('Child', array('url' => '/children/edit_confirm?guid=ON', 'inputDefaults' => array('div' => false, 'label' => false)));?>
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
���q�ǂ���Ư�Ȱ�<span style="color:#ff0000;">(�K�{)</span><br />
<span style="color:#ff6600;">�S�p6�����ȓ�</span><br />

<?php echo $this->Form->input("nickname", array("type" => "text", "style" => "font-size:x-small;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
���q�ǂ��̐���<span style="color:#ff0000;">(�K�{)</span><br />
<?php
$value1 = ($this->data['Child']['sex'] == 1) ? '1' : 'none';
$value2 = ($this->data['Child']['sex'] == 2) ? '2' : 'none';
?>
<?php echo $this->Form->radio('sex', array('1' => ''), array('legend' => false, 'value' => $value1)); ?>���̎q
<?php echo $this->Form->radio('sex', array('2' => ''), array('legend' => false, 'value' => $value2)); ?>�j�̎q
<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
���q�ǂ��̐��N��<span style="color:#ff0000;">(�K�{)</span><br />
<?php echo $this->Form->input('birth_year', array(
		'options' => $this->SelectOptions->getOption(array(
			'min' => date('Y'), 
			'max' => date('Y') - Configure::read('Child.birthday_years'), 
			'suffix' => '',
			'interval' => -1)),
        'empty' => '------',
		'class' => 'f_bir',
		'style' => 'font-size:x-small;',
	)) ?>�N
<?php echo $this->Form->input('birth_month', array(
		'options' => $this->SelectOptions->getOption(array(
			'min' => 1, 
			'max' => 12, 
			'suffix' => '',)),
        'empty' => '------',
		'class' => 'f_bir',
		'style' => 'font-size:x-small;',
	)) ?>��<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
���q�ǂ��̔N��<span style="color:#ff0000;">(�K�{)</span><br />
�q�ǂ��̔N��ɍ�������������I�т��������<br />
<?php echo $this->Form->input('line_id', array('style' => 'font-size:x-small;')); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
�����L�������p���̏ꍇ�����������Ă��������<br />
<?php echo $this->Form->input("benesse_user", array("type" => "checkbox")); ?>���ǂ�������<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit('�m�F'); ?>
<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>

<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

