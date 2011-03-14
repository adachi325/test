<div class="diaries view">
<h2><?php  __('Diary');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $diary['Diary']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Child'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($diary['Child']['id'], array('controller' => 'children', 'action' => 'view', $diary['Child']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Theme'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($diary['Theme']['title'], array('controller' => 'themes', 'action' => 'view', $diary['Theme']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Hash'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $diary['Diary']['hash']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $diary['Diary']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $diary['Diary']['body']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Has Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $diary['Diary']['has_image']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Error Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $diary['Diary']['error_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $diary['Diary']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $diary['Diary']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Diary', true), array('action' => 'edit', $diary['Diary']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Diary', true), array('action' => 'delete', $diary['Diary']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $diary['Diary']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Diaries', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Diary', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Children', true), array('controller' => 'children', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Child', true), array('controller' => 'children', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>
