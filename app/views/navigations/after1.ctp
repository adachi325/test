<?php echo $this->Html->image("ttl_fun.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
ﾌﾟﾛﾌｨｰﾙ登録が完了いたしました｡次回からは自動ﾛｸﾞｲﾝとなります｡<br />
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_orrange.gif", array()); ?></div>
<span style="color:#ff6600;">・</span><span style="color:#339933">思い出記録</span>とは<br />
毎週更新されるﾃｰﾏに沿ってお子さんの写真とｺﾒﾝﾄを書くだけでｶﾝﾀﾝにｽﾃｷな思い出が残せます｡<br /><br />まずはお子さんの思い出を記録してみよう!
ｹｰﾀｲに入っているお子さんのﾍﾞｽﾄｼｮｯﾄにｺﾒﾝﾄをつけてﾒｰﾙ<?php $this->Ktai->emoji(0xE6D3); ?>送信してみてね!<br />
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_orrange.gif", array()); ?></div>

<span style="color:#ff6600;">・</span><span style="color:#339933">最初のﾃｰﾏ:ﾍﾞｽﾄｼｮｯﾄ</span><br />
<img src="img/spacer.gif" width="1" height="5" /><br />
例を参考に思い出を残そう!<br />
<img src="img/spacer.gif" width="1" height="10" /><br />
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
<?php echo $this->Html->image("theme/theme_0.jpg", array("width" => "100%")); ?><br />
</td>
<td>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</td>
</tr>
</table>


<div align="center" style="background:#ffff99; text-align:center;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php
if($this->Ktai->is_imode() and !$this->tk->is_imode_browser()): ?>
<a href="mailto:<?php echo $mailStr ?>?subject=<?php echo urlencode(mb_convert_encoding($mailTitle, "utf8"));?>" style="color:#339900;"><span style="color:#339900;font-size:medium">①思い出を記録に残す</span></a>
<?php else: ?>
<span style="color:#339900;font-size:medium"><?php $this->Ktai->mailto("①思い出を記録に残す",$mailStr,$mailTitle); ?></span>
<?php endif; ?><?php $this->Ktai->emoji(0xE6D3); ?><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#CC0000">
※写真を添付して､本文にｺﾒﾝﾄを書いて送信してください｡<br /></span>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#666666">※写真はJPG形式で容量が2MB以内､1枚のみとなります｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
※絵文字･ﾃﾞｺﾒ絵文字はご利用できません｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
※ﾀｲﾄﾙは自由に変更できます｡<br /></span>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="center" style="text-align:center;">↓送信後は､こちらで確認↓</div>
<div align="center" style="background:#ffff99; text-align:center;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<a href="<?php echo $this->Html->url('/navigations/after2/'.$nexthash); ?>" style="color:#339900;"><span style="color:#339900;font-size:medium">②思い出記録を確認する</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</div>
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_orrange.gif", array()); ?></div>

今は送信しないで<a href="<?php echo $this->Html->url('/children/');?>">ﾄｯﾌﾟﾍﾟｰｼﾞ</a>へ進む<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

