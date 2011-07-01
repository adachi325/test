<a name="top" id="top"></a>
<div style="font-size:x-small; color:#333333;">
<?php echo $this->Html->image("pagetitle_ikujinau.gif", array("alt" => "育児なう", "width" => "100%", "border" => "0")); ?><br />


<?php echo $this->element('timeline/categories'); ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />

<!-- timeline -->
<?php echo $this->element('timeline/items'); ?>


<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_yellow.gif", array()); ?></div>

<table width="100%" border="0">
<tr>

<td width="50%" align="left">

<?php
// リンクのフィルタ設定
$filter = isset($this->params['pass'][0]) ? $this->params['pass'][0] . '/' : '';
?>
<?php if ($paginator->hasPrev()) : ?>
<?php $page = $paginator->current() - 1; ?>
<a href="<?php echo $this->Html->url('/articles/timeline/' . $filter . 'page:' . $page . '?guid=ON&' . session_name() . '=' . session_id()); ?>" style="color:#ff9900"><span style="font-size:x-small; color:#ff9900;">前のﾍﾟｰｼﾞ</span></a>
<?php else : ?>
<span style="font-size:x-small; color:#666666;">前のﾍﾟｰｼﾞ</span>
<?php endif; ?>

</td>

<td width="50%" align="right">
<span style="font-size:x-small;">
<?php if ($paginator->hasNext()) : ?>
<?php $page = $paginator->current() + 1; ?>
<a href="<?php echo $this->Html->url('/articles/timeline/' . $filter . 'page:' . $page . '?guid=ON&' . session_name() . '=' . session_id()); ?>" style="color:#ff9900"><span style="font-size:x-small; color:#ff9900;">もっと見る</span></a>
<?php else : ?>
<span style="font-size:x-small; color:#666666;">もっと見る</span>
<?php endif; ?>
</span>
</td>

</tr>
</table>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

