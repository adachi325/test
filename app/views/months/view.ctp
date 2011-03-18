<div class="months view">
<h2><?php  __('Month');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $month['Month']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Year'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $month['Month']['year']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Month'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $month['Month']['month']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $month['Month']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $month['Month']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Month', true), array('action' => 'edit', $month['Month']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Month', true), array('action' => 'delete', $month['Month']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $month['Month']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Months', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Month', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Presents', true), array('controller' => 'presents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Present', true), array('controller' => 'presents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Presents');?></h3>
	<?php if (!empty($month['Present'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Month Id'); ?></th>
		<th><?php __('Present Type'); ?></th>
		<th><?php __('Present Path'); ?></th>
		<th><?php __('Present Thumbnail Path'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($month['Present'] as $present):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $present['id'];?></td>
			<td><?php echo $present['month_id'];?></td>
			<td><?php echo $present['present_type'];?></td>
			<td><?php echo $present['present_path'];?></td>
			<td><?php echo $present['present_thumbnail_path'];?></td>
			<td><?php echo $present['created'];?></td>
			<td><?php echo $present['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'presents', 'action' => 'view', $present['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'presents', 'action' => 'edit', $present['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'presents', 'action' => 'delete', $present['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $present['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Present', true), array('controller' => 'presents', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Themes');?></h3>
	<?php if (!empty($month['Theme'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Month Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Release Date'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($month['Theme'] as $theme):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $theme['id'];?></td>
			<td><?php echo $theme['month_id'];?></td>
			<td><?php echo $theme['title'];?></td>
			<td><?php echo $theme['description'];?></td>
			<td><?php echo $theme['release_date'];?></td>
			<td><?php echo $theme['created'];?></td>
			<td><?php echo $theme['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'themes', 'action' => 'view', $theme['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'themes', 'action' => 'edit', $theme['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'themes', 'action' => 'delete', $theme['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $theme['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
