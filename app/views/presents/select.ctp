<?php
if (!isset($max_count)) {
	$max_count = 4;
}
?>

<div class="presents view">
<h2><?php  __('Present');?></h2>

<p>投稿写真から<?php echo $max_count; ?>枚選んで、「作成する」ボタンを押してください。</p>

<?php echo $this->Form->create('Present', Set::merge(array('action' => 'select'), $this->params['paging']['Diary']['options'] )); ?>

<?php 
echo $this->Form->hidden('select', array('value' => $data['Present']['select'])); 
echo $this->Form->hidden('page', array('value' => $this->params['paging']['Diary']['options']['page'])); 
?>

<ul>
<?php foreach($items as $item): ?>
<li>
<?php extract($item['Diary']); ?>
<?php
$path = sprintf(Configure::read('Diary.image_path_thumb'), $child_id, $id)
?>
<?php echo $this->Form->radio('select_photo', array($id => $this->Html->image($path, array('alt' => $title)) ), array('escape' => false)); ?>
</li>
<?php endforeach; ?>
</ul>

<?php if (count($items)): ?>
<?php
echo $this->Form->button('前へ', array('name' => 'prev'));
?>
	<?php //echo $paginator->prev('前へ', array(), null, array('class' => 'disabled')); ?>
<?php endif; ?>

<?php echo $this->Form->submit('作成する', array('div' => false, 'label' => false, 'name' => 'create')); ?>

<?php if (count($items)): ?>
<?php
echo $this->Form->button('次へ', array('name' => 'next'));
?>
	<?php //echo $paginator->next('次へ', array(), null, array('class' => 'disabled')); ?>
<?php endif; ?>

<?php echo $this->Form->end(); ?>

</div>
