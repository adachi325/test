<div>
<?php echo $form->create('User', array('action' => 'delete'));?>
退会するとこれまでに投稿した思い出がすべて削除されます。<br><br>

Really ? . Are you ok?<br>
<?php echo $form->hidden('check', array('value'=> 1)); ?>
<?php echo $form->end('削除');?>

<?php echo $form->create('Child', array('action' => 'index'));?>
<?php echo $form->end('やっぱ削除しない');?>
</div>
<div>
    <?php echo $html->link(__('マイページTOP', true), array('action' => 'index'));?>
</div>
