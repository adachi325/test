<div class="presents view">

<?php $path = sprintf(Configure::read('Present.path.postcard_output'), $token); ?>

<p>
ポストカードを作成しました。
</p>
<?php echo $this->Html->image($path, array('alt'=>'altText')); ?>
<?php if($this->Ktai->is_imode() and !$this->tk->is_imode_browser()){ ?>
<a href="mailto:?subject=<?php echo urlencode(mb_convert_encoding($mailSubject, "utf8"));?>&body=<?php echo urlencode(mb_convert_encoding($mailBody, "utf8"));?>">印刷用URLをメールで送信</a>
<?php } else { ?>
<?php $this->Ktai->mailto("印刷用URLをメールで送信",'',$mailSubject,$mailBody); ?>
<?php } ?>
<p>
印刷用URLにアクセスし、ブラウザの印刷機能でプリントアウトしてください。なお、URLの有効期限は発行から3日間です。
</p>

<?php echo $this->Html->link('ポストカードを作り直す', array('/')); ?>

</div>
