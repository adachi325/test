<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ポストカード印刷</title>
<?php echo $this->Html->css('311.css'); ?>
</head>

<body>

<?php $path = sprintf(Configure::read('Present.path.postcard_output'), $token); ?>

<div class="container">
<h1>
<?php echo $this->Html->image("pc_logo.gif", array("width" => "471px", "height" => "118px", "alt" => "ケータイしまじろうひろば×ドコモコミュニティ")); ?>
</h1>
<div class="box">
<p>
<span class="warning">ポストカードのURLの有効期限は3日のため、有効期限が切れております。</span>
お手数ですが、再度携帯電話側からポストカードを作成し、URLを再発行してください。
</p>
</div>

<?php echo $this->Html->image("pc_footer.gif", array("width" => "800", "height" => "117", "alt" => "ケータイしまじろうひろば×ドコモコミュニティ")); ?>
<div class="footer">
(c) Benesse Corporation &amp; (c) NTT DOCOMO<br />
</div>
</div>
</body>
</html>

