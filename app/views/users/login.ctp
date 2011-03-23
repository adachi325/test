<?php
if($session->check('Message.auth')){
	echo $session->flash('auth');
}
?>
<?php echo $form->create('User',array('action'=>'login?guid=ON')); ?>
ログインID<br>
<?php echo $form->text('User.loginid',array('size'=>'10')); ?>
パスワード<br>
<?php echo $form->password('User.password',array('size'=>'10')); ?>
<?php echo $form->end('ログイン'); ?>
<br><hr><br>
<div>
    ※パスワードを忘れた方<?php echo $html->link('こちら', "/users/remind/",array('escape' => false));?>
</div>
<div>
    ⇒<?php echo $html->link('新規会員登録', "/users/register/",array('escape' => false));?>
</div>