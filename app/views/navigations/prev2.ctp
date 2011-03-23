<?php echo $form->create('navigations', array('action' => 'register?guid=ON')); ?>
<?php echo $form->checkbox('agree'); ?>
<?php echo $this->Html->link('利用規約', '/pages/rules'); ?>に激しく同意します。
<?php echo $form->submit('登録'); ?>
<?php echo $form->end(); ?>
