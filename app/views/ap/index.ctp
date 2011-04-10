
<?php echo $this->Html->image("ttl_challenge.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_{$line}.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_{$line}.gif", array("width" => "100%")); ?></td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="85%"><span style="font-size:x-small; color:#fcb800;"><?php echo h($title); ?></span></td>
</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">

<?php foreach ($issues as $issue): ?>

<?php foreach ($issue['Content'] as $content): ?>
<!--<?php echo h($issue['Issue']['title']); ?>-->	
<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#cc0000;"><?php echo ($content['release_date'] > date("Y-m-d H:i:s", strtotime("-7 day"))) ? $this->Ktai->emoji(0xE6DD, false) : '・'; ?></span>
<?php if($content['release_date'] <= date('Y-m-d H:i:s')): ?>
<?php
$url = $content['path'];
if ((strlen($url) > 4) && (substr($url, 0, 4) == "http")) {
} else {
	$url = $this->Html->url(DS.$url.DS);
}
?>
<a href="<?php echo $url; ?>" style="color:#ff3333;"><span style="color:#ff3333;"><?php echo h($content['title']); ?></span></a>
<?php else: ?>
<?php echo h($content['title']).$this->Time->format('(n月j日更新予定)', $content['release_date']); ?>
<?php endif; ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>
<?php endforeach; ?>

<?php endforeach; ?>

</table>

<?php if ($this->params['action'] === 'pocket'): ?>
<?php echo $this->element('default/pocket'); ?>
<?php endif; ?>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<?php if (!empty($login_user_data) && $login_user_data['User']['dc_user'] == 1): ?>
<?php else: ?>
<p>会員登録すると、他の教材ｺﾝﾃﾝﾂやお子様の思い出記録など、楽しい機能が使えるよ☆</p>
<?php echo $this->Form->create('Page', array('url' => '/pages/display/?guid=ON')); ?>
<div align="center" style="text-align:center;"><?php echo $this->Form->submit('ｻｰﾋﾞｽｲﾒｰｼﾞを見る'); ?></div>
<?php echo $this->Form->end(); ?>
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>
<?php endif; ?>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_mobile.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_course.gif", array("width" => "100%")); ?></td>
</tr>
</table>


<?php echo $this->element('default/room'); ?>

