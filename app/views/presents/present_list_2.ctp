<?php 
if (!isset($type_name)) {
	$type_name = '待受FLASH';
}
?>

<div class="presents view">
<h2><?php  __('Present');?></h2>

<p><?php echo $type_name; ?>テンプレートを選んでください</p>

<?php echo $this->Form->create('Present', array('action' => 'select')); ?>

<?php echo $this->Form->hidden('type', array('value' => $this->params['pass'][0])); ?>

<ul>
<?php foreach($items as $item): ?>
<li>
<?php extract($item['Present']); ?>
<?php echo $this->Form->radio('select', array($id => $this->Html->image($present_thumbnail_path, array('alt' => $type_name)) ), array('escape' => false)); ?>
</li>
<?php endforeach; ?>
</ul>

<?php if (count($items)): ?>
	<?php echo $paginator->prev('前へ', array(), null, array('class' => 'disabled')); ?>
<?php endif; ?>

<?php echo $this->Form->submit('選ぶ', array('div' => false, 'label' => false)); ?>

<?php if (count($items)): ?>
	<?php echo $paginator->next('次へ', array(), null, array('class' => 'disabled')); ?>
<?php endif; ?>

<?php echo $this->Form->end(); ?>

</div>
