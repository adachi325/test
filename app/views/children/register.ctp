
<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

以下をご入力の上､｢確認｣ﾎﾞﾀﾝを押してください｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Form->create('Child', array("url" => "/children/register?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どものﾆｯｸﾈｰﾑ</span><span style="color:#ff0000;">(必須)</span><br />
<span style="color:#ff6600;">全角6文字以内</span><br />
<?php echo $this->Form->input("nickname", array("type" => "text", "style" => "font-size:x-small;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの性別</span><span style="color:#ff0000;">(必須)</span><br />
<?php
if (!isset($this->data['Child']['sex'])) {
	$this->data['Child']['sex'] = 0;
}
$value1 = ($this->data['Child']['sex'] == 1) ? '1' : 'none';
$value2 = ($this->data['Child']['sex'] == 2) ? '2' : 'none';
?>
<?php echo $this->Form->radio('sex', array('1' => ''), array('legend' => false, 'value' => $value1)); ?>女の子<br />
<?php echo $this->Form->radio('sex', array('2' => ''), array('legend' => false, 'value' => $value2)); ?>男の子<br />
<div><?php echo $form->error('sex','必須項目です'); ?></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの生年月</span><span style="color:#ff0000;">(必須)</span><br />
<?php echo $this->Form->input('birth_year', array(
		'options' => $this->SelectOptions->getOption(array(
			'min' => date('Y') - Configure::read('Child.birthday_years'), 
			'max' => date('Y'), 
			'reverse' => true,
			'suffix' => '')),
        'empty' => '------',
		'div' => false,
		'label' => false,
        'error' => false,
		'style' => 'font-size:x-small;',
	)) ?> 年 <br />
        <?php echo $form->error('birth_month'); ?>
<?php echo $this->Form->input('birth_month', array(
		'options' => $this->SelectOptions->getOption(array(
			'min' => 1, 
			'max' => 12, 
			'suffix' => '',)),
        'empty' => '------',
		'div' => false,
		'label' => false,
        'error' => false,
		'style' => 'font-size:x-small;',
	)) ?> 月<br />
        <?php echo $form->error('birth_month'); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの年齢</span><span style="color:#ff0000;">(必須)</span><br />
子どもの年齢に合ったｺｰｽをお選びください｡</span><br />
<?php echo $this->Form->input('line_id', array('style' => 'font-size:x-small;')); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■下記の会員の場合はﾁｪｯｸを入れてください｡</span><br />
<?php echo $this->Form->input("benesse_user", array("type" => "checkbox")); ?>こどもちゃれんじ<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit('確認'); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>

</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

