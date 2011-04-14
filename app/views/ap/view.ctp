<div class="contents view">

<?php

$path = (isset($filepath)) ? $filepath : "nocontents.html";

$contents = file_get_contents("{$path}", true);
$contents = mb_convert_encoding($contents, "UTF-8", "SJIS, sjis-win, EUC-JP, UTF-8");

echo $contents;
?>

<?php if (!$this->Ktai->is_android()): ?>

<?php
$user = $this->Session->read('Auth.User');
if (!$user['dc_user']) {
	echo $this->element('invitation');
}
echo $this->element('default/footer_ap');
?>
<?php else: ?>
<?php echo $this->element('default/footer_android'); ?>
<?php endif; ?>

</div>

