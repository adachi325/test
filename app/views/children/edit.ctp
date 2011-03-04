<div class="children form">
<?php echo $form->create('Child');?>
	<fieldset>
 		<legend><?php __('Edit Child');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('user_id');
		echo $form->input('line_id');
		echo $form->input('nickname');
		echo $form->input('birth_year');
		echo $form->input('birth_month');
		echo $form->input('sex');
		echo $form->input('benesse_user');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Child.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Child.id'))); ?></li>
		<li><?php echo $html->link(__('List Children', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Lines', true), array('controller' => 'lines', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Line', true), array('controller' => 'lines', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Child Presents', true), array('controller' => 'child_presents', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child Present', true), array('controller' => 'child_presents', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Diaries', true), array('controller' => 'diaries', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Diary', true), array('controller' => 'diaries', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Postcard Urls', true), array('controller' => 'postcard_urls', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Postcard Url', true), array('controller' => 'postcard_urls', 'action' => 'add')); ?> </li>
	</ul>
</div>
