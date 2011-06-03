<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "alt" => "設定")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_child_add.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_child_info.gif", array("width" => "100%", "alt" => "子ども情報")); ?></td>
</tr>
</table>

<?php if(count($childData) < 3): ?>
<span style="color:#666666;">&nbsp;･</span><a href="<?php echo $this->Html->url(array('controller' => 'children', 'action' => 'register')); ?>" style="color:#666666;"><span style="color:#666666;">子ども情報を追加する</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php endif; ?>
<?php if(count($childData) > 0): ?>
<span style="color:#666666;">&nbsp;･</span><a href="<?php echo $this->Html->url(array('controller' => 'children', 'action' => 'edit')); ?>" style="color:#666666;"><span style="color:#666666;">子ども情報を変更する</span></a><br />
<span style="color:#333333;">登録済みの子供の年齢やこどもちゃれんじのｺ-ｽ等の設定変更はこちら</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#666666;">&nbsp;･</span><a href="<?php echo $this->Html->url(array('controller' => 'children', 'action' => 'delete')); ?>" style="color:#666666;"><span style="color:#666666;">子ども情報を削除する</span></a><br />
<?php endif; ?>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj05.gif"); ?></div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_spana.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_profile_info.gif", array("alt" => "プロフィール情報", "width" => "100%")); ?></td>
</tr>
</table>

<span style="color:#666666;">&nbsp;･</span><a href="<?php echo $this->Html->url(array('action' => 'edit')); ?>" style="color:#666666;"><span style="color:#666666;">ﾊﾟｽﾜ-ﾄﾞを変更する</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#666666;">&nbsp;･</span><a href="<?php echo $this->Html->url(array('action' => 'edit')); ?>" style="color:#666666;"><span style="color:#666666;">その他の設定</span></a><br />
<span style="color:#333333;">ﾄﾞｺﾓｺﾐｭﾆﾃｨの設定変更はこちら</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#666666;">&nbsp;･</span><a href="<?php echo $this->Html->url(array('action' => 'delete')); ?>" style="color:#666666;"><span style="color:#666666;">ﾌﾟﾛﾌｨ-ﾙを削除する(退会)</span></a><br />
<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "40")); ?><br />
