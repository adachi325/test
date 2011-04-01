<?php echo $this->Xml->header(array('encoding' => 'Shift_JIS'));?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<?php
echo $this->element('default/meta');
?>

<title><?php echo $title_for_layout; ?></title>

</head>

<body>
<a name="top" id="top"></a>

<div align="center" style="text-align:center;">
<div style="width:240px; font-size:x-small; text-align:left;">

<?php echo $content_for_layout; ?>

<?php echo $this->element('default/footer'); ?>
<?php echo $this->element('default/copyright'); ?>

</div>
</div>

</body>
</html>

