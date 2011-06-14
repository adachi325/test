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
<td width="50%" align="left"><a href="#"><span style="font-size:x-small; color:#ff9900;">前のページ</span></a></td>
<td width="50%" align="right"><a href="#"><span style="font-size:x-small; color:#ff9900;">もっと見る</span></a></td>
</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

