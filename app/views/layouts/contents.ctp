<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->element('default/meta') ?>
</head>

<body>

<div id="header">
	<?php echo $this->element('default/logo'); ?>
</div>

<?php echo $content_for_layout; ?>

<div id="footer">
	<?php echo $this->element('default/footer'); ?>
	<?php echo $this->element('default/copyright'); ?>
</div>

</body>
</html>
