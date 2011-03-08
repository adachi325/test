<div>
<h1>入力項目確認</h1>
</div>
<?php echo $form->create('User', array('action' => 'register_confirm')); ?>
<?php echo $form->submit('会員登録実行'); ?>
<?php echo $form->end(); ?>


<?php echo $form->create('User', array('action' => 'register')); ?>
<?php echo $form->submit('入力項目修正'); ?>
<?php echo $form->end(); ?>
