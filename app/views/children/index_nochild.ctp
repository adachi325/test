
<?php echo $this->Html->image("top_nypage_main.gif", array("width" => "100%")); ?><br />

<p>
子供が登録されていません。
</p>

<!-- 設定 -->

<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<?php echo $this->Html->image("icn_spana.gif", array()); ?><span style="font-size:x-small;"><?php echo h($this->Session->read('Auth.User.loginid')); ?>さんの設定</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<span style="font-size:x-small;">･</span><a href="<?php echo $this->Html->url('/children/edit_menu/'); ?>" style="color:#666666;"><span style="color:#666666;">子ども情報の追加/変更/削除</span></a><br />
<span style="font-size:x-small;">･</span><a href="<?php echo $this->Html->url('/children/user_menu/'); ?>" style="color:#666666;"><span style="color:#666666;">ﾕｰｻﾞｰ情報を設定する</span></a><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<div align="right" style="text-align:right;"><?php $this->Ktai->emoji(0xE6E0); ?><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></div>
<br />

