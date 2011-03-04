<div class="contents index">
<h2><?php __('Contents');?></h2>
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
	<th><?php echo $paginator->sort('issue_id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('path');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('content_type');?></th>
	<th><?php echo $paginator->sort('release_date');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($contents as $content):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $content['Content']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($content['Line']['title'], array('controller' => 'lines', 'action' => 'view', $content['Line']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($content['Issue']['title'], array('controller' => 'issues', 'action' => 'view', $content['Issue']['id'])); ?>
		</td>
		<td>
			<?php echo $content['Content']['title']; ?>
		</td>
		<td>
			<?php echo $content['Content']['path']; ?>
		</td>
		<td>
			<?php echo $content['Content']['description']; ?>
		</td>
		<td>
			<?php echo $content['Content']['content_type']; ?>
		</td>
		<td>
			<?php echo $content['Content']['release_date']; ?>
		</td>
		<td>
			<?php echo $content['Content']['created']; ?>
		</td>
		<td>
			<?php echo $content['Content']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $content['Content']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $content['Content']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $content['Content']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $content['Content']['id'])); ?>
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
		<li><?php echo $html->link(__('New Content', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Lines', true), array('controller' => 'lines', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Line', true), array('controller' => 'lines', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Issues', true), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Issue', true), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
