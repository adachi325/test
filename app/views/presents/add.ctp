<div class="presents form">
<?php echo $this->Form->create('Present');?>
	<fieldset>
 		<legend><?php __('Add Present'); ?></legend>
	<?php
		echo $this->Form->input('theme_id');
		echo $this->Form->input('present_type');
		echo $this->Form->input('present_path');
		echo $this->Form->input('present_thumbnail_path');
		echo $this->Form->input('Child');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Presents', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
	</ul>
</div>