<!DOCTYPE HTML>
<html lang="ja_JP">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">

<?php
echo $this->Html->css('android_reset.css');
echo $this->Html->css('android_style.css');
echo $this->Html->css('http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css');

echo $this->Html->Script('http://code.jquery.com/jquery-1.4.3.min.js');
echo $this->Html->Script('http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js');
?>

<title>こどもちゃれんじ｜ケータイしまじろうひろば&times;ドコモコミュニティ</title>
</head>

<body id="challenge">
<div id="wrap" data-role="page" data-theme="d">
<h2><?php echo $this->Html->image("ttl_kodomo.png", array("alt" => "こどもちゃれんじ", "width" => "108", "height" => "20")); ?></h2>
<!-- main -->
<div id="main">

※Androidには対応していません。 
  
</div>
<!-- /main -->

<!-- footer -->
<div id="footWrap">
<div id="footText">
<div id="btnTop"><a href="<?php echo $this->Html->url('/'); ?>" data-role="button" data-icon="arrow-u" rel="external">トップページへ戻る</a></div>
<ul>
<li><a href="<?php echo $this->Html->url('/pages/list_models/'); ?>" rel="external">対応機種</a></li>
<li><a href="<?php echo $this->Html->url('/pages/charges/'); ?>" rel="external">通信料の目安</a></li>
  <li><a href="<?php echo $this->Html->url('/pages/help/'); ?>" rel="external">よくある質問・問い合わせ</a></li>
  <li><a href="<?php echo $this->Html->url('/pages/rules/'); ?>" rel="external">利用規約</a></li>
</ul>
<p>このサービスはベネッセコーポレーションと<br>
  NTTドコモの共同で提供しています</p></div>
<div id="copy">
(C)<a href="http://www.benesse.co.jp/">Benesse Corporation</a><br>
&amp;(C) NTT DOCOMO
</div>
</div>
<!-- footer -->

</div>
</body>
</html>
