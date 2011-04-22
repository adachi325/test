
<?php $path = '/'.sprintf(Configure::read('Present.path.postcard_output_thum'), $token); ?>

<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<div style="text-align:center;" align="center">ﾎﾟｽﾄｶｰﾄﾞ完成!<br />
</div>
<div style="text-align:center;" align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php echo $this->Html->image($path); ?></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<ol>
<li>下のﾎﾞﾀﾝから印刷用URLをﾊﾟｿｺﾝ用ﾒｰﾙｱﾄﾞﾚｽに送信</li>
<li>ﾊﾟｿｺﾝからﾒｰﾙを開き､記載のURLにｱｸｾｽ</li>
<li>ﾌﾟﾘﾝﾀｰで印刷</li>
</ol>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<div style="text-align:center;" align="center">
<?php if($this->Ktai->is_imode()): ?>
<a href="mailto:?subject=<?php echo $mailSubject; ?>&body=<?php echo urlencode(mb_convert_encoding($mailBody,"utf8")); ?>"><span style="color:#339900;">印刷用URLを送る</span></a>
<?php elseif($this->Ktai->is_softbank()): ?>
<a href="mailto:?subject=<?php echo rawurlencode(mb_convert_encoding($mailSubject, "utf8"));?>&body=<?php echo rawurlencode(mb_convert_encoding($mailBody, "utf8"));?>" style="color:#339900;"><span style="color:#339900;font-size:medium">印刷用URLを送る</span></a>
<?php else: ?>
<span style='color:#339900;'><?php $this->Ktai->mailto("印刷用URLを送る", '', $mailSubject, $mailBody); ?></span>
<?php endif; ?>
<?php $this->Ktai->emoji(0xE6D3); ?></div>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#CC0000;">※URLの有効期限は発行から3日間です｡</span><br />
<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<span style="color:#339933;">&nbsp;･</span><span style="color:#339900;"><a href="<?php echo $this->Html->url('/'.'presents/select/postcard/'.$present_id); ?>">ﾎﾟｽﾄｶｰﾄﾞを作り直す</a></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

