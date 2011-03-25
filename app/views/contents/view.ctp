<div class="contents view">

<?php

$path = (isset($filepath)) ? $filepath : "nocontents.html";

$contents = file_get_contents("{$path}", true);

echo $contents;
?>

<?php if (!$this->Ktai->is_android()): ?>

<?php
$user = $this->Session->read('Auth.User');
if (!$user['dc_user']) {
	echo $this->element('invitation');
} else {
	echo $this->Html->link('トップページへ', '/');
}

?>

<?php endif; ?>

</div>
