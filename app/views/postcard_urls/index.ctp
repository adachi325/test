<div class="postcardUrls index">
<h2><?php __('PostcardUrls');?></h2>
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
	<th><?php echo $paginator->sort('token');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($postcardUrls as $postcardUrl):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $postcardUrl['PostcardUrl']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($postcardUrl['Child']['id'], array('controller' => 'children', 'action' => 'view', $postcardUrl['Child']['id'])); ?>
		</td>
		<td>
			<?php echo $postcardUrl['PostcardUrl']['token']; ?>
		</td>
		<td>
			<?php echo $postcardUrl['PostcardUrl']['created']; ?>
		</td>
		<td>
			<?php echo $postcardUrl['PostcardUrl']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $postcardUrl['PostcardUrl']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $postcardUrl['PostcardUrl']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $postcardUrl['PostcardUrl']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $postcardUrl['PostcardUrl']['id'])); ?>
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
		<li><?php echo $html->link(__('New PostcardUrl', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
	</ul>
</div>
