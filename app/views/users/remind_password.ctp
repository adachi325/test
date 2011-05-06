
<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

ﾊﾟｽﾜｰﾄﾞを設定してください｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Form->create('User', array("url" => "/users/remind_password?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾊﾟｽﾜｰﾄﾞ</span><br />
<span style="color:#ff6600;">半角英数字6-12文字</span><br />
<?php
if($this->Ktai->is_ezweb()){
    echo $this->Form->input("new_password", array("type" => "text",'error' => false, "istyle" => "4", "style" => "font-size:x-small;"));
} else if($this->Ktai->is_imode() and $this->tk->is_imode_browser()) {
    echo '<input type="text" name="data[User][new_password]" format="*N" mode="numeric" style="-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;" id="UserNewPassword"/><br>';
} else {
    echo $this->Form->input("new_password", array("type" => "text",'error' => false, $this->tk->tk_style => $this->tk->tk_mode['4'], "style" => "-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;font-size:x-small;"));
}
?>
<span style="color:#ff0000"><?php echo $form->error('new_password', null, array('wrap' => false)); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾊﾟｽﾜｰﾄﾞ確認</span><br />
<span style="color:#ff6600;">半角英数字6-12文字</span><br />
<?php
if($this->Ktai->is_ezweb()){
    echo $this->Form->input("row_password", array("type" => "text",'error' => false, "istyle" => "4", "style" => "font-size:x-small;"));
} else if($this->Ktai->is_imode() and $this->tk->is_imode_browser()) {
    echo '<input type="text" name="data[User][row_password]" format="*N" mode="numeric" style="-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;" id="UserRowPassword"/><br>';
} else {
    echo $this->Form->input("row_password", array("type" => "text",'error' => false, $this->tk->tk_style => $this->tk->tk_mode['4'], "style" => "-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;font-size:x-small;"));
}
?>
<span style="color:#ff0000"><?php echo $form->error('row_password', null, array('wrap' => false)); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("変更"); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>

</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

