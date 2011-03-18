<div class="presents index">

<?php
$year = (isset($year)) ? $year : date('Y');
$month = (isset($month)) ? $month : date('n');
$date = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));

$next = date("Y-m-d", strtotime("-1 month", strtotime($date)));
$prev = date("Y/m/d",strtotime("+1 month" ,strtotime($date)));
?>

<h2><?php __('Presents');?></h2>
<p>思い出を投稿すると、毎月素敵なプレゼントがもらえます♪</p>

<h3><?php echo $month; ?>月のプレゼント一覧</h3>

<dl>
<?php 
$present_types = Configure::read('Present.type');
foreach($present_types as $key => $value):
?>

<?php if (isset($presents[$key])): ?>
<dt>★<?php echo $key +1; ?>回投稿で<?php echo $value; ?>がもらえる♪</dt>
<dd>
<?php echo $this->Html->image($presents[$key]['Present']['present_thumbnail_path'], array('alt'=>$value)); ?>
</dd>
<?php endif; ?>

<?php endforeach; ?>
<dl>
<?php echo $this->Html->link('前の月', array('action' => 'index', date('Y/m', strtotime($prev)).'/' )); ?>
<?php echo $this->Html->link('次の月', array('action' => 'index', date('Y/m', strtotime($next)).'/' )); ?>


<h3>テーマに投稿してプレゼントをもらおう</h3>
<ul>
<li><?php echo $this->Html->link('デコメ絵文字', "/presents/present_list/1"); ?></li>
<li><?php echo $this->Html->link('待受FLASH', "/presents/present_list/2"); ?></li>
<li><?php echo $this->Html->link('ポストカード', "/presents/present_list/3"); ?></li>
<li><?php echo $this->Html->link('会員限定', "/presents/present_list/-1"); ?></li>
</ul>

<p>
<?php echo $this->Html->link("{$month}月の思い出テーマ一覧", array('controller' => 'themes', 'action' => 'index')); ?>
</p>

</div>
