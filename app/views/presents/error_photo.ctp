
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

<span style="color:#CC0000">写真の選択枚数が誤っています｡</span><br />
※待受Flashは3枚､ﾎﾟｽﾄｶｰﾄﾞは4枚となります｡<br />
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<span style="color:#339933;">&nbsp;・</span><a href="<?php echo $this->Html->url("/presents/select/{$type}/{$template_id}/"); ?>"><span style="color:#339900;">写真を選び直す</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

