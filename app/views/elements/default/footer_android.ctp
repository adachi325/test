
<!-- #footer -->

<div id="footWrap">

<?php if (!$this->tk->is_appli()): ?>
<div id="footText">
<?php if (! (($this->params['controller'] == 'pages') && ($this->params['action'] == 'display')) ) : ?>
<div class="white_btn"><a href="<?php echo $this->Html->url('/'); ?>" ><?php echo $this->Html->image("sp_img/bt_white_top.png", array("alt" => "トップページへもどる")); ?></a></div>
<?php endif; ?>

<ul>
  <li><a href="<?php echo $this->Html->url('/pages/list_models/'); ?>" rel="external">対応機種</a></li>
<!--  <li><a href="<?php echo $this->Html->url('/pages/charges/'); ?>" rel="external">通信料の目安</a></li> -->
  <li><a href="<?php echo $this->Html->url('/pages/help/'); ?>" rel="external">よくある質問・問い合わせ</a></li>
  <li><a href="<?php echo $this->Html->url('/pages/rules/'); ?>" rel="external">利用規約</a></li>
</ul>
<p>このサービスはベネッセコーポレーションとNTTドコモの共同で提供しています</p></div>
<div id="copy">
(C)<a href="http://www.benesse.co.jp/">Benesse Corporation</a><br>
&amp;(C) NTT DOCOMO
</div>
<?php endif; ?>

<?php echo $this->Html->image("sp_img/main_bg_under.png", array("width" => "100%", "class" => "bottom")); ?></div><!--
--><?php echo $this->Html->image("sp_img/footer.png", array("width" => "100%")); ?>
<!-- /#footer -->

