
<div style="background:#ff6600;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="font-size:small;font-weight:bold; color:#ffffff;">ﾌﾟﾛﾌｨｰﾙ登録</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

以下をご入力の上､｢確認｣ﾎﾞﾀﾝを押してください｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Form->create('User', array("url" => "/users/register?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾛｸﾞｲﾝ名</span><span style="color:#ff0000;">(必須)</span><span style="color:#666666;">※覚えやすい半角英数字でご登録ください｡</span><br />
<span style="color:#ff6600;">半角英数字4-12文字</span><br />
<?php echo $this->Form->input("loginid", array("type" => "text", "style" => "font-size:x-small;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾊﾟｽﾜｰﾄﾞ</span><span style="color:#ff0000;">(必須)</span> <br />
<span style="color:#ff6600;">半角英数字6-12文字</span><br />
<?php echo $this->Form->input("new_password", array("type" => "text", "style" => "font-size:x-small;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾊﾟｽﾜｰﾄﾞ確認</span><span style="color:#ff0000;">(必須)</span><br />
<span style="color:#ff6600;">半角英数字6-12文字</span><br />
<?php echo $this->Form->input("row_password", array("type" => "text", "style" => "font-size:x-small;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どものﾆｯｸﾈｰﾑ</span><span style="color:#ff0000;">(必須)</span><br />
<span style="color:#ff6600;">全角6文字以内</span><br />
<?php echo $this->Form->input("Child.0.nickname", array("type" => "text", "style" => "font-size:x-small;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの性別</span><span style="color:#ff0000;">(必須)</span><br />

<?php
if (!isset($this->data['Child'][0]['sex'])) {
	$this->data['Child'][0]['sex'] = 0;
}
$value1 = ($this->data['Child'][0]['sex'] == 1) ? '1' : 'none';
$value2 = ($this->data['Child'][0]['sex'] == 2) ? '2' : 'none';
?>
<?php echo $this->Form->radio('Child.0.sex', array('1' => ''), array('legend' => false,'value' => $value1)); ?>女の子<br />
<?php echo $this->Form->radio('Child.0.sex', array('2' => ''), array('legend' => false,'value' => $value2)); ?>男の子<br /> 
<?php echo $form->error('Child.0.sex','必須項目です'); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの生年月</span><span style="color:#ff0000;">(必須)</span><br />
<?php echo $this->Form->input('Child.0.birth_year', array(
		'options' => $this->SelectOptions->getOption(array(
			'min' => date('Y') - Configure::read('Child.birthday_years'),
			'max' => date('Y'), 
			'reverse' => true,			
			'suffix' => '')),
        'empty' => '------',
        'error' => false,
		'div' => false,
		'label' => false,
		'style' => 'font-size:x-small;',
	)) ?>年 <br /><?php echo $form->error('Child.0.birth_year'); ?>
<?php echo $this->Form->input('Child.0.birth_month', array(
		'options' => $this->SelectOptions->getOption(array(
			'min' => 1, 
			'max' => 12, 
			'suffix' => '',)),
        'empty' => '------',
        'error' => false,
		'div' => false,
		'label' => false,
		'style' => 'font-size:x-small;',
	)) ?>月<br /><?php echo $form->error('Child.0.birth_month'); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの年齢<span style="color:#ff0000;">(必須)</span><br />
お子さんの年齢に合ったｺｰｽをお選びください｡</span><br />
<?php echo $this->Form->input('Child.0.line_id', array('style' => 'font-size:x-small;')); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■下記の会員の場合は､それぞれﾁｪｯｸを入れてください｡</span><br /><span style="color:#666666">※会員でなくても､このｻｰﾋﾞｽはご利用いただけます｡</span><br />
<?php echo $this->Form->input("Child.0.benesse_user", array("type" => "checkbox")); ?>こどもちゃれんじ<br />
<?php echo $this->Form->input("dc_user", array("type" => "checkbox")); ?>ﾄﾞｺﾓｺﾐｭﾆﾃｨ<br />
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
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

