<div class="lines form">
<?php echo $form->create('Line');?>
	<fieldset>
 		<legend><?php __('Add Line');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Lines', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Contents', true), array('controller' => 'contents', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Content', true), array('controller' => 'contents', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Issues', true), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Issue', true), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
