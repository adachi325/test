<div style="background:#339933;">
<?php echo $this->element('default/logo'); ?>
</div>

<p>
子供が登録されていません。
</p>

<!-- 設定 -->

<?php echo $this->Html->image('top/ttl_setting.gif', array('style'=>'margin-bottom:5px;')); ?><br />

<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left">
	<?php echo $this->Html->image('top/icn_spana.gif'); ?>
<span style="font-size:x-small;"><?php echo h($this->Session->read('Auth.User.loginid')); ?>さんの設定</span><br />
<?php echo $this->Html->image('spacer.gif', array('alt'=>'', 'width' => '1', 'height' => '5')); ?></td>
</tr>
<tr>
<td width="1" valign="top"><span style="font-size:x-small;">･</span></td>
<td width="229" align="left"><a href="<?php echo $this->Html->url('/children/edit_menu/'); ?>" style="color:#666666;"><span style="font-size:x-small; color:#666666;">子ども情報の追加/変更/削除</span></a></td>
</tr>
<tr>
<td valign="top"><span style="font-size:x-small;">･</span></td>
<td align="left"><a href="<?php echo $this->Html->url('/children/user_menu/'); ?>" style="color:#666666;"><span style="font-size:x-small; color:#666666;">ﾕｰｻﾞｰ情報を設定する</span></a></td>
</tr>
</table>
</div>
<br />

<div align="right" style="text-align:right;"><span style="font-size:x-small;">
<?php $this->Ktai->emoji(0xE6E0); ?><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></span></div>
<br />

