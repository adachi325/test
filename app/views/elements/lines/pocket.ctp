
<div>
<?php
if(count($contents) > 0):
echo '<table>';
$ii = 0;
foreach($contents as $content):
?>
<?php if ($content['Content']['release_date'] < date('Y-m-d H:i:s') and $ii < 3): ?>
<tr>
<?php if($content['Content']['release_date'] > date("Y-m-d H:i:s", strtotime("-7 day"))): ?>
<td valign="top"><span style="font-size:x-small; color:#cc0000;"><?php $this->Ktai->emoji(0xE6DD); ?></span></td>
<?php else:?>
<td width="1" valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td>
<?php endif;?>
<td width="229" align="left"><a href="<?php echo $this->Html->url(DS.$content['Content']['path'].DS); ?>" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;"><?php echo h($content['Content']['title']); ?></span></a></td>
</tr>
<?php
$ii++;
endif; ?>
<?php
endforeach;
echo '</table>';
endif;
?>
<?php echo $this->Html->link('もっと見る', 'http://shimajiromobile.benesse.ne.jp/ap1/'); ?>
</div>

<div>

<p>
<?php echo $this->Html->link('text', ''); ?><br />
text
</p>

<p>
<?php echo $this->Html->link('text', ''); ?><br />
text
</p>

<p>
<?php echo $this->Html->link('text', ''); ?><br />
text
</p>

</div>

