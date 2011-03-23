<div>
<h1>パスワード再設定実施</h1>
</div>
<?php echo $form->create('User', array('action' => 'remind_password?guid=ON')); ?>
<?php echo $form->input('new_password', array('label' => 'パスワード','type' => 'password')); ?>
<?php echo $form->input('row_password', array('label' => '念の為の再入力','type' => 'password')); ?>
<?php echo $form->submit('実行'); ?>
<?php echo $form->end(); ?>