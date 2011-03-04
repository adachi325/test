<div class="childPresents index">
<h2><?php __('ChildPresents');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('child_id');?></th>
	<th><?php echo $paginator->sort('present_id');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($childPresents as $childPresent):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $childPresent['ChildPresent']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($childPresent['Child']['id'], array('controller' => 'children', 'action' => 'view', $childPresent['Child']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($childPresent['Present']['id'], array('controller' => 'presents', 'action' => 'view', $childPresent['Present']['id'])); ?>
		</td>
		<td>
			<?php echo $childPresent['ChildPresent']['created']; ?>
		</td>
		<td>
			<?php echo $childPresent['ChildPresent']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $childPresent['ChildPresent']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $childPresent['ChildPresent']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $childPresent['ChildPresent']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childPresent['ChildPresent']['id'])); ?>
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
		<li><?php echo $html->link(__('New ChildPresent', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Presents', true), array('controller' => 'presents', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Present', true), array('controller' => 'presents', 'action' => 'add')); ?> </li>
	</ul>
</div>
