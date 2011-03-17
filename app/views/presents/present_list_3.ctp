<?php 
if (!isset($type_name)) {
	$type_name = 'ポストカード';
}
?>

<div class="presents view">
<h2><?php  __('Present');?></h2>

<p><?php echo $type_name; ?>テンプレートを選んでください</p>

<ul>
<?php foreach($items as $item): ?>
<li>
<?php
extract($item['Present']);
echo $this->Html->image($present_thumbnail_path, array('alt' => $type_name, 'url' => array('action' => 'select', 'postcard', $id))); 
?>
</li>
<?php endforeach; ?>
</ul>

<?php if (count($items)): ?>
	<?php echo $paginator->prev('前へ', array(), null, array('class' => 'disabled')); ?>
	<?php echo $paginator->next('次へ', array(), null, array('class' => 'disabled')); ?>
<?php endif; ?>

</div>
