<?php
	if(Configure::read('debug') == 0){
		echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	}
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" 
"http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<div id="header">
	<?php echo $this->element('default/header') ?>
</div>
</head>
<body>
<?php $ktai->font(); ?>
<?php if(!$ktai->is_ktai()){ ?><div style="width: 240px;"><?php } ?>
<?php echo $content_for_layout; ?>
<div id="footer">
	<?php echo $this->element('default/footer') ?>
</div>
<?php if(!$ktai->is_ktai()){ ?></div><?php } ?>
<?php $ktai->fontend(); ?>
</body>
</html>