
<?php
extract($this->data['User']);
?>


<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

<?php echo $loginid; ?>さん<br /><br />
変更後のﾊﾟｽﾜｰﾄﾞをご入力の上､｢確認｣ﾎﾞﾀﾝを押してください｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />

<?php echo $this->Form->create('User', array("url" => "/users/edit?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<?php echo $form->hidden('loginid', array('value'=> $loginid)); ?>
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾊﾟｽﾜｰﾄﾞ</span><br />
  <span style="color:#ff6600;">半角英数字6-12文字</span><br />
    <?php 
    if($this->Ktai->is_ezweb()){
	echo $this->Form->input("new_password", array("type" => "text", "istyle" => "4", "style" => "font-size:x-small;"));
    } else {
	echo $this->Form->input("new_password", array("type" => "text", $this->tk->tk_style => $this->tk->tk_mode['4'], "style" => "-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;font-size:x-small;"));
    }
    ?><br />
    <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾊﾟｽﾜｰﾄﾞ確認</span><br />
  <span style="color:#ff6600;">半角英数字6-12文字</span><br />
<?php echo $this->Form->input("row_password", array("type" => "text", $this->tk->tk_style => $this->tk->tk_mode['4'], "style" => "font-size:x-small;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>
<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■下記の会員の場合はﾁｪｯｸを入れてください｡</span><br />
<?php echo $this->Form->input("dc_user",  array("type" => "checkbox", 'div' => false, 'label' => false)); ?>ﾄﾞｺﾓｺﾐｭﾆﾃｨ<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("確認"); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>

</table>
<?php echo $this->Form->end(); ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />


