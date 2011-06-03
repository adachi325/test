<?php /* 171-2 その他の設定 */ ?>

<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "alt" => "設定")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php echo h($this->Session->read('Auth.User.loginid')); ?>さん<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#666666;">&nbsp;･</span><span style="color:#666666;">その他の設定</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />

<?php echo $this->Form->create('User', array("url" => "/users/other_setting?guid=ON", "inputDefaults" => array("div" => false, "label" => false))); ?>
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■下記の会員の場合はﾁｪｯｸを入れてください｡</span><br />
<?php echo $this->Form->input("dc_user",  array("type" => "checkbox", 'div' => false, 'label' => false)); ?>ﾄﾞｺﾓｺﾐｭﾆﾃｨ<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>

<tr>
<td align="center">

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("確認", array("div" => false)); ?><br />
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->create(null, array("url" => "/users/menu?guid=ON", "type" => "get", "div" => false));?>
<input type="submit" value="戻る" /><br />
<?php echo $this->Form->end(); ?>
</td>
</tr>

</table>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
