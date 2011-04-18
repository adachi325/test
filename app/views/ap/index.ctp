<?php echo $this->Html->image("ttl_challenge.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="85%"><?php echo $this->Html->image("txt_{$line}.gif", array("width" => "100%")); ?></td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="85%"><span style="font-size:x-small; color:<?php echo Configure::read('LinesString.age.'.$line.'.1'); ?>;"><?php echo Configure::read('LinesString.age.'.$line.'.0'); ?></span></td>
<td width="10%">&nbsp;</td>
</tr>
<?php if($line === 'baby'){ ?>
<tr>
<td width="85%"><?php echo $this->Html->image("txt_first.gif", array("width" => "100%")); ?></td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="85%"><span style="font-size:x-small; color:<?php echo Configure::read('LinesString.age.petit_f.1'); ?>;"><?php echo Configure::read('LinesString.age.petit_f.0'); ?></span></td>
<td width="10%">&nbsp;</td>
</tr>
<?php }?>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />



<table width="100%" cellpadding="0" cellspacing="0">

<?php $alt = true; ?>

<?php foreach ($issues as $issue): ?>
<?php foreach ($issue['Content'] as $content): ?>

<tr>
<td<?php if ($alt) { echo ' bgcolor="#ffefef"'; } ?>><div style="font-size:x-small;">
<?php $alt = !$alt;?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<?php if ($line == 'baby' || $line == 'petit') : ?>
<span style="color:#333333;">●<?php echo h($issue['Issue']['title']); ?></span><br />
<?php endif; ?>

<?php if($content['release_date'] <= date('Y-m-d H:i:s')): ?>
<?php
$url = $content['path'];
if ((strlen($url) > 4) && (substr($url, 0, 4) == "http")) {
} else {
	$url = $this->Html->url(DS.$url.DS);
}
?>
<span style="color:#cc0000;"><?php 
echo ($content['release_date'] > date("Y-m-d H:i:s", strtotime("-7 day"))) ? $this->Ktai->emoji(0xE6DD, false) : '&nbsp;･'; 
?></span><a href="<?php echo $url; ?>" style="color:#ff3333;"><span style="color:#ff3333;"><?php echo h($content['title']); ?></span></a>
<?php else: ?>
&nbsp;･<?php echo h($content['title']).$this->Time->format('(n月j日更新予定)', $content['release_date']); ?>
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

<?php if (!empty($login_user_data) && $login_user_data['User']['dc_user'] == 1): ?>
<?php else: ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php echo $this->Html->image("ttl_fun.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_mobile.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_challenge.gif", array("width" => "100%")); ?></td>
</tr>
</table>

<?php echo $this->Html->image("60pic_kodomo101.gif", array( "align" => "left", "style" => "float:left; margin-right:2px;")); ?>
&lt;こどもちゃれんじ&gt;教材と連動した年齢別ｺﾝﾃﾝﾂが楽しめる!<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?></div>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_orrange.gif", array()); ?></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_album.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_memory.gif", array("width" => "100%")); ?></td>
</tr>
</table>
<?php echo $this->Html->image("60pic_omoide101.gif", array("align" => "left", "style" => "float:left; margin-right:2px;")); ?>お子さんの成長がかわいく残せる!写真がたまるとﾎﾟｽﾄｶｰﾄﾞに♪<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?></div>

<div align="center" style="text-align:center;"><a href="<?php echo $this->Html->url('/navigations/prev/1');?>"><span style="color:#ff6600;">更に詳しく見る</span></a><span style="color:#cc0000;"><?php $this->Ktai->emoji(0xE6F5); ?></span></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<div align="center" style="background:#ffff99; text-align:center;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="font-size:medium;"><span style="color:#ff00ff;"><?php $this->Ktai->emoji(0xE6FA); ?></span><a href="<?php echo $this->Html->url('/navigations/prev/2'); ?>">今すぐ登録!(無料)</a><span style="color:#ff00ff;"><?php $this->Ktai->emoji(0xE6FA); ?></span></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>
<?php endif; ?>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_mobile.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_course.gif", array("width" => "100%")); ?></td>
</tr>
</table>

<?php echo $this->element('default/room'); ?>

