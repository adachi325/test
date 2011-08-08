<?php echo $this->Html->image("sp_img/newheader.png", array("width" => "100%", "alt" => "しまじろうひろば×ドコモコミュニティ", "class" => "bottom")); ?>
<?php echo $this->Html->image("sp_img/newheader_shadow.png", array("width" => "100%", "alt" => "しまじろうひろば×ドコモコミュニティ", "class" => "shadow")); ?>

<?php $path = sprintf(Configure::read('Present.path.wallpaper_output_for_smartphone'), $token); ?>

<div class="container">

<div id="main">
<h2>待受画像ダウンロード</h2>
<div style="text-align:center;"><?php echo $this->Html->image('/'.$path, array("alt" => "待受画像")); ?></div>
<p>上の待受画像を保存し、壁紙に設定してください<br /></p>
</div>

