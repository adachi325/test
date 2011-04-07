
<div>
<?php
if(is_array($issues['Content'])):
echo '<table>';
$ii = 0;
foreach($issues['Content'] as $content):
?>
<?php if ($content['release_date'] < date('Y-m-d H:i:s') and $ii < 3): ?>
<tr>
<?php if($content['release_date'] > date("Y-m-d H:i:s", strtotime("-7 day"))): ?>
<td valign="top"><span style="font-size:x-small; color:#cc0000;"><?php $this->Ktai->emoji(0xE6DD); ?></span></td>
<?php else:?>
<td width="1" valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td>
<?php endif;?>
<td width="229" align="left"><a href="<?php echo $this->Html->url(DS.$content['path'].DS); ?>" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;"><?php echo h($content['title']); ?></span></a></td>
</tr>
<?php endif; ?>
<?php
$ii++;
endforeach;
echo '</table>';
endif;
?>
<?php echo $this->Html->link('もっと見る', 'http://shimajiromobile.benesse.ne.jp/ap1/'); ?>
</div>

