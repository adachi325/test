<div class="diaries form">
<?php echo $this->Form->create('Diary');?>
	<fieldset>
 		<legend><?php __('Add Diary'); ?></legend>
	<?php
		echo $this->Form->input('child_id');
		echo $this->Form->input('theme_id');
		echo $this->Form->input('hash');
		echo $this->Form->input('title');
		echo $this->Form->input('body');
		echo $this->Form->input('has_image');
		echo $this->Form->input('error_code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Diaries', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>