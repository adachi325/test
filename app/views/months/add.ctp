<div class="months form">
<?php echo $this->Form->create('Month');?>
	<fieldset>
 		<legend><?php __('Add Month'); ?></legend>
	<?php
		echo $this->Form->input('year');
		echo $this->Form->input('month');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Months', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Presents', true), array('controller' => 'presents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Present', true), array('controller' => 'presents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>