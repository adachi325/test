<div class="news form">
<?php echo $form->create('News');?>
	<fieldset>
 		<legend><?php __('Edit News');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('description');
		echo $form->input('start_at');
		echo $form->input('finish_at');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('News.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('News.id'))); ?></li>
		<li><?php echo $html->link(__('List News', true), array('action' => 'index'));?></li>
	</ul>
</div>
