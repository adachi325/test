<div class="childPresents view">
<h2><?php  __('ChildPresent');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $childPresent['ChildPresent']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Child'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($childPresent['Child']['id'], array('controller' => 'children', 'action' => 'view', $childPresent['Child']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Present'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($childPresent['Present']['id'], array('controller' => 'presents', 'action' => 'view', $childPresent['Present']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $childPresent['ChildPresent']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $childPresent['ChildPresent']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit ChildPresent', true), array('action' => 'edit', $childPresent['ChildPresent']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete ChildPresent', true), array('action' => 'delete', $childPresent['ChildPresent']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childPresent['ChildPresent']['id'])); ?> </li>
		<li><?php echo $html->link(__('List ChildPresents', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New ChildPresent', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Presents', true), array('controller' => 'presents', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Present', true), array('controller' => 'presents', 'action' => 'add')); ?> </li>
	</ul>
</div>
