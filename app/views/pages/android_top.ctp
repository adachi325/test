
<body id="top">
<div id="wrap" data-role="page" data-theme="d">
<div id="header">
  <img src="<?php echo $this->Html->image('img/logo.gif'); ?>" alt="ケータイしまじろうひろば×ドコモコミュニティ" width="320" height="83" />
</div>

<div id="main">
  <p>
   Android端末では、&lt;こどもちゃれんじ&gt;教材との連動コンテンツの一部がお楽しみいただけます。</p>
  <dl id="contents">
    <dt><?php echo $this->Html->image("icn_petit.gif", array()); ?><?php echo $this->Html->image("txt_petit.gif", array("alt" => "こどもちゃれんじ ぷち")); ?><br /><span class="petit">1～2歳向けコース</span></dt>
    <dd>
	<a href="<?php echo $this->Html->url('/ap/petit/1104_8/');?>" data-role="button" data-theme="e" rel="external">【Flash】たべものおしゃべりパズルであそぼう！</a>
    </dd>
    <dt><?php echo $this->Html->image("icn_pocket.gif", array()); ?><?php echo $this->Html->image("txt_pocket.gif", array("alt" => "こどもちゃれんじ ぽけっと")); ?><br /><span class="pocket">2～3歳向けコース</span></dt>
    <dd>
    <a href="<?php echo $this->Html->url('/ap/pocket/1105/');?>" data-role="button" data-theme="e" rel="external">【Flash】身近な生き物</a>
    </dd>
    <dt><?php echo $this->Html->image("icn_step.gif", array()); ?><?php echo $this->Html->image("txt_step.gif", array("alt" => "こどもちゃれんじ すてっぷ")); ?><br /><span class="step">4～5歳向けコース</span></dt>
    <dd>
    <a href="<?php echo $this->Html->url('/ap/step/1105_1/');?>" data-role="button" data-theme="e" rel="external">【Flash】おてつだいたいに ほうこくしよう!</a>
    </dd>
  </dl>
  <hr id="orangeDot">
  <p>なお、Android向けサービスは今後バージョンアップを予定しております。ご期待ください。</p>
</div>

