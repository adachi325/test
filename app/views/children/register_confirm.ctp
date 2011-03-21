<div>
<?php echo $form->create('Child', array('action' => 'register_complete'));?>
確認画面です<br><br>

ニックネーム<br>
<?php echo $this->data['Child']['nickname']; ?><br><br>

性別<br>
<?php
if($this->data['Child']['sex'] == 1) {
    echo '女';
} else {
    echo '男';
}
?><br><br>

生年月<br>
<?php echo $this->data['Child']['birth_year']; ?>年 <?php echo $this->data['Child']['birth_month']; ?>月<br><br>

年齢<br>
<?php echo $lines[$this->data['Child']['line_id']]; ?><br><br>

こどもちゃれんじ<br>
<?php
if($this->data['Child']['benesse_user'] == 1){
    echo '登録済み';
} else {
    echo '未登録';
}
?><br><br>

<?php echo $form->end('登録');?>


<?php echo $form->create('Child', array('action' => 'register'));?>
<?php echo $form->end('修正');?>
</div>
<div>
    <?php echo $html->link(__('マイページTOP', true), array('action' => 'index'));?>
</div>
