<div class="contents view">

<?php
$path = (isset($filepath)) ? $filepath : "nocontents.html";

$contents = file_get_contents("{$path}", true);

echo $contents;
?>

<?php
$user = $this->Session->read('Auth.User');
if (!$user['dc_user']) {
	
}
?>

</div>
