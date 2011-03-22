<?php 
if (!isset($type_name)) {
	$type_name = 'デコメ絵文字';
}
?>

<div class="presents view">
<h2><?php  __('Present');?></h2>


<?php if (count($items)): ?>
<p><?php echo $type_name; ?>をダウンロードして使ってね</p>

<ul>
<?php foreach($items as $item): ?>
<li><?php echo $this->Html->image($item['Present']['present_thumbnail_path'], array('alt' => $type_name)); ?></li>
<?php endforeach; ?>
</ul>

<?php if (count($items)): ?>
<?php echo $paginator->prev('前へ', array(), null, array('class' => 'disabled')); ?>
<?php echo $paginator->next('次へ', array(), null, array('class' => 'disabled')); ?>
<?php endif; ?>

<?php else: ?>
<p><?php echo $type_name; ?>は登録されていません</p>
<?php endif; ?>

</div>
