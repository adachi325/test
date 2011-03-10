<div>
<h1>入力項目確認</h1>
</div>
<?php echo $form->create('User', array('action' => 'register_complete')); ?>

会員ID<br>
<?php echo $this->data['User']['loginid']; ?><br><br>

パスワード<br>
*********<br><br>

ニックネーム<br>
<?php echo $this->data['Child']['0']['nickname']; ?><br><br>

性別<br>
<?php
if($this->data['Child']['0']['sex'] == 0) {
    echo '女';
} else {
    echo '男';
}
?><br><br>

生年月<br>
<?php echo $this->data['Child']['0']['birth_year']; ?>年 <?php echo $this->data['Child']['0']['birth_month']; ?>月<br><br>

年齢<br>
<?php echo $lines[$this->data['Child']['0']['line_id']]; ?><br><br>

こどもちゃれんじ<br>
<?php
if($this->data['Child']['0']['benesse_user'] == 1){
    echo '登録済み';
} else {
    echo '未登録';
}
?><br><br>

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


<?php echo $form->create('User', array('action' => 'register')); ?>
<?php echo $form->submit('入力項目修正'); ?>
<?php echo $form->end(); ?>
