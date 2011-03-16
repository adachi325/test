<div class="presents view">

<?php $this->Html->script('print.js'); ?>

<?php $path = sprintf(Configure::read('Present.path.postcard_output'), $token); ?>

<?php echo $this->Html->image($path, array('alt'=>'altText')); ?>

<p>
以下の印刷ボタンを押し、ブラウザの印刷機能よりポストカードをプリントアウトしてください。
</p>

<input type="button" onclick="newopen('<?php echo $path; ?>')" value="このページを印刷する">

</div>
