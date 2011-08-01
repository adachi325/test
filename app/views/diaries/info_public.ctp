<?php /* 208-2 思い出記録詳細（他ユーザ） */ ?>
<?php echo $this->Html->image("otomodachi.gif", array("alt" => "お友達の様子", "width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "15")); ?><br />
<table width="80%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<?php
$title = "無題";
if(!empty($diary['Diary']['title']) and $diary['Diary']['title'] != '') { 
	$title = $diary['Diary']['title'];
}
?>
<span style="font-size:small;"><?php echo h($title); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</td>
</tr>
<tr>
<td align="center">
<?php 
if ($diary['Diary']['has_image']) {
	echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $diary['Diary']['id']));
} 
?><br />
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
</td>
</tr>
<tr>
<td align="left">
  <span style="font-size:x-small; color:#333333;"><?php echo nl2br(h($diary['Diary']['body'])); ?></span>
</td>
</tr>
<tr><td align="right">
<span style="font-size:x-small; color:#333333;"><?php echo $this->DiaryCommon->formatYearsOld($currentChild['Child']['birth_year'], $currentChild['Child']['birth_month']); ?>のお友達</span><br />
 <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</td></tr>

<tr>
<td align="right">
<span style="font-size:x-small; color:#666666;"><?php echo $this->Time->format('n月j日', $diary['Diary']['created']); ?></span>
</td>
</tr>
<tr>
<td align="right">
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
  <span style="font-size:x-small; color:#666666;">配信日:<?php echo $this->Time->format('n月j日', $diary['Article']['release_date']); ?></span><br />
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</td>
</tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="60%" align="right">
    <?php if ($alreadyAddHanamaru) : ?>
      <?php echo $ktai->image("icn_hanamaru_btn_off.gif", array("alt" => "はなまる", "border" => "0", "width" => "60", "height" => "21")); ?>
    <?php else: ?>
      <?php
      $scheme = '';
      if (isset($_SERVER['HTTPS'])) {
        $scheme = "https://";
      } else {
        $scheme = "http://";
      }
      $url = $scheme . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $encoded_url = urlencode($url);
      ?>
      <?php echo $ktai->image("icn_hanamaru_btn_on.gif",
        array("url" => "/hanamarus/add_hanamaru?id={$diary['Diary']['id']}&user_id={$user['User']['hash']}&returnPath={$encoded_url}",
              "alt" => "はなまる", "border" => "0", "width" => "60", "height" => "21")); ?>
    <?php endif; ?>
    <?php echo $this->Html->image("spacer.gif", array("width" => "4", "height" => "10")); ?>
    </td>
    <td width="40%" align="left">
    <?php if ($diary['Diary']['hanamaru_count'] > 0) { ?>
      <span style="font-size:x-small;"><span style="color:#FF0000;"><?php echo $diary['Diary']['hanamaru_count']; ?>ｺ</span></span>
    <?php } ?>
    </td>
  </tr>
</table>

<table width="80%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="right">
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
  <span style="font-size:x-small; color:#666666;">【記事ID】<?php echo $this->DiaryCommon->hyphenateIdentifyToken($diary['Diary']['identify_token']) ;?></span><br />
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</td>
</tr>
</table>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

