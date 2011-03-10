<div align="center">

<?php 
$user = $this->Session->read('login_user_data.User');
if (!empty($user) && $user['dc_user']):
?>
<?php echo $this->Html->link('マイページへ', array('controller' => 'children', 'action' => 'index')); ?>
<?php else: ?>
<p>会員登録すると、他の教材コンテンツやお子様の思い出記録など、楽しい機能が使えるよ☆</p>
<?php echo $this->Html->link('サービスイメージを見る', array('controller' => 'pages', 'action' => 'display')); ?>
<?php endif; ?>

<hr width="100%" size="1" color="#333333" noshade>
Copyright (C) 2011 All rights reserved.
</div>
