
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#339933;">&nbsp;･ﾃｰﾏ:<?php echo h($theme['Theme']['title']); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
お子さんの思い出を自由に残そう!<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<table width="100%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="3" align="center">
<span style="color:#666666;font-size:x-small;">【思い出記録例】</span><br />
</td>
</tr>
<tr>
<td>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</td>
<td align="center" width="80%">
<?php echo $this->Html->image("theme/theme_".$theme['Theme']['id'].".jpg", array("width" => "100%")); ?><br />
</td>
<td>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</td>
</tr>
</table>
<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffff99">
<tr>
<td colspan="3" align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#333333;font-size:medium">①思い出を記録に残す</span><span style="font-size:small;"><?php $this->Ktai->emoji(0xE6D3); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br /></td>
</tr>
<tr>
<td colspan="3" align="left">
<?php if($this->Ktai->is_imode()): ?>
<!-- start: imodeの場合-->
<span style="color:#006600; font-size:x-small;">⇒</span><a href="mailto:<?php echo $mailPublicStr; ?>?subject=<?php echo $mailTitle; ?>" style="color:#339900;"><span style="color:#339900; font-size:x-small;">わが子をみんなに大自慢!!</span></a><br />
<span style="font-size:x-small;">(他の会員に公開する)</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#006600; font-size:x-small;">⇒</span><a href="mailto:<?php echo $mailStr; ?>?subject=<?php echo $mailTitle; ?>" style="color:#339900;"><span style="color:#339900; font-size:x-small;">わが子を自分で自画自賛!!</span></a><br />
<span style="font-size:x-small;">(他の会員には見せない)</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
<!-- end: imodeの場合-->

<?php elseif($this->Ktai->is_softbank()): ?>
<!-- start: sbの場合-->
<span style="color:#006600; font-size:x-small;">⇒</span><a href="mailto:<?php echo $mailPublicStr; ?>?subject=<?php echo rawurlencode(mb_convert_encoding($mailTitle, "utf8")); ?>" style="color:#339900;"><span style="color:#339900; font-size:x-small;">わが子をみんなに大自慢!!</span></a><br />
<span style="font-size:x-small;">(他の会員に公開する)</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#006600; font-size:x-small;">⇒</span><a href="mailto:<?php echo $mailStr; ?>?subject=<?php echo rawurlencode(mb_convert_encoding($mailTitle, "utf8")); ?>" style="color:#339900;"><span style="color:#339900; font-size:x-small;">わが子を自分で自画自賛!!</span></a><br />
<span style="font-size:x-small;">(他の会員には見せない)</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
<!-- end: sbの場合-->

<?php else: ?>
<!-- start: その他の場合-->
<span style="color:#006600; font-size:x-small;">⇒</span><span style="color:#339900; font-size:x-small;"><?php $this->Ktai->mailto("わが子をみんなに大自慢!!", $mailPublicStr, $mailTitle); ?></span><br />
<span style="font-size:x-small;">(他の会員に公開する)</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#006600; font-size:x-small;">⇒</span><span style="color:#339900; font-size:x-small;"><?php $this->Ktai->mailto("わが子を自分で自画自賛!!", $mailStr, $mailTitle); ?></span></a><br />
<span style="font-size:x-small;">(他の会員には見せない)</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
<!-- end: その他の場合-->
<?php endif; ?>
</td>
</tr>
</table>

<div align="right" style="text-align:right;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<a href="<?php echo $this->Html->url('/diaries/publish/'); ?>" style="color:#ff0000;"><span style="color:#ff0000;font-size:x-small;">※公開に関する注意事項</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#cc0000">※写真を添付して､本文にｺﾒﾝﾄを書いて送信してください｡ﾀｲﾄﾙは自由に変更できます｡<br /></span>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#cc0000">※絵文字･ﾃﾞｺﾒ絵文字･一部の記号は､文字化けするためご利用できません｡<br /></span>
<span style="color:#666666">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
※端末により､写真が回転する場合があります｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
※写真はJPG形式で容量が2MB以内､1枚のみとなります｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
※送信した写真ﾃﾞｰﾀはNTTﾄﾞｺﾓのｻｰﾊﾞで管理します｡<br />
</span>
<br />
<div align="center" style="text-align:center;">↓送信後は､こちらで確認↓</div>
<div align="center" style="background:#ffff99; text-align:center;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#339900; font-size:medium"><span style="color:#006600;">②</span><a href="<?php echo $this->Html->url('/diaries/checkPost/'.$nexthash); ?>" style="color:#339900;"><span style="color:#339900;">思い出記録を確認する</span></a></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

