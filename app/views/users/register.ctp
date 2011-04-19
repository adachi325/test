
<div style="background:#ff6600;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="font-size:small;font-weight:bold; color:#ffffff;">ﾌﾟﾛﾌｨｰﾙ登録</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

以下をご入力の上､｢確認｣ﾎﾞﾀﾝを押してください｡<br />
<span style="color:#CC0000">※ﾛｸﾞｲﾝ名やﾊﾟｽﾜｰﾄﾞはご自由に設定できますが、電話番号やﾒｰﾙｱﾄﾞﾚｽ等､個人を特定できる情報は利用しないでください｡</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Form->create('User', array("url" => "/users/register?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾛｸﾞｲﾝ名</span><span style="color:#ff0000;">(必須)</span><br />
<span style="color:#ff6600;">半角英数字4-12文字</span><br />
<?php
if($this->Ktai->is_ezweb()){
    echo $this->Form->input("loginid", array("type" => "text", "istyle" => "3", "style" => "font-size:x-small;"));
} else if($this->Ktai->is_imode() and $this->tk->is_imode_browser()) {
    echo $this->Form->input("loginid", array("type" => "text", $this->tk->tk_style => $this->tk->tk_mode['3'], "style" => "-wap-input-format:&quot;*&lt;ja:en&gt;&quot;;-wap-input-format:*m;"));
} else {
    echo $this->Form->input("loginid", array("type" => "text", $this->tk->tk_style => $this->tk->tk_mode['3'], "style" => "-wap-input-format:&quot;*&lt;ja:en&gt;&quot;;-wap-input-format:*m;font-size:x-small;"));
}
?>
<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾊﾟｽﾜｰﾄﾞ</span><span style="color:#ff0000;">(必須)</span> <br />
<span style="color:#ff6600;">半角英数字6-12文字</span><br />
<?php
if($this->Ktai->is_ezweb()){
    echo $this->Form->input("new_password", array("type" => "text", "istyle" => "4", "style" => "font-size:x-small;"));
} else if($this->Ktai->is_imode() and $this->tk->is_imode_browser()) {
    echo $this->Form->input("new_password", array("type" => "text", $this->tk->tk_style => $this->tk->tk_mode['4'], "style" => "-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;"));
    echo $this->Form->input("new_password", array("type" => "text", $this->tk->tk_style => $this->tk->tk_mode['4'], "style" => "-wap-input-format:&quot;*&lt;ja:en&gt;&quot;"));
    echo $this->Form->input("new_password", array("type" => "text", "style" => "-wap-input-format:&quot;*&lt;ja:en&gt;&quot;"));
    echo $this->Form->input("new_password", array("type" => "text", $this->tk->tk_style => $this->tk->tk_mode['4']));
    echo $this->Form->input("new_password", array("type" => "text", "istyle" => "4", "format" => "4","mode" => "alphabet"  , "style" => "-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;"));
} else {
    echo $this->Form->input("new_password", array("type" => "text", $this->tk->tk_style => $this->tk->tk_mode['4'], "style" => "-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;font-size:x-small;"));
}
?>
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>
<tr><td>
	<div><input name="data[User][row_password]" type="text" istyle="4" style="-wap-input-format:&amp;quot;*&amp;lt;ja:n&amp;gt;&amp;quot;;-wap-input-format:*N;" id="UserRowPassword" /></div>
	<div><input name="data[User][row_password]" type="text" istyle="4" style="-wap-input-format:&amp;quot;*&amp;lt;ja:n&amp;gt;&amp;quot;;-wap-input-format:*N;" /></div>
	<div><input type="text" name="data[User][row_password]" istyle="4" style="-wap-input-format:&amp;quot;*&amp;lt;ja:n&amp;gt;&amp;quot;;-wap-input-format:*N;" /></div>
	<input type="text" name="data[User][row_password]" format="*m" mode="alphabet" style="-wap-input-format:&quot;*&lt;ja:en&gt;&quot;;-wap-input-format:*m;" id="UserRowPassword"/><br>
	<div><input type="text" name="data[User][row_password]" format="*m" mode="alphabet" style="-wap-input-format:&quot;*&lt;ja:en&gt;&quot;;-wap-input-format:*m;" id="UserRowPassword"/></div><br>
	<input type="text" name="hoge" istyle="3" format="*m" mode="alphabet" style="-wap-input-format:&quot;*&lt;ja:en&gt;&quot;;-wap-input-format:*m;" /></td></tr>
<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾊﾟｽﾜｰﾄﾞ確認</span><span style="color:#ff0000;">(必須)</span><br />
<span style="color:#ff6600;">半角英数字6-12文字</span><br />
<?php
if($this->Ktai->is_ezweb()){
    echo $this->Form->input("row_password", array("type" => "text", "istyle" => "4", "style" => "font-size:x-small;"));
} else if($this->Ktai->is_imode() and $this->tk->is_imode_browser()) {
    echo $this->Form->input("row_password", array("type" => "text", $this->tk->tk_style => $this->tk->tk_mode['4'], "style" => "-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;"));
} else {
    echo $this->Form->input("row_password", array("type" => "text", $this->tk->tk_style => $this->tk->tk_mode['4'], "style" => "-wap-input-format:&quot;*&lt;ja:n&gt;&quot;;-wap-input-format:*N;font-size:x-small;"));
}
?>
<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どものﾆｯｸﾈｰﾑ</span><span style="color:#ff0000;">(必須)</span><br />
<span style="color:#ff6600;">全角6文字以内</span><br />
<?php echo $this->Form->input("Child.0.nickname", array("type" => "text", "style" => "font-size:x-small;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの性別</span><span style="color:#ff0000;">(必須)</span><br />

<?php
if (!isset($this->data['Child'][0]['sex'])) {
	$this->data['Child'][0]['sex'] = 0;
}
$value1 = ($this->data['Child'][0]['sex'] == 1) ? '1' : 'none';
$value2 = ($this->data['Child'][0]['sex'] == 2) ? '2' : 'none';
?>
<?php echo $this->Form->radio('Child.0.sex', array('1' => ''), array('legend' => false,'value' => $value1)); ?>女の子<br />
<?php echo $this->Form->radio('Child.0.sex', array('2' => ''), array('legend' => false,'value' => $value2)); ?>男の子<br /> 
<?php echo $form->error('Child.0.sex','必須項目です'); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの生年月</span><span style="color:#ff0000;">(必須)</span><br />
<?php echo $this->Form->input('Child.0.birth_year', array(
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
	)) ?>年 <br /><?php echo $form->error('Child.0.birth_year'); ?>
<?php echo $this->Form->input('Child.0.birth_month', array(
		'options' => $this->SelectOptions->getOption(array(
			'min' => 1, 
			'max' => 12, 
			'suffix' => '',)),
        'empty' => '------',
        'error' => false,
		'div' => false,
		'label' => false,
		'style' => 'font-size:x-small;',
	)) ?>月<br /><?php echo $form->error('Child.0.birth_month'); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの年齢<span style="color:#ff0000;">(必須)</span><br />
お子さんの年齢に合ったｺｰｽをお選びください｡</span><br />
<?php echo $this->Form->input('Child.0.line_id', array('style' => 'font-size:x-small;')); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■下記の会員の場合は､それぞれﾁｪｯｸを入れてください｡</span><br /><span style="color:#666666">※会員でなくても､このｻｰﾋﾞｽはご利用いただけます｡</span><br />
<?php echo $this->Form->input("Child.0.benesse_user", array("type" => "checkbox", 'div' => false, 'label' => false)); ?>こどもちゃれんじ<br />
<?php echo $this->Form->input("dc_user", array("type" => "checkbox", 'div' => false, 'label' => false)); ?>ﾄﾞｺﾓｺﾐｭﾆﾃｨ<br />
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

