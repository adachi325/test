<div class="themes view">
<h2><?php  __('Theme');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $theme['Theme']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Issue'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($theme['Issue']['title'], array('controller' => 'issues', 'action' => 'view', $theme['Issue']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $theme['Theme']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $theme['Theme']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Release Week'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $theme['Theme']['release_week']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Release Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $theme['Theme']['release_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $theme['Theme']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $theme['Theme']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Theme', true), array('action' => 'edit', $theme['Theme']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Theme', true), array('action' => 'delete', $theme['Theme']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $theme['Theme']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Themes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Theme', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Issues', true), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Issue', true), array('controller' => 'issues', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Diaries', true), array('controller' => 'diaries', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Diary', true), array('controller' => 'diaries', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Diaries');?></h3>
	<?php if (!empty($theme['Diary'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Child Id'); ?></th>
		<th><?php __('Theme Id'); ?></th>
		<th><?php __('Hush Cord'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Image Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($theme['Diary'] as $diary):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $diary['id'];?></td>
			<td><?php echo $diary['child_id'];?></td>
			<td><?php echo $diary['theme_id'];?></td>
			<td><?php echo $diary['hush_cord'];?></td>
			<td><?php echo $diary['title'];?></td>
			<td><?php echo $diary['description'];?></td>
			<td><?php echo $diary['image_name'];?></td>
			<td><?php echo $diary['created'];?></td>
			<td><?php echo $diary['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'diaries', 'action' => 'view', $diary['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'diaries', 'action' => 'edit', $diary['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'diaries', 'action' => 'delete', $diary['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $diary['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Diary', true), array('controller' => 'diaries', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
