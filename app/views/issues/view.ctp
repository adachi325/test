<div class="issues view">
<h2><?php  __('Issue');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $issue['Issue']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Line'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($issue['Line']['title'], array('controller' => 'lines', 'action' => 'view', $issue['Line']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $issue['Issue']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Release Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $issue['Issue']['release_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $issue['Issue']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $issue['Issue']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Issue', true), array('action' => 'edit', $issue['Issue']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Issue', true), array('action' => 'delete', $issue['Issue']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $issue['Issue']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Issues', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Issue', true), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php __('Related Contents');?></h3>
	<?php if (!empty($issue['Content'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Line Id'); ?></th>
		<th><?php __('Issue Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Path'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Content Type'); ?></th>
		<th><?php __('Release Date'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($issue['Content'] as $content):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $content['id'];?></td>
			<td><?php echo $content['line_id'];?></td>
			<td><?php echo $content['issue_id'];?></td>
			<td><?php echo $content['title'];?></td>
			<td><?php echo $content['path'];?></td>
			<td><?php echo $content['description'];?></td>
			<td><?php echo $content['content_type'];?></td>
			<td><?php echo $content['release_date'];?></td>
			<td><?php echo $content['created'];?></td>
			<td><?php echo $content['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'contents', 'action' => 'view', $content['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'contents', 'action' => 'edit', $content['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'contents', 'action' => 'delete', $content['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $content['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Content', true), array('controller' => 'contents', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Presents');?></h3>
	<?php if (!empty($issue['Present'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Issue Id'); ?></th>
		<th><?php __('Present Type'); ?></th>
		<th><?php __('Present Path'); ?></th>
		<th><?php __('Present Thumbnail Path'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($issue['Present'] as $present):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $present['id'];?></td>
			<td><?php echo $present['issue_id'];?></td>
			<td><?php echo $present['present_type'];?></td>
			<td><?php echo $present['present_path'];?></td>
			<td><?php echo $present['present_thumbnail_path'];?></td>
			<td><?php echo $present['created'];?></td>
			<td><?php echo $present['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'presents', 'action' => 'view', $present['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'presents', 'action' => 'edit', $present['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'presents', 'action' => 'delete', $present['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $present['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Present', true), array('controller' => 'presents', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Themes');?></h3>
	<?php if (!empty($issue['Theme'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Issue Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Release Week'); ?></th>
		<th><?php __('Release Date'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($issue['Theme'] as $theme):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $theme['id'];?></td>
			<td><?php echo $theme['issue_id'];?></td>
			<td><?php echo $theme['title'];?></td>
			<td><?php echo $theme['description'];?></td>
			<td><?php echo $theme['release_week'];?></td>
			<td><?php echo $theme['release_date'];?></td>
			<td><?php echo $theme['created'];?></td>
			<td><?php echo $theme['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'themes', 'action' => 'view', $theme['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'themes', 'action' => 'edit', $theme['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'themes', 'action' => 'delete', $theme['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $theme['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
