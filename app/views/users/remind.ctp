<div>
<h1>パスワード再設定認証</h1>
</div>
<?php echo $form->create('User', array('action' => 'remind')); ?>
<?php echo $form->input('remindId', array('label' => 'ログインID')); ?>
<?php echo $form->input('nickname', array('label' => 'お子様のニックネーム')); ?>
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
<?php echo $form->submit('確認画面へ'); ?>
<?php echo $form->end(); ?>