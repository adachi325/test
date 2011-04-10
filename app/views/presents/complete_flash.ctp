
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<div style="text-align:center;" align="center">待受Flash完成!</div>
<br />

<div style="text-align:center;" align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php pr($selected); ?>
<object declare id="preview" data="<?php //$this->CreatePresent->createFlash($selected); ?>" type="application/x-shockwave-flash" width="200" height="250">
<param name="bgcolor" value="ffffff">
<param name="loop" value="on">
<param name="quality" value="high">
</object>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

待受Flashを作成しました｡端末の画像保存機能で保存してお使いください｡<br />
<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<span style="color:#339933;">・</span><a href="<?php echo $this->Html->url('/presents/present_list/2/'); ?>"><span style="color:#339900;">待受Flashを作り直す</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />


