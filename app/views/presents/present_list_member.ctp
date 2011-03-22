<?php 
if (!isset($type_name)) {
	$type_name = '会員限定コンテンツ';
}
?>

<div class="presents view">
<h2><?php  __('Present');?></h2>

<?php if (count($items)): ?>

<p>会員登録ありがとう♪</p>
<p>好きなゲームで遊んでね。</p>

<h3>対象年齢：０−３歳</h3>
<ul>
<li>
<?php echo $this->Html->image('/files/member_flash/pingpong-hello/200907_pingpong-hello_thumb.jpg', array('alt' => '')); ?>
<?php echo $this->Html->link('ピンポン', '/files/member_flash/pingpong-hello/200907_pingpong-hello.swf'); ?>

</li>
<li>
<?php echo $this->Html->image('/files/member_flash/one_button/one_button_game_thumb.jpg', array('alt' => '')); ?>
<?php echo $this->Html->link('ワンボタン', '/files/member_flash/one_button/one_button_game.swf'); ?>
</li>
</ul>

<h3>対象年齢：４−６歳</h3>
<ul>
<li>
<?php echo $this->Html->image('/files/member_flash/lunch/200906_lunch_thumb.jpg', array('alt' => '')); ?>
<?php echo $this->Html->link('ランチゲット', '/files/lunch/200906_lunch.swf'); ?>
</li>
<li>
<?php echo $this->Html->image('/files/member_flash/memorygame/memory_thumb.jpg', array('alt' => '')); ?>
<?php echo $this->Html->link('メモリーゲーム', '/files/memorygame/memory.swf'); ?>
</li>
</ul>


<?php else: ?>
<p><?php echo $type_name; ?>は登録されていません</p>
<?php endif; ?>

</div>
