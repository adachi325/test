<!DOCTYPE HTML>
<html lang="ja_JP">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title><?php echo "しまじろうひろばxﾄﾞｺﾓｺﾐｭﾆﾃｨ"; //$title_for_layout; ?></title>

<?php echo $this->Html->css('android_style.css'); ?>
<?php echo $this->Html->css('android_reset.css'); ?>

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>
</head>

<body id="top">
<div id="wrap" data-role="page" data-theme="d">
<div id="header">
  <?php echo $this->Html->image("logo.gif", array("alt" => "ケータイしまじろうひろば×ドコモコミュニティ", "width" => "320", "height" => "83")); ?>
</div>

<?php echo $content_for_layout; ?>

<?php echo $this->element('default/footer_android'); ?>

</div>
</body>
</html>



