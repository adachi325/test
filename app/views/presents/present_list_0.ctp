<?php 
if (!isset($type_name)) {
	$type_name = 'デコメ絵文字';
}
?>

<div class="presents view">
<h2><?php  __('Present');?></h2>

<p><?php echo $type_name; ?>をダウンロードして使ってね</p>

<?php foreach($items as $item): ?>
<?php echo $this->Html->image($item['Present']['present_thumbnail_path'], array('alt' => $type_name)); ?>
<?php endforeach; ?>

<?php echo $paginator->prev('前へ', array(), null, array('class' => 'disabled')); ?>
<?php echo $paginator->next('次へ', array(), null, array('class' => 'disabled')); ?>

</div>
