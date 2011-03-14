<div class="presents index">
	<h2><?php __('Presents');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('theme_id');?></th>
			<th><?php echo $this->Paginator->sort('present_type');?></th>
			<th><?php echo $this->Paginator->sort('present_path');?></th>
			<th><?php echo $this->Paginator->sort('present_thumbnail_path');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($presents as $present):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $present['Present']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($present['Theme']['title'], array('controller' => 'themes', 'action' => 'view', $present['Theme']['id'])); ?>
		</td>
		<td><?php echo $present['Present']['present_type']; ?>&nbsp;</td>
		<td><?php echo $present['Present']['present_path']; ?>&nbsp;</td>
		<td><?php echo $present['Present']['present_thumbnail_path']; ?>&nbsp;</td>
		<td><?php echo $present['Present']['created']; ?>&nbsp;</td>
		<td><?php echo $present['Present']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $present['Present']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $present['Present']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $present['Present']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $present['Present']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Present', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
	</ul>
</div>