
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_write.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_write.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table>
<span style="color:#339933;">&nbsp;･</span><?php echo $months['0']['Month']['month'] ?>月の思い出ﾃｰﾏに沿って書く<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php foreach($months as $month): ?>

<?php foreach($month['Theme'] as $theme): ?>
<?php if(!$theme['free_theme']): ?>
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/themes/info/'.$theme['id']); ?>" style="color:#339900;"><span style="color:#339900;">【ﾃｰﾏ】<?php echo h($theme['title']); ?></span></a><br />
<?php endif; ?>
<?php endforeach; ?>

<?php endforeach; ?>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<span style="color:#339933;">&nbsp;･</span>自由に書く<br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php foreach($months as $month): ?>

<?php foreach($month['Theme'] as $theme): ?>
<?php if($theme['free_theme']): ?>
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/themes/info/'.$theme['id']); ?>" style="color:#339900;"><span style="color:#339900;">【ﾌﾘｰ】<?php echo h($theme['title']); ?></span></a><br />
<?php endif; ?>
<?php endforeach; ?>

<?php endforeach; ?>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<span style="color:#339933;">&nbsp;･</span>他の月の思い出を書く<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr>

<td align="left">
<?php if($beforeFlag) : ?>
<a href="<?php echo $this->Html->url('/themes/index/before/');?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">前月</span></a>
<?php endif; ?>
</td>

<td align="right">
<?php if($nextFlag) : ?>
<a href="<?php echo $this->Html->url('/themes/index/next/');?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">次月</span></a>
<?php endif; ?>
</td>

</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

