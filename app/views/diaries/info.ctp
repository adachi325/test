
<div style="background:#e9f7ff; text-align:center;" align="center">
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%")); ?><br />

<?php
if($diary['Month']['month'] < 10) {
	$imgMonth = '0'.$diary['Month']['month'];
}else {
	$imgMonth = $diary['Month']['month'];
}
echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_h'), $diary['Month']['year'], $imgMonth),
	array("width" => "100%", "style" => "margin-bottom:10px;"));	
?>

<table width="90%" cellpadding="0" cellspacing="0" align="center">

<tr>
<td align="center">
<?php
$title = "無題";
if(!empty($diary['Diary']['title']) and $diary['Diary']['title'] != '') { 
	$title = h($diary['Diary']['title']);
}
?>
	<span style="color:#ff6666;font-size:x-small;"><?php echo h($title); ?></span><br />
</td>
</tr>

<tr>
<td align="center">
<?php 
if ($diary['Diary']['has_image']) {
	echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array("style" => "margin:10px 0;"));
} 
?>
<br />
</td>
</tr>

<tr>
<td align="left"><span style="font-size:x-small; color:#333333;">
<?php echo nl2br(h($diary['Diary']['body'])); ?>
</span></td>
</tr>
<tr>
<td align="right"><span style="font-size:x-small; color:#666666;">
<?php echo $this->Time->format('n月j日', $diary['Diary']['created']); ?>
</span></td>
</tr>
</table>
<br />

<!-- start: 公開情報、はなまる個数、記事ID -->
<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="50%"><span style="font-size:x-small;">
<?php
$status = "非公開";
if ($diary['Diary']['wish_public'] == 1) {

  if ($diary['Diary']['permit_status'] == 0 || $diary['Diary']['permit_status'] == 1) {

    $status = "公開申請中";

  } elseif ($diary['Diary']['permit_status'] == 2) {

    $current_time = time();
    $publish_time = strtotime($diary['Diary']['publish_date']);

    if ($current_time > $publish_time) {
      $status = "公開中!";
    } else {
      $status = $this->Time->format('n月j日公開予定', $diary['Diary']['publish_date']);
    }
  } 
}
?>
<?php echo $status; ?>
</span></td>
<td width="50%"><span style="font-size:x-small;">
はなまる <?php echo $diary['Diary']['hanamaru_count']; ?>コ
</span></td>
</tr>
<tr>
<td colspan="2" align="right">
<?php if (isset($diary['Diary']['identify_token'])) { ?>
【記事ID】<?php echo substr($diary['Diary']['identify_token'], 0, 4) . '-' . substr($diary['Diary']['identify_token'], 4, 6) ;?>
<?php } ?>
</td>
</tr>
</table>
<!-- end: 公開情報、はなまる個数、記事ID -->
<br />

<?php 
if($diary['Month']['month'] < 10) {
	$imgMonth = '0'.$diary['Month']['month'];
}else {
	$imgMonth = $diary['Month']['month'];
}
echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_f'), $diary['Month']['year'], $imgMonth), array("width" => "100%"));
?>

</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/diaries/post/'.$diary['Diary']['id']); ?>" style="color:#339900;"><span style="color:#339900;">この思い出記録を家族や友達と共有する</span></a><br />
(ﾄﾞｺﾓｺﾐｭﾆﾃｨへ投稿)<br /><span style="color:#666666">※ﾄﾞｺﾓｺﾐｭﾆﾃｨへの登録が必要です</span><br />
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/diaries/edit/'.$diary['Diary']['id']); ?>" style="color:#339900;"><span style="color:#339900;">この思い出を編集する</span></a><br />
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/diaries/delete/'.$diary['Diary']['id']); ?>" style="color:#339900;"><span style="color:#339900;">この思い出を削除する</span></a><br />

<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj01.gif"); ?></div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_leave.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_leave.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table><span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/presents/present_list/2'); ?>" style="color:#339900;"><span style="color:#339900;">世界に1つ!待受画面を作る</span></a><br />
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/presents/present_list/3'); ?>" style="color:#339900;"><span style="color:#339900;">家族に送れるﾎﾟｽﾄｶｰﾄﾞを作る</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

