<div class="diaries form">
<?php echo $form->create('Diary');?>
	<fieldset>
 		<legend><?php __('Add Diary');?></legend>
	<?php
		echo $form->input('child_id');
		echo $form->input('theme_id');
		echo $form->input('hush_cord');
		echo $form->input('title');
		echo $form->input('description');
		echo $form->input('image_name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Diaries', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>
