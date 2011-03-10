<div class="contents view">

<?php
$path = (isset($filepath)) ? $filepath : "nocontents.html";

$contents = file_get_contents("{$path}", true);

// todo:convert media specific tag 

echo $contents;
?>

</div>
