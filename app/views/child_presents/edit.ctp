<div class="childPresents form">
<?php echo $this->Form->create('ChildPresent');?>
	<fieldset>
 		<legend><?php __('Edit Child Present'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('child_id');
		echo $this->Form->input('present_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ChildPresent.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ChildPresent.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Child Presents', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Presents', true), array('controller' => 'presents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Present', true), array('controller' => 'presents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>