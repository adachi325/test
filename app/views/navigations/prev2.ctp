
<?php echo $this->Html->image("ttl_fun.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
ｻｰﾋﾞｽをご利用いただくには､<span style="color:#cc0000">ﾌﾟﾛﾌｨｰﾙ登録(無料)</span>が必要です｡<br />
｢ｹｰﾀｲしまじろうひろば×ﾄﾞｺﾓｺﾐｭﾆﾃｨ｣は2012年3月31日までの期間限定ｻｰﾋﾞｽです｡<br />
ｻｰﾋﾞｽ終了後は写真等のﾃﾞｰﾀが残りませんので､あらかじめご了承ください｡<br />
なお､このｻｰﾋﾞｽはau､ｿﾌﾄﾊﾞﾝｸをお使いのかたもご利用になれます｡<br /><br />

ご利用規約の内容をご確認の上､登録画面へお進み下さい｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />

<?php echo $this->Form->create('Navigation', array("url" => "/navigations/register/?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%">
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="font-size:small">
<?php echo $this->Form->input("agree", array("type" => "checkbox", "div" => false, "label" => false)); ?>
<a href="<?php echo $this->Html->url('/pages/rules/'); ?>" style="color:#ff6600;"><span style="color:#ff6600;">利用規約</span></a>に同意します｡</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</td>
</tr>
<tr>
<td align="center">
<?php echo $this->Form->submit("登録"); ?>
</td>
</tr>
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

