
<div style="background:#996633;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="font-size:small; font-weight:bold; color:#ffffff;">端末番号取得エラー</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span>端末番号を取得できませんでした。</span><br />
<?php if(isset($messege)){ ?>
<span>下記の設定を行ってください。</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#996633">▼設定手順</span><br />
<?php echo $messege; ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span>※お使いの端末によっては表示が異なる場合があります。</span><br />
<?php } ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
