<div class="presents index">

<h2><?php __('Presents');?></h2>
<p>思い出を投稿すると、毎月素敵なプレゼントがもらえます♪</p>

<h3><?php echo date('n'); ?>月のプレゼント一覧</h3>

<dl>
<?php 
$present_types = Configure::read('Present.type');
foreach($present_types as $key => $value):
?>

<?php if (isset($month[$value])): ?>
<dt>★<?php echo $value +1; ?>回投稿で<?php echo $key; ?>がもらえる♪</dt>
<dd>
<?php echo $this->Html->image($month[$value]['Present']['present_thumbnail_path'], array('alt'=>$key)); ?>
</dd>
<?php endif; ?>

<?php endforeach;?>
<dl>


<h3>テーマに投稿してプレゼントをもらおう</h3>
<ul>
<li><?php echo $this->Html->link('デコメ絵文字', "/presents/present_list/0"); ?></li>
<li><?php echo $this->Html->link('待受FLASH', "/presents/present_list/1"); ?></li>
<li><?php echo $this->Html->link('ポストカード', "/presents/present_list/2"); ?></li>
<li><?php echo $this->Html->link('会員限定', "/presents/present_list/-1"); ?></li>
</ul>

<p>
<?php echo $this->Html->link('今月の思い出テーマ一覧', array('controller' => 'themes', 'action' => 'index')); ?>
</p>

</div>
