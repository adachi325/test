<div class="presents view">
<h2><?php  __('Present');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $present['Present']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Issue'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($present['Issue']['title'], array('controller' => 'issues', 'action' => 'view', $present['Issue']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Present Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $present['Present']['present_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Present Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $present['Present']['present_path']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Present Thumbnail Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $present['Present']['present_thumbnail_path']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $present['Present']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $present['Present']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Present', true), array('action' => 'edit', $present['Present']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Present', true), array('action' => 'delete', $present['Present']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $present['Present']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Presents', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Present', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Issues', true), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Issue', true), array('controller' => 'issues', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Children');?></h3>
	<?php if (!empty($present['Child'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Line Id'); ?></th>
		<th><?php __('Nickname'); ?></th>
		<th><?php __('Birth Year'); ?></th>
		<th><?php __('Birth Month'); ?></th>
		<th><?php __('Sex'); ?></th>
		<th><?php __('Benesse User'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($present['Child'] as $child):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $child['id'];?></td>
			<td><?php echo $child['user_id'];?></td>
			<td><?php echo $child['line_id'];?></td>
			<td><?php echo $child['nickname'];?></td>
			<td><?php echo $child['birth_year'];?></td>
			<td><?php echo $child['birth_month'];?></td>
			<td><?php echo $child['sex'];?></td>
			<td><?php echo $child['benesse_user'];?></td>
			<td><?php echo $child['created'];?></td>
			<td><?php echo $child['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'children', 'action' => 'view', $child['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'children', 'action' => 'edit', $child['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'children', 'action' => 'delete', $child['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $child['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
