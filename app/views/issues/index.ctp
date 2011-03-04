<div class="issues index">
<h2><?php __('Issues');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('line_id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('release_date');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($issues as $issue):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $issue['Issue']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($issue['Line']['title'], array('controller' => 'lines', 'action' => 'view', $issue['Line']['id'])); ?>
		</td>
		<td>
			<?php echo $issue['Issue']['title']; ?>
		</td>
		<td>
			<?php echo $issue['Issue']['release_date']; ?>
		</td>
		<td>
			<?php echo $issue['Issue']['created']; ?>
		</td>
		<td>
			<?php echo $issue['Issue']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $issue['Issue']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $issue['Issue']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $issue['Issue']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $issue['Issue']['id'])); ?>
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
		<li><?php echo $html->link(__('New Issue', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Lines', true), array('controller' => 'lines', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Line', true), array('controller' => 'lines', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Contents', true), array('controller' => 'contents', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Content', true), array('controller' => 'contents', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Presents', true), array('controller' => 'presents', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Present', true), array('controller' => 'presents', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>
