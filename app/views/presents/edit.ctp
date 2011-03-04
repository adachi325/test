<div class="presents form">
<?php echo $form->create('Present');?>
	<fieldset>
 		<legend><?php __('Edit Present');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('issue_id');
		echo $form->input('present_type');
		echo $form->input('present_path');
		echo $form->input('present_thumbnail_path');
		echo $form->input('Child');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Present.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Present.id'))); ?></li>
		<li><?php echo $html->link(__('List Presents', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Issues', true), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Issue', true), array('controller' => 'issues', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
	</ul>
</div>
