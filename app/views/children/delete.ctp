<div>
<?php echo $form->create('Child', array('action' => 'delete'));?>
本当にニックを消すんですか？<br><br>

ニックネーム<br>
<?php echo $this->data['Child']['nickname']; ?><br><br>
<?php echo $form->hidden('check', array('value'=>'1')); ?>
<?php echo $form->end('削除');?>

<?php echo $form->create('Child', array('action' => 'index'));?>
<?php echo $form->end('やっぱ削除しない');?>
</div>
<div>
    <?php echo $html->link(__('マイページTOP', true), array('action' => 'index'));?>
</div>
