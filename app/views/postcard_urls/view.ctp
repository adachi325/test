<div class="postcardUrls view">
<h2><?php  __('PostcardUrl');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $postcardUrl['PostcardUrl']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Child'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($postcardUrl['Child']['id'], array('controller' => 'children', 'action' => 'view', $postcardUrl['Child']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Token'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $postcardUrl['PostcardUrl']['token']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $postcardUrl['PostcardUrl']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $postcardUrl['PostcardUrl']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit PostcardUrl', true), array('action' => 'edit', $postcardUrl['PostcardUrl']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete PostcardUrl', true), array('action' => 'delete', $postcardUrl['PostcardUrl']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $postcardUrl['PostcardUrl']['id'])); ?> </li>
		<li><?php echo $html->link(__('List PostcardUrls', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New PostcardUrl', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
	</ul>
</div>
