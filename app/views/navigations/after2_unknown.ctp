
<?php echo $this->Html->image("ttl_fun.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
まだ送信が完了していません。<br />
以下の原因が考えられます。<br /><br />
<ol>
<li>ﾒｰﾙが送信されていません｡</li>
<li>ﾒｰﾙの送信が完了しておりません｡</li>
<li>ｻｰﾊﾞｰが混雑している可能性があります｡</li>
</ol>
<br /><br />1の場合は､ﾌﾞﾗｳｻﾞの戻るで前のﾍﾟｰｼﾞにお戻りください｡<br />
2､3の場合は､しばらく経ってから下の｢更新する｣ﾎﾞﾀﾝを押してください｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />

<?php echo $this->Form->create('Navigation', array("url" => '/navigations/after2/?guid=ON', "inputDefaults" => array("dev" => false, "label" => false))); ?>
<?php echo $form->hidden('nexthash', array('value'=> $nexthash)); ?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">
<?php echo $this->Form->submit("更新する"); ?>
</td>
</tr>
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

