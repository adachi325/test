<div style="background:#ff6600;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="font-size:small;font-weight:bold; color:#ffffff;">ﾛｸﾞｲﾝ</span><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

ﾛｸﾞｲﾝ名とﾊﾟｽﾜｰﾄﾞを入力してくだい｡<br />
<font color="#dd0000">
<?php
echo $this->Session->flash();
echo $this->Session->flash('auth');;
?>
</font>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Form->create('User', array("url" => "/users/login?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾛｸﾞｲﾝ名</span><br />
<span style="color:#666666;">半角英数字4-12文字</span><br />
<?php echo $this->Form->input("loginid", array("type" => "text", "style" => "font-size:x-small;", $this->tk->tk_style => $this->tk->tk_mode['3'])); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>
<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾊﾟｽﾜｰﾄﾞ</span><br />
<span style="color:#666666;">半角英数字6-12文字</span><br />
<?php echo $this->Form->input("password", array("type" => "password", "style" => "font-size:x-small;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("ﾛｸﾞｲﾝ"); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>
</table>
<?php echo $this->Form->end(); ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />

※ﾊﾟｽﾜｰﾄﾞを忘れた方は<a href="<?php echo Router::url('/users/remind/', true) ?>"><span style="color:#ff6600;">こちら</span></a><br />
→　<a href="<?php echo Router::url('/users/register/', true) ?>"><span style="color:#ff6600;">新規ﾌﾟﾛﾌｨｰﾙ登録</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />


