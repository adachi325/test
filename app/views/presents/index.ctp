<div class="presents index">
<h2><?php __('Presents');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('issue_id');?></th>
	<th><?php echo $paginator->sort('present_type');?></th>
	<th><?php echo $paginator->sort('present_path');?></th>
	<th><?php echo $paginator->sort('present_thumbnail_path');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
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
		<td>
			<?php echo $present['Present']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($present['Issue']['title'], array('controller' => 'issues', 'action' => 'view', $present['Issue']['id'])); ?>
		</td>
		<td>
			<?php echo $present['Present']['present_type']; ?>
		</td>
		<td>
			<?php echo $present['Present']['present_path']; ?>
		</td>
		<td>
			<?php echo $present['Present']['present_thumbnail_path']; ?>
		</td>
		<td>
			<?php echo $present['Present']['created']; ?>
		</td>
		<td>
			<?php echo $present['Present']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $present['Present']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $present['Present']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $present['Present']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $present['Present']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Present', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Issues', true), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Issue', true), array('controller' => 'issues', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
	</ul>
</div>
