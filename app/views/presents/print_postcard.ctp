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
<h2>ポストカード印刷</h2>
<p><?php echo $this->Html->image('/'.$path, array("width" => "283px", "height" => "420px", "alt" => "ポストカード")); ?></p>
<p>上のポストカード画像をパソコンに保存し、お持ちのプリンターで印刷してください。<br />
<b>【用意するもの】プリンター、はがき</b></p>
</div>

<div class="description">
<h2>・Windowsの方</h2>
<ol>
<li>画像を右クリックし、「名前を付けて画像を保存」を選択します。</li>
<li>保存したファイルを右クリックし、「印刷」を選択してください。</li>
<li>プリンターの設定において、用紙サイズを｢はがき｣にし｢カラー｣を選択してください｡</li>
<li>プリントしてください。</li>
</ol>

<h2>・Macintoshの方</h2>
<ol>
<li>Ctrl+クリックし、「イメージを別名で保存」を選択します。</li>
<li>保存したファイルを開き、「ファイル」>「印刷」を選択してください。</li>
<li>プリンターの設定において､用紙サイズを｢はがき｣にし｢カラー｣を選択してください｡</li>
<li>プリントしてください。</li>
</ol>
<p>
※プリンターの設定は、各種プリンターのマニュアルを参考にしてください｡<br />
※画像は用紙サイズに合わせて自動的に縮小するか、倍率を「50％」に設定してください。
</p>
</div>
<?php echo $this->Html->image("pc_footer.gif", array("width" => "800", "height" => "117", "alt" => "ケータイしまじろうひろば×ドコモコミュニティ")); ?>
<div class="footer">
(c) Benesse Corporation &amp; (c) NTT DOCOMO<br />
</div>
</div>
</body>
</html>

