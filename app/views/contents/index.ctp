<div class="contents index">
<h1><?php echo h($title); ?></h1>
<ul>
<?php foreach ($issues as $issue): ?>
	<li>
		<?php echo h($issue['Issue']['title']); ?>
<?php foreach ($issue['Content'] as $content): ?>
	<?php if($content['release_date'] <= date('Y-m-d H:i:s')): ?>
	<p><?php echo $this->Html->link($content['title'], DS.$content['path'].DS); ?></p>
	<?php endif; ?>
<?php endforeach; ?>
	</li>
<?php endforeach; ?>
</ul>
</div>

<?php 
if (!empty($login_user_data) && $login_user_data['User']['dc_user'] == 1):
?>
<?php else: ?>
<p>会員登録すると、他の教材コンテンツやお子様の思い出記録など、楽しい機能が使えるよ☆</p>
<?php echo $this->Html->link('サービスイメージを見る', array('controller' => 'pages', 'action' => 'display')); ?>
<?php endif; ?>

<h3>各コースの部屋</h3>
<div>
<!-- Todo: データベースから出したい -->
<?php echo $this->Html->link('baby/ぷちファースト', '/'); ?>
<?php echo $this->Html->link('ぷち', '/'); ?>
<?php echo $this->Html->link('ぽけっと', '/'); ?>
<?php echo $this->Html->link('ぽっぷ', '/'); ?>
<?php echo $this->Html->link('すてっぷ', '/'); ?>
<?php echo $this->Html->link('じゃんぷ', '/'); ?>
</div>

