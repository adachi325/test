<div class="months index">
	<h2><?php __('Months');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('year');?></th>
			<th><?php echo $this->Paginator->sort('month');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($months as $month):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $month['Month']['id']; ?>&nbsp;</td>
		<td><?php echo $month['Month']['year']; ?>&nbsp;</td>
		<td><?php echo $month['Month']['month']; ?>&nbsp;</td>
		<td><?php echo $month['Month']['created']; ?>&nbsp;</td>
		<td><?php echo $month['Month']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $month['Month']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $month['Month']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $month['Month']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $month['Month']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Month', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Presents', true), array('controller' => 'presents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Present', true), array('controller' => 'presents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>