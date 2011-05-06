
<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

以下をご入力の上､｢次へ｣ﾎﾞﾀﾝを押してください｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#dd0000">
<?php
if(isset($errorStr)){
    echo $errorStr;
    echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10"));
}
?>
</span>
<br />
<?php echo $this->Form->create('User', array("url" => "/users/remindCheck?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾛｸﾞｲﾝ名</span><br />
<span style="color:#666666;">半角英数字4-12文字</span><br />
<?php
if($this->Ktai->is_ezweb()){
    echo $this->Form->input("remindId", array("type" => "text",'error' => false, "istyle" => "3", "style" => "font-size:x-small;"));
} else if($this->Ktai->is_imode() and $this->tk->is_imode_browser()) {
    if(isset($this->data['User']['remindId'])){
	echo '<input type="text" value="'.h($this->data['User']['remindId']).'" name="data[User][remindId]" istyle="3" format="*m" mode="alphabet" style="-wap-input-format:&quot;*&lt;ja:en&gt;&quot;;-wap-input-format:*m;" id="UserRemindId"/><br>';
    } else {
	echo '<input type="text" name="data[User][remindId]" istyle="3" format="*m" mode="alphabet" style="-wap-input-format:&quot;*&lt;ja:en&gt;&quot;;-wap-input-format:*m;" id="UserRemindId"/><br>';
    }
} else {
    echo $this->Form->input("remindId", array("type" => "text",'error' => false, $this->tk->tk_style => $this->tk->tk_mode['3'], "style" => "-wap-input-format:&quot;*&lt;ja:en&gt;&quot;;-wap-input-format:*m;font-size:x-small;"));
}
?><span style="color:#ff0000"><?php echo $form->error('remindId', null, array('wrap' => false)); ?></span>
<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どものﾆｯｸﾈｰﾑ</span><br />
<span style="color:#666666;">全角6文字以内</span><br />
<?php echo $this->Form->input("nickname", array("type" => "text", 'error' => false, "style" => "font-size:x-small;")); ?>
<span style="color:#ff0000"><?php echo $form->error('nickname', null, array('wrap' => false)); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの生年月<br />

<?php echo $this->Form->input('birth_year', array(
		'options' => $this->SelectOptions->getOption(array(
			'min' => date('Y') - Configure::read('Child.birthday_years'),
			'max' => date('Y'), 
			'reverse' => true,			
			'suffix' => '')),
        'empty' => '------',
        'error' => false,
		'div' => false,
		'label' => false,
		'style' => 'font-size:x-small;',
	)) ?>年 <br />
	<?php
		if($this->Ktai->is_ezweb()){
		    echo '<font color="#ff0000">';
		} else {
		    echo '<span style="color:#ff0000">';
		}
		echo $form->error('birth_year');
		if($this->Ktai->is_ezweb()){
		    echo '</font>';
		} else {
		    echo '</span>';
		}

	?>
<?php echo $this->Form->input('birth_month', array(
		'options' => $this->SelectOptions->getOption(array(
			'min' => 1, 
			'max' => 12, 
			'suffix' => '',)),
        'empty' => '------',
        'error' => false,
		'div' => false,
		'label' => false,
		'style' => 'font-size:x-small;',
	)) ?>月<br /><span style="color:#ff0000"><?php echo $form->error('birth_month', null, array('wrap' => false)); ?></span><br />
</span>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("次へ"); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>

</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

