<div class="diaries index">
	<h2><?php __('Diaries');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('child_id');?></th>
			<th><?php echo $this->Paginator->sort('theme_id');?></th>
			<th><?php echo $this->Paginator->sort('hash');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('body');?></th>
			<th><?php echo $this->Paginator->sort('has_image');?></th>
			<th><?php echo $this->Paginator->sort('error_code');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($diaries as $diary):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $diary['Diary']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($diary['Child']['id'], array('controller' => 'children', 'action' => 'view', $diary['Child']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($diary['Theme']['title'], array('controller' => 'themes', 'action' => 'view', $diary['Theme']['id'])); ?>
		</td>
		<td><?php echo $diary['Diary']['hash']; ?>&nbsp;</td>
		<td><?php echo $diary['Diary']['title']; ?>&nbsp;</td>
		<td><?php echo $diary['Diary']['body']; ?>&nbsp;</td>
		<td><?php echo $diary['Diary']['has_image']; ?>&nbsp;</td>
		<td><?php echo $diary['Diary']['error_code']; ?>&nbsp;</td>
		<td><?php echo $diary['Diary']['created']; ?>&nbsp;</td>
		<td><?php echo $diary['Diary']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $diary['Diary']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $diary['Diary']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $diary['Diary']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $diary['Diary']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Diary', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>