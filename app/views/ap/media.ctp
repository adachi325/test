<?php
$path = (isset($filepath)) ? $filepath : "nocontents.html";
$path = $path;

echo file_get_contents("{$path}", true);
?>
