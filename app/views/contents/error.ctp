<div class="contents view">

<p>この教材は<?php echo $this->Time->format('m月d日', $release_date); ?>に公開予定です</p>
<br />
<?php 
if (!empty($login_user_data) && $login_user_data['User']['dc_user'] == 1):
?>
<?php echo $this->Html->link('マイページへ', array('controller' => 'children', 'action' => 'index')); ?>
<?php else: ?>
<?php echo $this->Html->link('トップへ', array('controller' => 'pages', 'action' => 'display')); ?>
<?php endif; ?>

</div>
