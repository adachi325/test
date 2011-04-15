<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

内容をご確認の上､｢変更｣ﾎﾞﾀﾝを押してください｡<br />内容修正の場合は｢戻る｣ﾎﾞﾀﾝを押して前の画面に戻って行ってください｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Form->create('User', array("url" => "/users/edit_complete?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td bgcolor="#eeeeee"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾊﾟｽﾜｰﾄﾞ</span><br />
<span style="color:#000000;"><?php echo $this->data['User']['new_password']; ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾄﾞｺﾓｺﾐｭﾆﾃｨ会員</span><br />
<?php echo ($this->data['User']['dc_user'] == 1) ? 'はい' : 'いいえ'; ?><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("変更"); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
</td>
</tr>
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Form->create('User', array('url' => '/users/edit?guid=ON'));?>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
        <?php echo $this->Form->submit("戻る"); ?><br />
        <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
        </td>
    </tr>
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

