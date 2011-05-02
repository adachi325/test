<?php 
if (!isset($max_count)) {
	$max_count = 4;
}

if ($max_count == 4) {
	$text = 'ﾎﾟｽﾄｶｰﾄﾞ作成';
} else {
	$text = '待受Flash作成';
}
$page = isset($this->params['paging']['Diary']['page']) ? $this->params['paging']['Diary']['page'] : 1;
$pageCount = isset($this->params['paging']['Diary']['pageCount']) ? $this->params['paging']['Diary']['pageCount'] : 1;

?>

<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<div style="text-align:left;" align="center">
<span style="color:#339933;">&nbsp;･</span><?php echo $text; ?><br />
</div>
投稿写真から<?php echo $max_count; ?>枚選んで､｢作成する｣ﾎﾞﾀﾝを押してください｡<br />
<span style="color:#666666">※au,ｿﾌﾄﾊﾞﾝｸご利用の方は同一ﾍﾟｰｼﾞから<?php echo $max_count; ?>枚の写真を選択するようお願いいたします｡</span><br />
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<?php echo $this->Form->create('Present' , array('url' => "/presents/select/{$type}/{$template_id}/?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<?php echo $this->Form->hidden('page', array('value' => $page)); ?>
<?php echo $this->Form->hidden('pageCount', array('value' => $pageCount)); ?>
<?php echo $this->Form->hidden('template', array('value' => $template_id)); ?>

<div style="text-align:center;" align="center">
<?php echo $paginator->counter(array('format' => '全%count%件 %start%件～%end%件を表示')); ?>
</div>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<table cellpadding="0" cellspacing="0" width="100%">


<?php for($i = 0; $i < count($items);  $i++): ?>
<?php extract($items[$i]['Diary']); ?>
<tr>
<td width="5%"><?php echo $this->Form->input("select_photo.{$id}", array("type" => "checkbox")); ?></td>
<td width="45%" align="center">
<?php echo $this->Html->image(sprintf(Configure::read('Diary.image_path_rect'), $items[$i]['Diary']['child_id'], $items[$i]['Diary']['id']), array("style" => "margin:5px 0;")); ?>
</td>

<?php $i++; ?>
<?php if (isset($items[$i])): ?>
<?php extract($items[$i]['Diary']); ?>
<td width="5%"><?php echo $this->Form->input("select_photo.{$id}", array("type" => "checkbox")); ?></td>
<td width="45%" align="center">
<?php echo $this->Html->image(sprintf(Configure::read('Diary.image_path_rect'), $items[$i]['Diary']['child_id'], $items[$i]['Diary']['id']), array("style" => "margin:5px 0;")); ?>
</td>
<?php else: ?>
<td width="5%"></td>
<td width="45%" align="center"></td>
<?php endif; ?>
</tr>
<?php endfor; ?>

</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left"><span style="font-size:x-small">
<?php if ($this->Paginator->hasPrev()): ?>

<?php if ($this->Ktai->is_imode()): ?>
<?php echo $this->Form->submit('前へ', array('div' => false, 'label' => false, 'name' => 'prev')); ?>
<?php else: ?>
<?php echo $this->Paginator->prev('<span style="font-size:x-small; color:#339900;">前へ</span>', array('style' => 'color:#339900;', 'escape' => false)); ?>
<?php endif; ?>

<?php endif; ?>

</span></td>
<td align="right"><span style="font-size:x-small">
<?php if ($this->Paginator->hasNext()): ?>

<?php if ($this->Ktai->is_imode()): ?>
<?php echo $this->Form->submit('次へ', array('div' => false, 'label' => false, 'name' => 'next')); ?>
<?php else: ?>
<?php echo $this->Paginator->next('<span style="font-size:x-small; color:#339900;">次へ</span>', array('style' => 'color:#339900;', 'escape' => false)); ?>
<?php endif; ?>

<?php endif; ?>
</span></td>
</tr>

<tr>
<td align="center" colspan="2">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php echo $this->Form->submit('作成する', array('div' => false, 'label' => false, 'name' => 'create')); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</td>
</table>
<?php echo $this->Form->end(); ?>


