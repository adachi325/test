<div>
<?php echo $form->create('Child', array('action' => 'register'));?>

<?php echo $form->input('nickname');?>
<div>
    <span>お子様の性別</span>
</div>
<div>
<?php echo $form->radio('sex', array('1' => '男', '2' => '女'), array('legend' => false)); ?>
<?php echo $form->error('sex','必須項目です。'); ?>
</div>
<div>
	<span>お子様の生年月</span>
	<?php echo $form->input('birth_year', array(
		'label' => '',
		'options' => $selectOptions->getOption(array('min' => 2000, 'max' => 2011, 'suffix' => ' 年',)),
		'empty' => __('------ 年', true),
		'class' => 'f_bir',)) ?>
	<?php echo $form->input('birth_month', array(
		'label' => '',
		'options' => $selectOptions->getOption(array('min' => 1, 'max' => 12, 'suffix' => ' 月',)),
		'empty' => __('------ 月', true),
		'class' => 'f_bir',)) ?>
</div>

<?php echo $form->input('line_id', array($lines,'label' => 'お子様の年齢')) ?>

<?php echo $form->input('benesse_user');?>
<?php echo $form->end('確認画面へ');?>
</div>
<div>
    <?php echo $html->link(__('マイページTOP', true), array('action' => 'index'));?>
</div>
