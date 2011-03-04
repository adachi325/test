<div class="children view">
<h2><?php  __('Child');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $child['Child']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($child['User']['id'], array('controller' => 'users', 'action' => 'view', $child['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Line'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($child['Line']['title'], array('controller' => 'lines', 'action' => 'view', $child['Line']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nickname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $child['Child']['nickname']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Birth Year'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $child['Child']['birth_year']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Birth Month'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $child['Child']['birth_month']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sex'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $child['Child']['sex']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Benesse User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $child['Child']['benesse_user']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $child['Child']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $child['Child']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Child', true), array('action' => 'edit', $child['Child']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Child', true), array('action' => 'delete', $child['Child']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $child['Child']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Children', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Lines', true), array('controller' => 'lines', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Line', true), array('controller' => 'lines', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Child Presents', true), array('controller' => 'child_presents', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child Present', true), array('controller' => 'child_presents', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Diaries', true), array('controller' => 'diaries', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Diary', true), array('controller' => 'diaries', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Postcard Urls', true), array('controller' => 'postcard_urls', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Postcard Url', true), array('controller' => 'postcard_urls', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php  __('Related Child Presents');?></h3>
	<?php if (!empty($child['ChildPresent'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['ChildPresent']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Child Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['ChildPresent']['child_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Present Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['ChildPresent']['present_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['ChildPresent']['created'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['ChildPresent']['modified'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $html->link(__('Edit Child Present', true), array('controller' => 'child_presents', 'action' => 'edit', $child['ChildPresent']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php  __('Related Diaries');?></h3>
	<?php if (!empty($child['Diary'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['Diary']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Child Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['Diary']['child_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Theme Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['Diary']['theme_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Hush Cord');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['Diary']['hush_cord'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['Diary']['title'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['Diary']['description'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image Name');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['Diary']['image_name'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['Diary']['created'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['Diary']['modified'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $html->link(__('Edit Diary', true), array('controller' => 'diaries', 'action' => 'edit', $child['Diary']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php  __('Related Postcard Urls');?></h3>
	<?php if (!empty($child['PostcardUrl'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['PostcardUrl']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Child Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['PostcardUrl']['child_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Token');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['PostcardUrl']['token'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['PostcardUrl']['created'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $child['PostcardUrl']['modified'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $html->link(__('Edit Postcard Url', true), array('controller' => 'postcard_urls', 'action' => 'edit', $child['PostcardUrl']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php __('Related Child Presents');?></h3>
	<?php if (!empty($child['ChildPresent'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Child Id'); ?></th>
		<th><?php __('Present Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($child['ChildPresent'] as $childPresent):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childPresent['id'];?></td>
			<td><?php echo $childPresent['child_id'];?></td>
			<td><?php echo $childPresent['present_id'];?></td>
			<td><?php echo $childPresent['created'];?></td>
			<td><?php echo $childPresent['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'child_presents', 'action' => 'view', $childPresent['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'child_presents', 'action' => 'edit', $childPresent['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'child_presents', 'action' => 'delete', $childPresent['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childPresent['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Child Present', true), array('controller' => 'child_presents', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Diaries');?></h3>
	<?php if (!empty($child['Diary'])):?>
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
		foreach ($child['Diary'] as $diary):
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
<div class="related">
	<h3><?php __('Related Postcard Urls');?></h3>
	<?php if (!empty($child['PostcardUrl'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Child Id'); ?></th>
		<th><?php __('Token'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($child['PostcardUrl'] as $postcardUrl):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $postcardUrl['id'];?></td>
			<td><?php echo $postcardUrl['child_id'];?></td>
			<td><?php echo $postcardUrl['token'];?></td>
			<td><?php echo $postcardUrl['created'];?></td>
			<td><?php echo $postcardUrl['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'postcard_urls', 'action' => 'view', $postcardUrl['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'postcard_urls', 'action' => 'edit', $postcardUrl['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'postcard_urls', 'action' => 'delete', $postcardUrl['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $postcardUrl['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Postcard Url', true), array('controller' => 'postcard_urls', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
