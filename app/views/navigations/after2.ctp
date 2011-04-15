
<?php echo $this->Html->image("ttl_fun.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="center" style="text-align:center;">
ほら!こんな簡単にかわいい<br />
思い出記録が残せちゃった<?php $this->Ktai->emoji(0xE694); ?><br />
</div>
<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_orrange.gif", array()); ?></div>

<?php if(!empty($diaries['Diary']['error_code'])) : ?>
<div style="color:#CC0000;">
以下の理由により､写真を保存できませんでした｡<br /><br />

<?php if ($diaries['Diary']['error_code'] === 'E001') : ?>
&nbsp;・ﾌｧｲﾙｻｲｽﾞが2MB以上
<?php elseif ($diaries['Diary']['error_code'] === 'E002') : ?>
&nbsp;・ﾌｧｲﾙ形式がJPEG以外
<?php endif; ?><br /><br />

<span style="color:#666666">写真をつけて思い出記録を残したい場合は､JPG形式で容量が2MB以内の写真を添付して再度送信し直してください｡</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "20")); ?><br />
</div><!--写真サイズエラーの場合-->
<?php endif; ?>

<div style="background:#e9f7ff; text-align:center;" align="center">

<?php echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_h'), date('Y'), date('m')), array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="90%" cellpadding="0" cellspacing="0" align="center">

<tr>
<td align="center">
<span style="color:#ff6666;font-size:x-small;"><?php echo h($diaries['Diary']['title']); ?></span><br />
</td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php if ($diaries['Diary']['has_image']): ?>
   <?php echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $diaries['Diary']['child_id'], $diaries['Diary']['id']) ); ?><br />
<?php endif; ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</td>
</tr>

<tr>
<td align="left"><span style="font-size:x-small; color:#333333;">
<?php echo nl2br(h($diaries['Diary']['body'])); ?>
</span></td>
</tr>

<tr>
<td align="right"><span style="font-size:x-small; color:#666666;"><?php echo date('n月d日', strtotime($diaries['Diary']['created'])); ?></span></td>
</tr>

</table><br />

<?php echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_f'), date('Y'), date('m')), array("width" => "100%")); ?>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<span style="color:#339933">思い出を記録</span>していくと<span style="color:#FF6699">ﾎﾟｽﾄｶｰﾄﾞﾃﾝﾌﾟﾚｰﾄや待受Flashなどのﾌﾟﾚｾﾞﾝﾄ</span>がGETできるよ☆<br />
日々の思い出をかわいく残そう!<br /><br />
その他､毎月の<span style="color:#FF0000">こどもちゃれんじ教材</span>と連動したｺﾝﾃﾝﾂや楽しいｺﾝﾃﾝﾂがいっぱい♪<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />

<div align="center" style="text-align:center;"><a href="<?php echo $this->Html->url('/children/'); ?>"><span style="font-size:medium">ﾄｯﾌﾟﾍﾟｰｼﾞへ</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "30")); ?>

