<?php 
if (!isset($type_name)) {
	$type_name = '会員限定コンテンツ';
}
?>

<div class="presents view">
<h2><?php  __('Present');?></h2>

<?php if (count($items)): ?>

<p>会員登録ありがとう♪</p>
<p><?php echo $type_name; ?>をダウンロードして使ってね</p>

<ul>
<?php foreach($items as $item): ?>
<li>
<?php echo $this->Html->image($item['thumbnail_path'], array('alt' => $type_name)); ?>&nbsp;
<?php echo $this->Html->link($item['title'], $item['url']); ?>
</li>

<?php endforeach; ?>
</ul>


<?php else: ?>
<p><?php echo $type_name; ?>は登録されていません</p>
<?php endif; ?>

</div>
