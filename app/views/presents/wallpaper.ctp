<?php echo $this->Html->image("sp_img/newheader.png", array("width" => "100%", "alt" => "しまじろうひろば×ドコモコミュニティ", "class" => "bottom")); ?>
<?php echo $this->Html->image("sp_img/newheader_shadow.png", array("width" => "100%", "alt" => "しまじろうひろば×ドコモコミュニティ", "class" => "shadow")); ?>

<?php $path = sprintf(Configure::read('Present.path.wallpaper_output_for_smartphone'), $token); ?>

<div class="container">

<div id="main">
<h2>待受画像ダウンロード</h2>
<div style="text-align:center;"><?php echo $this->Html->image('/'.$path, array("alt" => "待受画像", "width" => "100%")); ?></div>
<p>
1.上の画像を長押し、「画像を保存」を選択<br />
2.ホームボタンを押し、ホーム画面に戻る<br />
3.左下（端末によっては右下）のメニューボタンを押し、「壁紙」を選択<br />
3.ギャラリー（もしくはライブラリー）から保存した待受画面を選択<br />
</p>
</div>

