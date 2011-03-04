<div class="themes form">
<?php echo $form->create('Theme');?>
	<fieldset>
 		<legend><?php __('Edit Theme');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('issue_id');
		echo $form->input('title');
		echo $form->input('description');
		echo $form->input('release_week');
		echo $form->input('release_date');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Theme.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Theme.id'))); ?></li>
		<li><?php echo $html->link(__('List Themes', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Issues', true), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Issue', true), array('controller' => 'issues', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Diaries', true), array('controller' => 'diaries', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Diary', true), array('controller' => 'diaries', 'action' => 'add')); ?> </li>
	</ul>
</div>
