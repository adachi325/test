<div class="presents view">

<?php $path = sprintf(Configure::read('Present.path.postcard_output'), $token); ?>

<p>
ポストカードを作成しました。
</p>
<?php echo $this->Html->image($path, array('alt'=>'altText')); ?>

<?php echo $html->link("印刷用URLをメールで送信", "mailto:".$mailStr); ?>

<p>
印刷用URLにアクセスし、ブラウザの印刷機能でプリントアウトしてください。なお、URLの有効期限は発行から3日間です。
</p>

<?php echo $this->Html->link('ポストカードを作り直す', array('/')); ?>


</div>
