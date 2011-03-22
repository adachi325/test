<?php 
if (!isset($type_name)) {
	$type_name = '待受FLASH';
}
?>

<div class="presents view">
<h2><?php  __('Present', true);?></h2>

<?php if (count($items)): ?>

<p><?php echo $type_name; ?>テンプレートを選んでください</p>

<ul>
<?php foreach($items as $item): ?>
<li>
<?php
extract($item['Present']);
echo $this->Html->image($present_thumbnail_path, array('alt' => $type_name, 'url' => array('action' => 'select', 'flash', $id))); 
?>
</li>
<?php endforeach; ?>
</ul>

<?php echo $paginator->prev('前へ', array(), null, array('class' => 'disabled')); ?>
<?php echo $paginator->next('次へ', array(), null, array('class' => 'disabled')); ?>

<?php else: ?>
<p><?php echo $type_name; ?>は登録されていません</p>
<?php endif; ?>


</div>
