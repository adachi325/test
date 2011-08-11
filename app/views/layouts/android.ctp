<!DOCTYPE HTML>
<html lang="ja_JP">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>しまじろうひろば×ドコモコミュニティ</title>

<?php echo $this->element('default/jquery_mobile'); ?>

</head>

<body>
<div id="wrap" data-role="page" data-theme="d">

<?php echo $content_for_layout; ?>
<?php if (isset($hide_footer) and $hide_footer): ?>
<div id="footWrap">
<?php echo $this->Html->image("sp_img/main_bg_under.png", array("width" => "100%", "class" => "bottom")); ?></div><!--
--><?php echo $this->Html->image("sp_img/footer.png", array("width" => "100%")); ?>
<?php else: ?>
<?php echo $this->element('default/footer_android'); ?>
<?php endif; ?>
</div>
<?php echo $this->element('google/analytics'); ?>
</body>
</html>

