<?php /* 117-1 パスワード変更 */ ?>
<?php
extract($this->data['User']);
?>


<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "alt" => "設定")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php echo h($this->Session->read('Auth.User.loginid')); ?>さん<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#666666;">&nbsp;･</span><span style="color:#666666;">ﾊﾟｽﾜｰﾄﾞの変更</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
変更後のﾊﾟｽﾜｰﾄﾞをご入力の上､｢確認｣ﾎﾞﾀﾝを押して下さい｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />

<?php echo $this->Form->create('User', array("url" => "/users/edit?guid=ON", "inputDefaults" => array("div" => false, "label" => false))); ?>
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<p><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾊﾟｽﾜｰﾄﾞ</span><br />
  <span style="color:#ff6600;">半角英数字6-12文字</span><br />
    <?php
    if($this->Ktai->is_ezweb()){
	echo $this->Form->input("new_password", array("type" => "text",'error' => false, "istyle" => "4", "style" => "font-size:x-small;"));
    } else if($this->Ktai->is_imode() and $this->tk->is_imode_browser()) {
        if(isset($this->data['User']['new_password'])){
            echo '<input type="text" value="'.h($this->data['User']['new_password']).'" name="data[User][new_password]" format="*N" mode="numeric" style="-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;" id="UserNewPassword"/><br />';
        } else {
            echo '<input type="text" name="data[User][new_password]" format="*N" mode="numeric" style="-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;" id="UserNewPassword"/>';
        }
    } else {
	echo $this->Form->input("new_password", array("type" => "text",'error' => false, $this->tk->tk_style => $this->tk->tk_mode['4'], "style" => "-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;font-size:x-small;"));
    }
    ?><span style="color:#ff0000"><?php echo $form->error('new_password', null, array('wrap' => false)); ?></span><br />
    <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></p>
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
    if(isset($this->data['User']['row_password'])){
        echo '<input type="text" value="'.h($this->data['User']['row_password']).'" name="data[User][row_password]" format="*N" mode="numeric" style="-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;" id="UserRowPassword"/>';
    } else {
        echo '<input type="text" name="data[User][row_password]" format="*N" mode="numeric" style="-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;" id="UserRowPassword"/>';
    }
} else {
    echo $this->Form->input("row_password", array("type" => "text",'error' => false, $this->tk->tk_style => $this->tk->tk_mode['4'], "style" => "-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;font-size:x-small;"));
}
?><br /><span style="color:#ff0000"><?php echo $form->error('row_password', null, array('wrap' => false)); ?></span>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("確認", array("div" => false)); ?><br />
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->create(null, array("url" => "/users/menu?guid=ON", "type" => "get", "div" => false));?>
<?php echo $this->Form->submit("戻る", array("div" => false)); ?><br />
<?php echo $this->Form->end(); ?>
</td>
</tr>

</table>
<?php echo $this->Form->end(); ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
