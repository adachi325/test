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
<?php if (!$this->tk->is_appli()): ?>
<?php echo $this->element('default/footer_android'); ?>
<?php endif; ?>
</div>
<?php echo $this->element('google/analytics'); ?>
</body>
</html>

