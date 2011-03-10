<div>
<h1>新会員登録</h1>
</div>
<?php echo $form->create('User', array('action' => 'register')); ?>
<?php echo $form->input('loginid', array('label' => 'ログインID')); ?>
<?php echo $form->input('new_password', array('label' => 'パスワード','type' => 'password')); ?>
<?php echo $form->input('row_password', array('label' => '念の為の再入力','type' => 'password')); ?>
<?php echo $form->input('Child.0.nickname', array('label' => 'お子様のニックネーム')); ?>
<div>
    <span>お子様の性別</span>
</div>
<div>
<?php echo $form->radio('Child.0.sex', array('1' => '男', '2' => '女'), array('legend' => false)); ?>
<?php echo $form->error('Child.0.sex','必須項目です。'); ?>
</div>
<div>
<span>お子様の生年月</span>
<?php echo $form->input('Child.0.birth_year', array(
        'label' => '',
        'options' => $selectOptions->getOption(array('min' => 2000, 'max' => 2011, 'suffix' => ' 年',)),
        'empty' => __('------ 年', true),
        'class' => 'f_bir',)) ?>
<?php echo $form->input('Child.0.birth_month', array(
        'label' => '',
        'options' => $selectOptions->getOption(array('min' => 1, 'max' => 12, 'suffix' => ' 月',)),
        'empty' => __('------ 月', true),
        'class' => 'f_bir',)) ?>
<span>お子様の年齢</span><br>
<?php
    echo $form->select('Child.0.line_id', array($lines));
    echo $form->error('Child.0.line_id');
?>
</div>
<div>
<?php echo $form->checkbox('Child.0.benesse_user'); ?>こどもちゃれんじ
</div>
<?php echo $form->input('dc_user', array('label' => 'ドコモコミュニティ')); ?>
<?php echo $form->submit('確認画面へ'); ?>
<?php echo $form->end(); ?>
