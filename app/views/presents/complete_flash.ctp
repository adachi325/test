
<meta http-equiv="Cache-Control" content="max-age=1" />
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<div style="text-align:center;" align="center">待受Flash完成!</div>
<br />

<div style="text-align:center;" align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<object data="/<?php echo $urlItem[1].'/'.(sprintf(Configure::read('Present.path.screen_output'), $selected['child_id'], $selected['child_id'])); ?>" type="application/x-shockwave-flash" width="100%" height="100%">
<param name="bgcolor" value="000000">
<param name="loop" value="off">
<param name="quality" value="high">
<embed src="/<?php echo $urlItem[1].'/'.(sprintf(Configure::read('Present.path.screen_output'), $selected['child_id'], $selected['child_id'])); ?>" width="100%" height="100%" loop="on" quality="high" bgcolor="#000000"></embed>
</object>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

待受Flashを作成しました｡端末の画像保存機能で保存してお使いください｡<br />
<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/presents/select/flash/'.$selected['present_id']); ?>"><span style="color:#339900;">待受Flashを作り直す</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />


