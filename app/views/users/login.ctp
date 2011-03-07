<?php
if($session->check('Message.auth')){
	echo $session->flash('auth');
}
?>
<?php echo $form->create('User',array('action'=>'login')); ?>
ログインID<br>
<?php echo $form->text('User.loginid',array('size'=>'10')); ?>
パスワード<br>
<?php echo $form->password('User.password',array('size'=>'10')); ?>
<?php echo $form->end('ログイン'); ?>