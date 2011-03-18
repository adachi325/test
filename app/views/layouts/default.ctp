<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->element('default/head') ?>
</head>

<body>

<?php $ktai->font(); ?>
<?php if(!$ktai->is_ktai()) { ?><div style="width: 240px;"><?php } ?>

<div id="header">
	<?php echo $this->element('default/header'); ?>
</div>

<?php echo $content_for_layout; ?>

<div id="footer">
	<?php echo $this->element('default/footer'); ?>
	<?php echo $this->element('default/copyright'); ?>
</div>

<?php if(!$ktai->is_ktai()) { ?></div><?php } ?>
<?php $ktai->fontend(); ?>

</body>
</html>
