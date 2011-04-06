
<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

内容をご確認の上､｢登録｣ﾎﾞﾀﾝを押してください｡<br />
<?php echo $this->Html->image("dot_line_gray.gif", array("style" => "margin:10px 0; width:100%")); ?><br />

<?php echo $form->create('Child', array('action' => 'register_complete?guid=ON'));?>

<?php extract($this->data['Child']); ?>

<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
■子どものﾆｯｸﾈｰﾑ<br />
<?php echo $nickname; ?><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
■子どもの性別<br />
<?php
if($sex == 1) {
    echo '女の子';
} else {
    echo '男の子';
}
?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
■子どもの生年月<br />
<?php echo $birth_year; ?>年 <?php echo $birth_month; ?>月<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
■子どもの年齢<br />
<?php echo $lines[$line_id]; ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
■こどもちゃれんじご利用中<br />
<?php
if($benesse_user == 1){
    echo 'はい';
} else {
    echo 'いいえ';
} ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit('登録'); ?>
<?php echo $this->Form->end(); ?>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->create('Child', array('action' => 'register?guid=ON'));?>
<?php echo $this->Form->end('戻る');?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>

</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

