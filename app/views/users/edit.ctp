<div>
<h1>登録情報変更</h1>
</div>
<?php echo $form->create('User', array('action' => 'edit')); ?>
<?php echo $form->input('new_password', array('label' => 'パスワード','type' => 'password')); ?>
<?php echo $form->input('row_password', array('label' => '念の為の再入力','type' => 'password')); ?>
<?php echo $form->input('dc_user', array('label' => 'ドコモコミュニティ')); ?>
<?php echo $form->submit('確認画面へ'); ?>
<?php echo $form->end(); ?>
