<div class="themes form">
<?php echo $this->Form->create('Theme');?>
	<fieldset>
 		<legend><?php __('Add Theme'); ?></legend>
	<?php
		echo $this->Form->input('month_id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('release_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Themes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Months', true), array('controller' => 'months', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Month', true), array('controller' => 'months', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Diaries', true), array('controller' => 'diaries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Diary', true), array('controller' => 'diaries', 'action' => 'add')); ?> </li>
	</ul>
</div>