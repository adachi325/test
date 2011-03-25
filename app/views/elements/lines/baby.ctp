
<tr>
<td valign="top"><span style="font-size:x-small; color:#cc0000;"><?php $this->Ktai->emoji(0xE6DD); ?></span></td>
<td align="left"><span style="font-size:x-small;">いきものｸｲｽﾞ(5/30更新予定)</span></td>
</tr>

<tr>
<td width="1" valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td>
<td width="229" align="left"><a href="#" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;">いっぱい食べよう【Flash】</span></a></td>
</tr>

<tr>
<td valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td>
<td align="left"><a href="#" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;">わんわんと遊ぼう【動画】</span></a></td>
</tr>

<tr>
<td valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td>
<td align="left"><a href="#" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;">はみがきできたよ【Flash】</span></a></td>
</tr>

<tr>
<td colspan="2" align="right"><img src="img/spacer.gif" width="1" height="5" /><br />
<span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE691); ?><a href="#" style="color:#ff3333;"><span style="color:#ff3333;">もっとみる</span></a></span></td>
</tr>



<?php foreach($issues as $issue): ?>
<tr>
<td width="1" valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td>
<td width="229" align="left"><a href="<?php echo $this->Html->url(DS.$content['path'].DS); ?>" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;"><?php echo h($content['title']); ?></span></a></td>
</tr>

<?php
	if(is_array($issue['Content'])) {
		foreach($issue['Content'] as $content) {
			if ($content['release_date'] < date('Y-m-d')) {
				echo "<p>";
				echo $this->Html->link($content['title'], DS.$content['path'].DS);
				echo "</p>";
			}
		}
	}
?>
<?php endforeach; ?>

<?php echo $this->Html->link('もっと見る', 'http://shimajiromobile.benesse.ne.jp/ap1/'); ?>

