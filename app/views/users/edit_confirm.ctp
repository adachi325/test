<div>
<h1>入力項目確認</h1>
</div>
<?php echo $form->create('User', array('action' => 'edit_complete')); ?>

パスワード<br>
*********<br><br>

ドコモコミュニティ<br>
<?php
if($this->data['User']['dc_user'] == 1) {
    echo '登録済み';
} else {
    echo '未登録';
}
?><br><br>

<?php echo $form->submit('会員登録実行'); ?>
<?php echo $form->end(); ?>


<?php echo $form->create('User', array('action' => 'edit')); ?>
<?php echo $form->submit('入力項目修正'); ?>
<?php echo $form->end(); ?>
