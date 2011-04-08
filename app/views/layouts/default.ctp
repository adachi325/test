<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<?php
echo $this->element('default/meta');
?>

<title><?php echo "しまじろうひろばxﾄﾞｺﾓｺﾐｭﾆﾃｨ"; //$title_for_layout; ?></title>

</head>

<body>
<a name="top" id="top"></a>
<div style="font-size:x-small; color:#333333;">

<?php echo $this->Session->flash(); ?>

<?php echo $content_for_layout; ?>

<?php echo $this->element('default/footer'); ?>

</div>

</body>
</html>

