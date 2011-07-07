
<?php echo $this->Html->image("ttl_fun.gif", array("alt" => "このサイトの楽しみ方", "width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
ﾌﾟﾛﾌｨｰﾙ登録が完了いたしました｡次回からは自動ﾛｸﾞｲﾝとなります｡<br />
<span style="color:#cc0000">※登録ﾌﾟﾚｾﾞﾝﾄは育児なうﾄｯﾌﾟからﾀﾞｳﾝﾛｰﾄﾞできます。</span><br />
<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_orrange.gif", array()); ?></div>
まずはお子さんの思い出を記録してみよう!
ｹｰﾀｲに入っているお子さんのﾍﾞｽﾄｼｮｯﾄにｺﾒﾝﾄをつけてﾒｰﾙ<?php $this->Ktai->emoji(0xE6D3); ?>送信してみてね!<br />
<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_orrange.gif", array()); ?></div>

<span style="color:#ff6600;">&nbsp;･</span><span style="color:#339933">最初のﾃｰﾏ:ﾍﾞｽﾄｼｮｯﾄ</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
例を参考に思い出を残そう!<br />
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
<?php echo $this->Html->image("theme/theme_0.jpg", array("width" => "100%")); ?><br />
</td>
<td>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</td>
</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#ff6600;">&nbsp;･</span><span style="color:#339933">思い出記録</span>とは<br />
思い出記録は､他の会員に思い出を公開することができます｡<span style="color:#ff6600;">｢他の会員に公開して投稿する｣</span>を選択すると､約1週間後｢育児なう｣に掲載されます｡<br />
<span style="color:#cc0000;">※公開する｢思い出記録｣については､ﾍﾞﾈｯｾにて選定を行います｡</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
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
<!-- end: imodeの場合-->

<?php elseif($this->Ktai->is_softbank()): ?>
<!-- start: sbの場合-->
<span style="color:#006600; font-size:x-small;">⇒</span><a href="mailto:<?php echo $mailPublicStr ?>?subject=<?php echo rawurlencode(mb_convert_encoding($mailTitle, "utf8"));?>" style="color:#339900;"><span style="color:#339900; font-size:x-small;">わが子をみんなに大自慢!!</span></a><br />
<span style="font-size:x-small;">(他の会員に公開する)</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#006600; font-size:x-small;">⇒</span><a href="mailto:<?php echo $mailStr ?>?subject=<?php echo rawurlencode(mb_convert_encoding($mailTitle, "utf8"));?>" style="color:#339900;"><span style="color:#339900; font-size:x-small;">わが子を自分で自画自賛!!</span></a><br />
<span style="font-size:x-small;">(他の会員には見せない)</span><br />
<!-- end: sbの場合-->

<?php else: ?>
<!-- start: その他の場合-->
<span style="color:#006600; font-size:x-small;">⇒</span><span style="color:#339900; font-size:x-small;"><?php $this->Ktai->mailto("わが子をみんなに大自慢!!",$mailPublicStr,$mailTitle); ?></span><br />
<span style="font-size:x-small;">(他の会員に公開する)</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#006600; font-size:x-small;">⇒</span><span style="color:#339900; font-size:x-small;"><?php $this->Ktai->mailto("わが子を自分で自画自賛!!",$mailStr,$mailTitle); ?></span><br />
<span style="font-size:x-small;">(他の会員には見せない)</span><br />
<!-- end: その他の場合-->
<?php endif; ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></td>
</tr>
</table>

<div align="right" style="text-align:right;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<a href="<?php echo $this->Html->url('/diaries/publish/'); ?>" style="color:#ff0000;"><span style="color:#ff0000;font-size:x-small;">※公開に関する注意事項</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#cc0000">※写真を添付して､本文にｺﾒﾝﾄを書いて送信してください｡<br /></span>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#cc0000">※絵文字･ﾃﾞｺﾒ絵文字･一部の記号はご利用できません｡<br /></span>
<span style="color:#666666">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
※写真はJPG形式で容量が2MB以内､1枚のみとなります｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
※ﾀｲﾄﾙは自由に変更できます｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
※送信した写真ﾃﾞｰﾀはNTTﾄﾞｺﾓのｻｰﾊﾞで管理します｡<br />

<br />
<div align="center" style="text-align:center;">↓送信後は､こちらで確認↓</div>
<div align="center" style="background:#ffff99; text-align:center;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#339900; font-size:medium"><span style="color:#006600;">②</span><a href="<?php echo $this->Html->url('/navigations/after2/'.$nexthash); ?>" style="color:#339900;"><span style="color:#339900;">思い出記録を確認する</span></a></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_orrange.gif", array()); ?></div>

今は送信しないで<a href="<?php echo $this->Html->url('/');?>">育児なうﾄｯﾌﾟ</a>へ進む<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />


