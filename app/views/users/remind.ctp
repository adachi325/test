
<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

以下をご入力の上､｢次へ｣ﾎﾞﾀﾝを押してください｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Form->create('User', array("url" => "/users/remind?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾛｸﾞｲﾝ名</span><br />
<span style="color:#666666;">半角英数字4-12文字</span><br />
<?php echo $this->Form->input("remindId", array("type" => "text", "style" => "font-size:x-small;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どものﾆｯｸﾈｰﾑ</span><br />
<span style="color:#666666;">全角6文字以内</span><br />
<?php echo $this->Form->input("nickname", array("type" => "text", "style" => "font-size:x-small;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの生年月<br />

<?php echo $this->Form->input('birth_year', array(
		'options' => $this->SelectOptions->getOption(array(
			'min' => date('Y') - Configure::read('Child.birthday_years'), 
			'max' => date('Y'), 
			'suffix' => '')),
        'empty' => '------',
		'class' => 'f_bir',
		'style' => 'font-size:x-small;',
	)) ?>年 <br /><?php echo $form->error('birth_year','必須項目です'); ?>
<?php echo $this->Form->input('birth_month', array(
		'options' => $this->SelectOptions->getOption(array(
			'min' => 1, 
			'max' => 12, 
			'suffix' => '',)),
        'empty' => '------',
		'class' => 'f_bir',
		'style' => 'font-size:x-small;',
	)) ?>月<br /><?php echo $form->error('birth_month','必須項目です'); ?>

</span>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("次へ"); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>

</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

