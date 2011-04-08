
<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

<?php extract($this->data['Child']); ?>

内容をご確認の上､｢登録｣ﾎﾞﾀﾝを押してください｡<br />内容修正の場合は｢戻る｣ﾎﾞﾀﾝを押して前の画面に戻って行ってください｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Form->create('Child', array("url" => "/children/register_complete?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どものﾆｯｸﾈｰﾑ</span><br />
<?php echo h($nickname); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの性別</span><br />
<?php echo ($sex == 1) ? '女の子' : '男の子'; ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの生年月</span><br />
<?php echo "{$birth_year}年 {$birth_month}月"; ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの年齢</span><br />
<?php echo $lines[$line_id]; ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■こどもちゃれんじ会員</span><br />
<?php echo ($benesse_user == 1) ? 'はい' : 'いいえ'; ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $form->end('変更');?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $form->create('Child', array('url' => '/children/edit?guid=ON'));?>
<?php echo $form->end('戻る');?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>

</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

