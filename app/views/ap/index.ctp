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

<?php if (!empty($login_user_data) && $login_user_data['User']['dc_user'] == 1): ?>
<?php else: ?>
<p>会員登録すると、他の教材コンテンツやお子様の思い出記録など、楽しい機能が使えるよ☆</p>
<?php echo $this->Html->link('サービスイメージを見る', array('controller' => 'pages', 'action' => 'display')); ?>
<?php endif; ?>

<h3>各コースの部屋</h3>
<div>

<?php foreach($lines as $line): ?>
<?php echo $this->Html->link($line['Line']['title'], '/ap/'.$line['Line']['category_name'].'/'); ?> |
<?php endforeach; ?>

</div>
