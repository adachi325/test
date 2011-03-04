<div class="postcardUrls form">
<?php echo $form->create('PostcardUrl');?>
	<fieldset>
 		<legend><?php __('Add PostcardUrl');?></legend>
	<?php
		echo $form->input('child_id');
		echo $form->input('token');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List PostcardUrls', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
	</ul>
</div>
