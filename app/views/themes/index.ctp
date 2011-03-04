<div class="themes index">
<h2><?php __('Themes');?></h2>
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
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('release_week');?></th>
	<th><?php echo $paginator->sort('release_date');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($themes as $theme):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $theme['Theme']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($theme['Issue']['title'], array('controller' => 'issues', 'action' => 'view', $theme['Issue']['id'])); ?>
		</td>
		<td>
			<?php echo $theme['Theme']['title']; ?>
		</td>
		<td>
			<?php echo $theme['Theme']['description']; ?>
		</td>
		<td>
			<?php echo $theme['Theme']['release_week']; ?>
		</td>
		<td>
			<?php echo $theme['Theme']['release_date']; ?>
		</td>
		<td>
			<?php echo $theme['Theme']['created']; ?>
		</td>
		<td>
			<?php echo $theme['Theme']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $theme['Theme']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $theme['Theme']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $theme['Theme']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $theme['Theme']['id'])); ?>
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
		<li><?php echo $html->link(__('New Theme', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Issues', true), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Issue', true), array('controller' => 'issues', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Diaries', true), array('controller' => 'diaries', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Diary', true), array('controller' => 'diaries', 'action' => 'add')); ?> </li>
	</ul>
</div>
