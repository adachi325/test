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

<?php $skip = true; ?>
<?php foreach($present_types as $key => $value): ?>

<?php 
	// 最初の一回だけ飛ばす
	if($skip) {
		$skip = false;
		continue;
	}
?>

<li><?php echo $this->Html->link($key, "/presents/present_list/{$value}"); ?>

<?php endforeach; ?>

</ul>
<ul>

<?php 
$members = Configure::read('Present.membersonly');
foreach($members as $key => $value):
?>
<li><?php echo $this->Html->link($key, "/presents/present_list/{$value}"); ?></li>

<?php endforeach; ?>

</ul>

</div>
