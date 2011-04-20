
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

この思い出をﾄﾞｺﾓｺﾐｭﾆﾃｨに投稿し､家族や友達に共有しよう!<br />
<span style="font-size:x-small;color:#cc0000">※ﾄﾞｺﾓｺﾐｭﾆﾃｨはNTTﾄﾞｺﾓが提供するｻｰﾋﾞｽですので､別途登録が必要です｡</span>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<?php if ($diary['Diary']['has_image']): ?>
   <?php echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('escape' => false, 'width' => '100px', 'height' => '100px')); ?>
<?php endif; ?>

<ol>
<li>(写真を投稿した場合)上の画像を保存</li>
<li>下の｢思い出を記録に残す｣ﾘﾝｸを押すと、ﾒｰﾙが立ち上がるので､1で保存した画像を添付して送信<br />

<?php if($this->Ktai->is_softbank()): ?>
<a href="mailto:<?php echo Configure::read('Defaults.docomo_community'); ?>?subject=<?php echo rawurldecode(mb_convert_encoding($mailTitle, "utf8"));?>&body=<?php echo rawurldecode(mb_convert_encoding($mailBody, "utf8"));?>" style="color:#339900;"><span style="color:#339900;font-size:medium">思い出を記録に残す</span></a>
<?php else: ?>
<span style="color:#339900;font-size:medium"><?php $this->Ktai->mailto("思い出を記録に残す",Configure::read('Defaults.docomo_community'),h($mailTitle),h($mailBody)); ?></span>
<?php endif; ?><?php $this->Ktai->emoji(0xE6D3); ?><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

⇒<a href="http://docomo-community.com/djs/index.xhtml">ﾄﾞｺﾓｺﾐｭﾆﾃｨのﾏｲﾍﾟｰｼﾞへ</a>
</ol>
<br />

<span style="color:#666666">※思い出記録のﾀｲﾄﾙや本文が長い場合､お使いの機種によっては全て表示されないことがあります｡</span>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/diaries/index/'.$diary['Month']['year'].'/'.$diary['Month']['month']);?>" style="color:#339900;"><span style="color:#339900;">今月の思い出記録ﾍﾟｰｼﾞへ戻る</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

