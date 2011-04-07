
<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

<?php if(count($childData) < 3): ?>
<span style="color:#666666;">・</span>
<a href="<?php echo $this->Html->url(array('action' => 'register'));?>" style="color:#666666;"><span style="color:#666666;">子ども情報を追加する</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php endif; ?>
<?php if(count($childData) > 0): ?>
<span style="color:#666666;">・</span><a href="<?php echo $this->Html->url(array('action' => 'edit'));?>" style="color:#666666;"><span style="color:#666666;">子ども情報を変更する</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#666666;">・</span><a href="<?php echo $this->Html->url(array('action' => 'delete'));?>" style="color:#666666;"><span style="color:#666666;">子ども情報を削除する</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "40")); ?><br />
<?php endif; ?>

