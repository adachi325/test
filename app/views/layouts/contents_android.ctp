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

<div style="position: fixed; width: 100%; z-index: 9999;">
<?php if ($this->tk->is_appli()): ?>
<div class="kochare_btn">
<a href="<?php echo $this->Html->url('/'); ?>"><?php echo $this->Html->image('sp_img/bt_kochare.png', array('width'=>'102','alt'=>'戻る')); ?></a>
</div>
<?php endif; ?>
<div id="ttl">
<h2>教材説明</h2>
<?php echo $this->Html->image('sp_img/kochare_shimajiro.png', array('width'=>'49','alt'=>'しまじろう', 'class' => 'chara')); ?></div>
<?php echo $this->Html->image('sp_img/header_kochare_shadow.png', array('width'=>'100%', 'class' => 'shadow')); ?>
</div>

<!-- #promo -->
<div id="promo">   
<?php if (!$this->tk->is_appli()): ?>
<div id="top_promobtn">
<a href="<?php echo $this->Html->url('/pages/appli')?>" data-transition="slide"><h1>Androidアプリ リリース！</h1><?php echo $this->Html->image('sp_img/kochare_appli.png', array('alt'=>'', 'width' => '80', 'height' => '80', 'align' => 'middle')); ?><p><こどもちゃれんじ>の年齢別コンテンツやお子さんの成長を素敵に残せる思い出記録など、親子で楽しめる<span class="red">無料</span>のアプリ♪</p></a></div>
<div class="tape"><?php echo $this->Html->image('sp_img/bgpink_tape.png', array('width'=>'100%', 'class' => 'bottom')); ?></div>  
<?php endif; ?>
</div>
<!-- /#promo -->  

<?php echo $content_for_layout; ?>

<?php echo $this->element('footer_android'); ?>

<?php echo $this->element('google/analytics'); ?>

</div>
</body> 
</html> 
