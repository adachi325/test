<!DOCTYPE HTML>
<html lang="ja_JP">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>しまじろうひろば×ドコモコミュニティ</title>
<?php echo $this->Html->css('android_reset.css'); ?>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.css" />
<script src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.js"></script>
<?php echo $this->Html->css('android_style.css'); ?>
</head>

<body>
<div id="wrap" data-role="page" data-theme="d">

<?php echo $content_for_layout; ?>

<?php echo $this->element('default/footer_android'); ?>

</div>
<?php echo $this->element('google/analytics'); ?>
</body>
</html>

