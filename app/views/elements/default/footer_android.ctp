
<!-- footer -->
<div id="footWrap">
<div id="footText">

<?php if (! (($this->params['controller'] == 'pages') && ($this->params['action'] == 'display')) ) : ?>
<div id="btnTop"><a href="<?php echo $this->Html->url('/'); ?>" data-role="button" data-icon="arrow-u" rel="external">トップページへ戻る</a></div>
<?php endif; ?>

<ul>
<li><a href="<?php echo $this->Html->url('/pages/list_models/'); ?>" rel="external">対応機種</a></li>
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

