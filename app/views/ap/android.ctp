<div class="contents view">

<?php echo $this->Html->image("ttl_challenge.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

<?php if (!empty($login_user_data) && $login_user_data['User']['dc_user'] == 1): ?>
<?php $url = $this->Html->url(array('controller' => 'children', 'action' => 'index')); ?>
<?php else: ?>
<?php $url = $this->Html->url(array('controller' => 'pages', 'action' => 'display')); ?>
<?php endif; ?>

※Androidには対応しておりません。<br />
<?php echo $this->Html->image("dot_line_pink.gif", array("style" => "margin:10px 0; width:100%")); ?><br />
<div align="center" style="text-align:center;"><a href="<?php echo $url; ?>"><span style="font-size:medium">ﾄｯﾌﾟﾍﾟｰｼﾞへ</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "30")); ?><br />

</div>
