<div class="childPresents form">
<?php echo $form->create('ChildPresent');?>
	<fieldset>
 		<legend><?php __('Edit ChildPresent');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('child_id');
		echo $form->input('present_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('ChildPresent.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('ChildPresent.id'))); ?></li>
		<li><?php echo $html->link(__('List ChildPresents', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Presents', true), array('controller' => 'presents', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Present', true), array('controller' => 'presents', 'action' => 'add')); ?> </li>
	</ul>
</div>