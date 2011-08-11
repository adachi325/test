
<?php echo $this->Html->image("sp_img/newheader.png", array("width" => "100%", "alt" => "しまじろうひろば×ドコモコミュニティ", "class" => "bottom")); ?>
<?php echo $this->Html->image("sp_img/newheader_shadow.png", array("width" => "100%", "alt" => "しまじろうひろば×ドコモコミュニティ", "class" => "shadow")); ?><!-- #promo -->

<?php if (strtotime(date('Y-m-d H:i:s')) >= strtotime('2011-08-12 17:00:00')): ?>

<div id="top_promo">
  <div id="top_intro">
    <?php echo $this->Html->image("sp_img/release.png", array("width" => "100%", "alt" => "Androidアプリリリース！")); ?>
    <p><こどもちゃれんじ>の年齢別コンテンツやお子さんの成長を素敵に残せる思い出記録など、親子で楽しめる<span class="red">無料</span>のアプリです♪</p>
  </div>
  <div class="headintrobtn">
    <div class="green_btn"><a href="#" ><?php echo $this->Html->image("sp_img/bt_green_download2.png", array("alt" => "ダウンロード")); ?></a></div>
  </div>
  <div class="tape"><?php echo $this->Html->image("sp_img/bgltgreen_tape.png", array("width" => "100%", "class" => "bottom")); ?></div>  
</div>
<!-- /#promo -->  
  
<!-- #main -->
<div id="main">

  <div class="enjoy2">
    <p><?php echo $this->Html->image("sp_img/yellow_flower.png", array("alt" => "", "width" => "14", "height" => "14", "align" => "middle")); ?>こんなコンテンツが楽しめるよ！<?php echo $this->Html->image("sp_img/yellow_flower.png", array("alt" => "", "width" => "14", "height" => "14", "align" => "middle")); ?></p></div>
<dl id="intro">
<dt><?php echo $this->Html->image("sp_img/kochareimg.png", array("alt" => "", "width" => "95", "height" => "95", "align" => "middle")); ?></dt>
<dd class="kodomocharenge">こどもちゃれんじ</dd>
<dd class="content">お子さんの年齢に合った教材コンテンツがお楽しみいただけます！</dd>
<?php echo $this->Html->image("sp_img/line_green.png", array("width" => "100%")); ?>
<dt><?php echo $this->Html->image("sp_img/omoideimg.png", array("alt" => "", "width" => "95", "height" => "95", "align" => "middle")); ?></dt>
<dd class="omoidekiroku">思い出記録</dd>
<dd class="content">お子さんの成長をかわいく残せる！待受やポストカードも作れるよ☆</dd>
<?php echo $this->Html->image("sp_img/line_green.png", array("width" => "100%")); ?>
<dt><?php echo $this->Html->image("sp_img/ikujinowimg.png", array("alt" => "", "width" => "95", "height" => "95", "align" => "middle")); ?></dt>
<dd class="ikujinow">育児なう</dd>
<dd class="content">お友達の様子や育児に関するニュース、心理テストなどを随時配信中！</dd>
</dl>

<div class="introbtn">
 <div class="green_btn"><?php echo $this->Html->image("sp_img/appliwo.png", array("alt" => "しまじろうひろば×ドコモコミュニティアプリを", "width" => "100%")); ?><a href="#" ><?php echo $this->Html->image("sp_img/bt_green_download2.png", array("alt" => "ダウンロード")); ?></a></div>
</div>
</div>
<!-- /#main -->

<?php else: ?>

  <div id="top_promo">
  <div id="top_intro">
  <?php echo $this->Html->image("sp_img/release0.png", array("width" => "100%", "alt" => "Androidアプリについて！")); ?>

    <p><こどもちゃれんじ>の年齢別コンテンツやお子さんの成長を素敵に残せる思い出記録など、親子で楽しめる<span class="red">無料</span>のアプリです♪</p>
    </div>
<div class="tape"><?php echo $this->Html->image("sp_img/bgltgreen_tape.png", array("width" => "100%", "class" => "bottom")); ?></div>  
  </div>
<!-- /#promo -->  
  
<!-- 教材#main -->
<div id="main">
  <div class="enjoy2">
    <p><?php echo $this->Html->image("sp_img/yellow_flower.png", array("alt" => "", "width" => "14", "height" => "14", "align" => "middle")); ?>こんなコンテンツが楽しめるよ！<?php echo $this->Html->image("sp_img/yellow_flower.png", array("alt" => "", "width" => "14", "height" => "14", "align" => "middle")); ?></p></div>
<dl id="intro">
<dt><?php echo $this->Html->image("sp_img/kochareimg.png", array("alt" => "", "width" => "95", "height" => "95", "align" => "middle")); ?></dt>
<dd class="kodomocharenge">こどもちゃれんじ</dd>
<dd class="content">お子さんの年齢に合った教材コンテンツがお楽しみいただけます！</dd>
<?php echo $this->Html->image("sp_img/line_green.png", array("width" => "100%")); ?>
<dt><?php echo $this->Html->image("sp_img/omoideimg.png", array("alt" => "", "width" => "95", "height" => "95", "align" => "middle")); ?></dt>
<dd class="omoidekiroku">思い出記録</dd>
<dd class="content">お子さんの成長をかわいく残せる！待受やポストカードも作れるよ☆</dd>
<?php echo $this->Html->image("sp_img/line_green.png", array("width" => "100%")); ?>
<dt><?php echo $this->Html->image("sp_img/ikujinowimg.png", array("alt" => "", "width" => "95", "height" => "95", "align" => "middle")); ?></dt>
<dd class="ikujinow">育児なう</dd>
<dd class="content">お友達の様子や育児に関するニュース、心理テストなどを随時配信中！</dd>
</dl>

<div class="introbtn">
<?php echo $this->Html->image("sp_img/dlstart0.png", array("alt" => "しまじろうひろば×ドコモコミュニティアプリ近日リリース予定！", "width" => "100%")); ?>
</div>
</div>
<!-- /#main -->

<?php endif; ?>
