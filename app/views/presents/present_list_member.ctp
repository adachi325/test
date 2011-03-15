<?php 
if (!isset($type_name)) {
	$type_name = '会員限定コンテンツ';
}
?>

<div class="presents view">
<h2><?php  __('Present');?></h2>

<p>会員登録ありがとう♪</p>
<p><?php echo $type_name; ?>をダウンロードして使ってね</p>

<?php foreach($items as $item): ?>
<?php echo $this->Html->image($item['Present']['present_thumbnail_path'], array('alt' => $type_name)); ?>
<?php endforeach; ?>

</div>
