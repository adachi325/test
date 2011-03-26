
<div>
<ul>
<?php foreach($issues as $issue): ?>
<li>
<?php
	echo h($issue['Issue']['title']);
	if(is_array($issue['Content'])) {
		foreach($issue['Content'] as $content) {
			if ($content['release_date'] < date('Y-m-d')) {
				echo "<p>";
				echo $this->Html->link($content['title'], DS.$content['path'].DS);
				echo "</p>";
			}
		}
	}
?>
</li>
<?php endforeach; ?>
</ul>
<?php echo $this->Html->link('もっと見る', 'http://shimajiromobile.benesse.ne.jp/ap1/'); ?>
</div>

<div>

<p>
<?php echo $this->Html->link('text', ''); ?><br />
text
</p>

<p>
<?php echo $this->Html->link('text', ''); ?><br />
text
</p>

<p>
<?php echo $this->Html->link('text', ''); ?><br />
text
</p>

</div>

