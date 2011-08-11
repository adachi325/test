
<?php if ($this->tk->is_appli()): ?>
<div style="position: fixed; width: 100%; z-index:9999;">
<div class="kochare_btn">
<a href="*back://*"><?php echo $this->Html->image('sp_img/bt_kochare.png', array('width'=>'102','alt'=>'戻る')); ?></a>
</div>
<div id="ttl">
<h2>教材一覧</h2>
<?php echo $this->Html->image('sp_img/kochare_shimajiro.png', array('width'=>'49','alt'=>'しまじろう', 'class' => 'chara')); ?></div>
<?php echo $this->Html->image('sp_img/header_kochare_shadow.png', array('width'=>'100%', 'class' => 'shadow')); ?>
</div>

<?php else: ?>

<?php echo $this->Html->image("sp_img/newheader.png", array("width" => "100%", "alt" => "しまじろうひろば×ドコモコミュニティ", "class" => "bottom")); ?>
<?php echo $this->Html->image("sp_img/newheader_shadow.png", array("width" => "100%", "alt" => "しまじろうひろば×ドコモコミュニティ", "class" => "shadow")); ?>

<!-- #promo -->
<div id="top_promo">   
<div id="top_promobtn">
   
<a href="<?php echo $this->Html->url('/pages/appli/')?>" data-transition="slide"><h1>Androidアプリ 近日公開</h1><?php echo $this->Html->image("sp_img/kochare_appli.png", array("alt" => "", "width" => "80", "height" => "80", "align" => "middle")); ?><p><こどもちゃれんじ>
の年齢別コンテンツやお子さんの成長を素敵に残せる思い出記録など、親子で楽しめる<span class="red">無料</span>のアプリ♪</p></a></div>
<div class="tape"><?php echo $this->Html->image("sp_img/bgltgreen_tape.png", array("width" => "100%", "class" => "bottom")); ?></div>  
</div>
<!-- /#promo -->  
<?php endif; ?>
  
<!-- 教材#main -->
<div id="main">
  <div class="enjoy"><p><?php echo $this->Html->image("sp_img/yellow_flower.png", array("alt" => "", "width" => "14", "height" => "14", "align" => "middle")); ?>こどもちゃれんじの教材を楽しむ！<?php echo $this->Html->image("sp_img/yellow_flower.png", array("alt" => "", "width" => "14", "height" => "14", "align" => "middle")); ?></p></div>
  <dl id="contents">
    <dt>
        <a name="baby"><?php echo $this->Html->image("sp_img/txt_baby.png", array("alt" => "こどもちゃれんじ baby", "width" => "100%")); ?></a><br /><span class="baby">0～1歳向けコース</span>
    </dt>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/baby/1007/');?>" data-role="button" data-theme="e" rel="external">【動画】特別教材・おでかけストラップの取りつけ方
</a>
    </dd>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/baby/1008/');?>" data-role="button" data-theme="e" rel="external">【Flash】赤ちゃんの夜泣きやぐずりに･･･｢眠くなる音｣
</a>
    </dd>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/baby/1010/');?>" data-role="button" data-theme="e" rel="external">【動画】「おにぎり たべちゃうぞ」の曲に合わせた遊び方 </a>
    </dd>
   <dd>
	<a href="<?php echo $this->Html->url('/ap/baby/1013/');?>" data-role="button" data-theme="e" rel="external">【Flash】育児ストレス解消??? 癒しの音声
</a>
    </dd>
   <dd>
	<a href="<?php echo $this->Html->url('/ap/baby/1014/');?>" data-role="button" data-theme="e" rel="external">【Flash】もぐもぐのテーマソング
</a>
    </dd>
        <dd>
	<a href="<?php echo $this->Html->url('/ap/baby/1015/');?>" data-role="button" data-theme="e" rel="external">【Flash】外出先でお役立ち!?ぐずり防止フラッシュ
</a>
    </dd>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/baby/1016/');?>" data-role="button" data-theme="e" rel="external">【動画】おうちでできるカンタンからだあそび動画</a>
    </dd>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/baby/1018/');?>" data-role="button" data-theme="e" rel="external">【動画】病気予防に効果大の手の洗い方動画＆手洗い歌</a>
    </dd>

    <dt>
    	<a name="first"><?php echo $this->Html->image("sp_img/txt_petitfirst.png", array("alt" => "こどもちゃれんじ ぷちファースト", "width" => "100%")); ?></a><br /><span class="baby">1歳前後向けコース</span>
    </dt>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit_f/1108/');?>" data-role="button" data-theme="e" rel="external">【Flash】しまじろうのはげましボイス</a>
    </dd>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit_f/1108_1/');?>" data-role="button" data-theme="e" rel="external">【動画】しまじろう3WAYホルダーの取り付け方</a>
    </dd>
    
    <dt>
    	<a name="petit"><?php echo $this->Html->image("sp_img/txt_petit.png", array("alt" => "こどもちゃれんじ ぷち", "width" => "100%")); ?></a><br /><span class="petit">1～2歳向けコース</span>
    </dt>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit/1104_8/');?>" data-role="button" data-theme="e" rel="external">【Flash】たべものおしゃべりパズルであそぼう！</a>
    </dd>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit/1104_9/');?>" data-role="button" data-theme="e" rel="external">【Flash】しまじろうといっぱいたべよう！</a>
    </dd>

<?php if (!$this->tk->is_appli()): ?>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit/1104_10/');?>" data-role="button" data-theme="e" rel="external">【動画】スプーンでぱっくんかみかみ</a>
    </dd>
<?php endif; ?>

    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit/1104_11/');?>" data-role="button" data-theme="e" rel="external">【Flash】いっしょにたべようおさそいボイス</a>
    </dd>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit/1104_12/');?>" data-role="button" data-theme="e" rel="external">【Flash】トントントイレ</a>
    </dd>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit/1104_13/');?>" data-role="button" data-theme="e" rel="external">【Flash】しまじろうとトイレに行こう！</a>
    </dd>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit/1104_14/');?>" data-role="button" data-theme="e" rel="external">【Flash】トイレでおしっこ</a>
    </dd>
<?php if (!$this->tk->is_appli()): ?>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit/1104_15/');?>" data-role="button" data-theme="e" rel="external">【動画】みんなでトイレ</a>
    </dd>
<?php endif; ?>
<?php if (!$this->tk->is_appli()): ?>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit/1104_16/');?>" data-role="button" data-theme="e" rel="external">【動画】トイレでおしっこできるかな</a>
    </dd>
<?php endif; ?>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit/1104_17/');?>" data-role="button" data-theme="e" rel="external">【Flash】トイレおさそいボイス</a>
    </dd>
    
    <dt>
    	<a name="pocket"><?php echo $this->Html->image("sp_img/txt_pocket.png", array("alt" => "こどもちゃれんじ ぽけっと", "width" => "100%")); ?></a><br /><span class="pocket">2～3歳向けコース</span>
    </dt>
    <dd>
    <a href="<?php echo $this->Html->url('/ap/pocket/1105/');?>" data-role="button" data-theme="e" rel="external">【Flash】どれをたべるのかな？はっけんゲーム</a>
    </dd>
    <dd>
    <a href="<?php echo $this->Html->url('/ap/pocket/1106/');?>" data-role="button" data-theme="e" rel="external">【Flash】はたらく くるま わかった！ クイズ</a>
    </dd>
    <dd>
    <a href="<?php echo $this->Html->url('/ap/pocket/1107/');?>" data-role="button" data-theme="e" rel="external">【Flash】まちたんけんゲーム</a>
    </dd>
    <dd>
    <a href="<?php echo $this->Html->url('/ap/pocket/1109/');?>" data-role="button" data-theme="e" rel="external">【Flash】すきな　たべもの　わかるかな？　どうぶつクイズ</a>
    </dd>
    
    
    <dt>
    	<a name="hop"><?php echo $this->Html->image("sp_img/txt_hop.png", array("alt" => "こどもちゃれんじ ほっぷ", " width" => "100%")); ?></a><br /><span class="hop">3～4歳向けコース</span>
    </dt>
<?php if (!$this->tk->is_appli()): ?>
    <dd>
    <a href="<?php echo $this->Html->url('/ap/hop/1106/');?>" data-role="button" data-theme="e" rel="external">【着うた】かずのドーナツやさんの歌</a>
    </dd>
<?php endif; ?>
    <dd>
    <a href="<?php echo $this->Html->url('/ap/hop/1106_1/');?>" data-role="button" data-theme="e" rel="external">【Flash】なつの いきもの ずかん</a>
    </dd>
    <dd>
    <a href="<?php echo $this->Html->url('/ap/hop/1107/');?>" data-role="button" data-theme="e" rel="external">【Flash】どんな かげかな？</a>
    </dd>
    <dd>
    <a href="<?php echo $this->Html->url('/ap/hop/1107_1/');?>" data-role="button" data-theme="e" rel="external">【Flash】のりものに のるとき おりるときの やくそく</a>
    </dd>
    <dd>
    <a href="<?php echo $this->Html->url('/ap/hop/1109/');?>" data-role="button" data-theme="e" rel="external">【Flash】でんしゃの　やくそく</a>
    </dd>
    
    <dt>
    	<a name="step"><?php echo $this->Html->image("sp_img/txt_step.png", array("alt" => "こどもちゃれんじ すてっぷ", " width" => "100%")); ?></a><br /><span class="step">4～5歳向けコース</span>
    </dt>
    <dd>
    <a href="<?php echo $this->Html->url('/ap/step/1105_1/');?>" data-role="button" data-theme="e" rel="external">【Flash】おてつだいたいに ほうこくしよう！＜NEW＞</a>
    </dd>
    
    <dt>
    	<a name="jump"><?php echo $this->Html->image("sp_img/txt_jump.png", array("alt" => "こどもちゃれんじ じゃんぷ", " width" => "100%")); ?></a><br /><span class="jump">5～6歳向けコース</span>
    </dt>
    <dd>
    ＜こどもちゃれんじじゃんぷ＞の教材連動コンテンツは、ＰＣサイトをご利用ください。
<?php
$url = "https://kodomo.benesse.ne.jp/jump/index.html";
if ($this->tk->is_appli()) {
    $url = "external://".$url;
}

?>
    <div class="jumplink">ＰＣサイトは<a href="<?php echo $url; ?>">こちら</a></div>
    </dd>

  </dl>
</div>
<!-- /#main -->
