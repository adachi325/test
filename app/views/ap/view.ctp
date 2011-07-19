<a name="top" id="top"></a><?php

$path = (isset($filepath)) ? $filepath : "nocontents.html";

$contents = file_get_contents("{$path}", true);
$contents = mb_convert_encoding($contents, "UTF-8", "SJIS, sjis-win, EUC-JP, UTF-8");

echo $contents;
?>

<?php if (!$this->Ktai->is_android()): ?>

<?php
if (!(isset($has_account) && $has_account)) { 
	echo $this->element('invitation');
}
?>

<!-- ページトップへ -->
<img src="img/spacer.gif" width="1" height="10" /><br />
<div align="right" style="text-align:right;"><span style="font-size:x-small;"><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></span></div>
<br />

<?php 
echo $this->element('default/footer_ap');
?>
<?php else: ?>
<?php echo $this->element('default/footer_android'); ?>
<?php endif; ?>

