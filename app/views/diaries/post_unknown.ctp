
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

まだ投稿が完了していません。<br />
以下の原因が考えられます。<br /><br />
ｻｰﾊﾞｰが混雑している可能性があります｡しばらく経ってから下の｢更新する｣ﾎﾞﾀﾝを押してください｡<br />
<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<?php echo $this->Form->create('Diary', array('url' => '/diaries/checkPost/'.$nexthash)); ?>

<form action="">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">
<?php echo $this->Form->input("", array("type" => "submit", "value" => "更新する")); ?>
</td>
</tr>
</table>
<?php $this->Form->end(); ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

</div>
