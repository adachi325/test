<div class="contents form">
<?php echo $form->create('Content');?>
	<fieldset>
 		<legend><?php __('Edit Content');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('line_id');
		echo $form->input('issue_id');
		echo $form->input('title');
		echo $form->input('path');
		echo $form->input('description');
		echo $form->input('content_type');
		echo $form->input('release_date');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Content.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Content.id'))); ?></li>
		<li><?php echo $html->link(__('List Contents', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Lines', true), array('controller' => 'lines', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Line', true), array('controller' => 'lines', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Issues', true), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Issue', true), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
