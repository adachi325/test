<div class="lines view">
<h2><?php  __('Line');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $line['Line']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $line['Line']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $line['Line']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $line['Line']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $line['Line']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Line', true), array('action' => 'edit', $line['Line']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Line', true), array('action' => 'delete', $line['Line']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $line['Line']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Lines', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Line', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Contents', true), array('controller' => 'contents', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Content', true), array('controller' => 'contents', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Issues', true), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Issue', true), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Children');?></h3>
	<?php if (!empty($line['Child'])):?>
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
		foreach ($line['Child'] as $child):
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
<div class="related">
	<h3><?php __('Related Contents');?></h3>
	<?php if (!empty($line['Content'])):?>
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
		foreach ($line['Content'] as $content):
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
	<h3><?php __('Related Issues');?></h3>
	<?php if (!empty($line['Issue'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Line Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Release Date'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($line['Issue'] as $issue):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $issue['id'];?></td>
			<td><?php echo $issue['line_id'];?></td>
			<td><?php echo $issue['title'];?></td>
			<td><?php echo $issue['release_date'];?></td>
			<td><?php echo $issue['created'];?></td>
			<td><?php echo $issue['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'issues', 'action' => 'view', $issue['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'issues', 'action' => 'edit', $issue['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'issues', 'action' => 'delete', $issue['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $issue['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Issue', true), array('controller' => 'issues', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
