<?php /* 208-1 思い出記録詳細 */ ?>

<div style="background:#e9f7ff; text-align:center;" align="center">
<?php echo $this->Html->image("ttl_memory.gif", array("alt" => "思い出記録", "width" => "100%")); ?><br />
<?php
if($diary['Month']['month'] < 10) {
	$imgMonth = '0'.$diary['Month']['month'];
}else {
	$imgMonth = $diary['Month']['month'];
}
?>
<?php echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_h'), $diary['Month']['year'], $imgMonth), array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<?php
$title = "無題";
if(!empty($diary['Diary']['title']) and $diary['Diary']['title'] != '') { 
	$title = $diary['Diary']['title'];
}
?>
<span style="color:#ff6666;font-size:small;"><?php echo h($title); ?></span><br />
</td>
</tr>
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php 
if ($diary['Diary']['has_image']) {
	echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $diary['Diary']['id'])) . '<br />';
} 
?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</td>
</tr>
<tr>
<td align="left"><span style="font-size:x-small; color:#333333;"><?php echo nl2br(h($diary['Diary']['body'])); ?></span></td>
</tr>
<tr>
<td align="right"><span style="font-size:x-small; color:#666666;"><?php echo $this->Time->format('n月j日', $diary['Diary']['created']); ?></span></td>
</tr>
</table><br />
<?php 
if($diary['Month']['month'] < 10) {
	$imgMonth = '0'.$diary['Month']['month'];
}else {
	$imgMonth = $diary['Month']['month'];
}
?>
<?php echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_f'), $diary['Month']['year'], $imgMonth), array("width" => "100%")); ?>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="left"><span style="font-size:x-small; color:#333333;"><?php echo $this->DiaryCommon->publicStatus($diary['Diary']['wish_public'], $diary['Diary']['permit_status'], $diary['Article']['release_date']); ?></span></td>
<td align="right">
<?php if ($alreadyAddHanamaru) : ?>
  <span style="font-size:x-small; color:#FF0000;"><?php echo $ktai->image("icn_hanamaru_btn.gif", array("alt" => "はなまる", "width" => "60", "height" => "21", "style" => "margin:0px 2px 0px 0;")); ?><?php echo $ktai->image("icn_hanamaru.gif", array("alt" => "はなまる", "border" => "0", "width" => "20", "height" => "18", "style" => "margin:0 4px 0 0;")); ?><?php echo $diary['Diary']['hanamaru_count']; ?>ｺ</span>
<?php else : ?>
<?php
// 現在ページのフルパス(エンコード済み)を設定する
$scheme = '';
if (isset($_SERVER['HTTPS'])) {
  $scheme = "https://";
} else {
  $scheme = "http://";
}
$url = $scheme . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$encoded_url = urlencode($url);
?>
      <a href="<?php echo $this->Html->url("/hanamarus/add_hanamaru?id={$diary['Diary']['id']}&user_id={$user['User']['hash']}&returnPath={$encoded_url}"); ?>"><?php echo $ktai->image("icn_hanamaru_btn.gif", array("alt" => "はなまる", "width" => "60", "height" => "21", "style" => "margin:0px 2px 0px 0;")); ?></a><span style="font-size:x-small; color:#FF0000;"><?php echo $diary['Diary']['hanamaru_count']; ?>ｺ</span>
<?php endif; ?>

</td>
</tr>
<tr>
<td colspan="2" align="right"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php
$current_time = time();
$publish_time = strtotime($diary['Article']['release_date']);
?>
<?php if ($diary['Diary']['wish_public'] == 1 && $diary['Diary']['permit_status'] == 2 && $current_time >= $publish_time) : ?>
  <span style="font-size:x-small; color:#666666;">【記事ID】<?php echo $this->DiaryCommon->hyphenateIdentifyToken($diary['Diary']['identify_token']) ;?></span><br />
<?php endif; ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?></td>
</tr>
</table>

<div align="center" style="text-align:center"><a href="<?php echo $this->Html->url('/diaries/post/'.$diary['Diary']['id']) ;?>"><?php echo $this->Html->image('bt_kyouyu.gif', array('width' => "80%", 'border' => '0')); ?></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/diaries/edit/'.$diary['Diary']['id']); ?>" style="color:#339900;"><span style="color:#339900;">編集する</span></a><br />
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/diaries/edit_public/'.$diary['Diary']['id']); ?>" style="color:#339900;"><span style="color:#339900;">公開設定を変更する</span></a><br />
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/diaries/delete/'.$diary['Diary']['id']); ?>" style="color:#339900;"><span style="color:#339900;">削除する</span></a><br />

<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj01.gif", array("width" => "228", "height" => "35")); ?></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_leave.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_makes.gif", array("alt" => "待受&nbsp;･ポストカードを作る", "width" => "100%")); ?></td>
</tr>
</table>
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/presents/present_list/2'); ?>" style="color:#339900;"><span style="color:#339900;">世界に1つ!待受Flashを作る</span></a><br />
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/presents/present_list/3'); ?>" style="color:#339900;"><span style="color:#339900;">家族に送れるﾎﾟｽﾄｶｰﾄﾞを作る</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

