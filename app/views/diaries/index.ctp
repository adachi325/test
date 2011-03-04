<div class="diaries index">
<h2><?php __('Diaries');?></h2>
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
	<th><?php echo $paginator->sort('theme_id');?></th>
	<th><?php echo $paginator->sort('hush_cord');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('image_name');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
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
		<td>
			<?php echo $diary['Diary']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($diary['Child']['id'], array('controller' => 'children', 'action' => 'view', $diary['Child']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($diary['Theme']['title'], array('controller' => 'themes', 'action' => 'view', $diary['Theme']['id'])); ?>
		</td>
		<td>
			<?php echo $diary['Diary']['hush_cord']; ?>
		</td>
		<td>
			<?php echo $diary['Diary']['title']; ?>
		</td>
		<td>
			<?php echo $diary['Diary']['description']; ?>
		</td>
		<td>
			<?php echo $diary['Diary']['image_name']; ?>
		</td>
		<td>
			<?php echo $diary['Diary']['created']; ?>
		</td>
		<td>
			<?php echo $diary['Diary']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $diary['Diary']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $diary['Diary']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $diary['Diary']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $diary['Diary']['id'])); ?>
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
		<li><?php echo $html->link(__('New Diary', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>
