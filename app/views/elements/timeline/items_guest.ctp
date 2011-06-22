
<?php
$i = true;

//$url_news_detail = "http://".$_SERVER["HTTP_HOST"]."/shimajiro/-apis/view_news.php?guid=ON&id=";
$url_news_detail = $this->Html->url('/navigations/prev/1');
//$url_test_detail = "http://".$_SERVER["HTTP_HOST"]."/shimajiro/-apis/view_psychological_tests.php?guid=ON&id=";
$url_test_detail = $this->Html->url('/navigations/prev/1');

//$url_set_hanamaru = $this->Html->url('/hanamarus/add_hanamaru/', true)."?id=%s&user_id=%s&returnPath=%s";
$url_set_hanamaru = $this->Html->url('/navigations/prev/1');
//$url_set_attention = $this->Html->url('/attentions/attention/', true)."?id=%s&user_id=%s&returnPath=%s";
$url_set_attention = $this->Html->url('/navigations/prev/1');

$login_user = $this->Session->read('Auth.User'); 
?>

<?php foreach ($articles as $article) : ?>

<?php
if ($i) {
    $color = "#ffffff";
} else {
    $color = "#ffffcc";
}
$i = !$i;
?>


<?php if ($article['Article']['type'] == 1) : // 思い出?>
<?php
  // 子供の画像パス
  $album_pic_path;
  if (!empty($article['Article']['photo']) && file_exists(IMAGES.$article['Article']['photo'])) {
    $album_pic_path = $article['Article']['photo']; 
  } else {
    $album_pic_path = 'omoide_nophoto.gif';
  } 

  $title = '無題';
  if(!empty($article['Article']['title']) && $article['Article']['title'] != '') { 
  	$title = $article['Article']['title'];
  }
?>
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo $color; ?>">
<tr>
  <td width="25%" rowspan="2" align="left" valign="top">
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
    <?php echo $this->Html->image("icn_green_aboutfriend.gif", array("alt" => "お友達の様子", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br />
    <?php echo $ktai->image($album_pic_path, array("alt" => "子ども画像", "width" => "60", "height" => "60", "style" => "margin:2px 2px 5px 0;")); ?>
  </td>
  <td colspan="3" align="left" valign="top">
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
    <a href="<?php echo $this->Html->url('/navigations/prev/1'); ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;"><?php echo h($article['Article']['title']); ?></span></a>
  </td>
</tr>
<tr>
  <td colspan="3" align="left" valign="top"><span style="font-size:x-small;color:#333333;">
    <?php echo h($title); ?><br />
    <div align="left" style="text-align:left;color:#339933;margin-top:10px;font-size:x-small"><?php echo $this->DiaryCommon->formatYearsOld($article['Child']['birth_year'], $article['Child']['birth_month']);?>のお友達</div>
    <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
  </td>
</tr>
<tr>
  <td valign="middle" nowrap="nowrap" style="white-space:nowrap;">&nbsp;</td>
  <td align="left" valign="middle" width="25%">
    <a href="<?php echo $this->Html->url("/navigations/prev/1"); ?>"><?php echo $this->Html->image("icn_hanamaru_btn.gif", array("alt" => "はなまる", "width" => "100%", "style" => "margin:4px 2px 4px 0;")); ?></a>
  </td>
  <td align="left" valign="middle" width="20%">
    <span style="font-size:x-small; color:#FF0000;"><?php echo $article['Diary']['hanamaru_count']; ?>ｺ</span>
  </td>
  <td align="right" valign="middle" width="30%">
    <span style="font-size:x-small; color:#666666;"><?php echo $this->Time->format('n月j日', $article['Article']['release_date']); ?></span>
  </td>
</tr>
</table>


<?php elseif($article['Article']['type'] == 2) : // ニュース?>
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo $color; ?>">
<?php if (!empty($article['Article']['photo'])) : ?>
<tr>
  <td width="25%" rowspan="2" align="left" valign="top" style=" font-size:x-small; color:#ff9900;">
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
    <?php echo $this->Html->image("icn_bule_news.gif", array("alt" => "ニュース", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br />
    <?php echo $ktai->image($article['Article']['photo'], array("alt" => "ニュース画像", "width" => "60", "height" => "60", "style" => "margin:2px 2px 5px 0;")); ?>
  </td>
  <td colspan="3" align="left" valign="top">
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
    <a href="<?php echo $this->Html->url('/navigations/prev/1'); ?>" style="color:#0099FF;"><span style="font-size:x-small; color:#0099FF;"><?php echo h($article['Article']['title']); ?></span></a>
  </td>
</tr>
<tr>
  <td colspan="3" align="left" valign="top">
      <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "2")); ?><br />
    <span style="font-size:x-small; color:#333333;"><?php echo h($article['Article']['body']); ?></span>
  </td>
</tr>
<?php else: ?>
<tr>
<td width="25%" align="left" valign="top" style=" font-size:x-small; color:#ff9900;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
    <?php echo $this->Html->image("icn_bule_news.gif", array("alt" => "ニュース", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?>
</td>
<td colspan="3" align="left" valign="top">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
    <a href="<?php echo $this->Html->url('/navigations/prev/1'); ?>" style="color:#0099FF;"><span style="font-size:x-small; color:#0099FF;"><?php echo h($article['Article']['title']); ?></span></a>
</td>
</tr>
<tr>
<td colspan="4" align="left" valign="top">
    <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "2")); ?><br />
    <span style="font-size:x-small; color:#333333;"><?php echo h($article['Article']['body']); ?></span></td>
</tr>
<?php endif; ?>

<tr>
  <td valign="middle" nowrap="nowrap" style="white-space:nowrap;">&nbsp;</td>
  <td align="left" valign="middle" width="25%">
    <a href="<?php echo $this->Html->url("/navigations/prev/1"); ?>"><?php echo $this->Html->image("icn_attention.gif", array("alt" => "注目", "width" => "100%", "style" => "margin:4px 2px 4px 0;")); ?></a>
  </td>
  <td align="left" valign="middle" width="20%">
    <span style="font-size:x-small; color:#FF0000;"><?php echo $article['Article']['attention_count']; ?>ｺ</span>
  </td>
  <td align="right" valign="middle" width="30%">
    <span style="font-size:x-small; color:#666666;"><?php echo $this->Time->format('n月j日', $article['Article']['release_date']); ?></span>
  </td>
</tr>
</table>

<?php elseif($article['Article']['type'] == 3) : // お知らせ?>
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo $color; ?>">
<tr>
  <td width="25%" rowspan="2" align="left" valign="top" nowrap="nowrap" style="white-space:nowrap; font-size:x-small; color:#ff9900;">
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
    <?php echo $this->Html->image("icn_yellow_oshirase.gif", array("alt" => "お知らせ", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br />
    <?php if (!empty($article['Article']['photo'])) : ?>
      <?php echo $ktai->image($article['Article']['photo'], array("alt" => "お知らせ画像", "width" => "60", "height" => "60", "style" => "margin:2px 2px 5px 0;")); ?>
    <?php endif; ?>
  </td>
  <td colspan="3" align="left" valign="top">
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
    <span style="font-size:x-small; color:#ff9900;"><?php echo $this->Wikiformat->makeLink($article['Article']['title']); ?></span>
  </td>
</tr>
<tr>
  <td colspan="3" align="left" valign="top">
      <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "2")); ?><br />
    <span style="font-size:x-small; color:#333333;"><?php echo h($article['Article']['body']); ?></span>
  </td>
</tr>
<tr>
  <td valign="middle" style="font-size:x-small; color:#333333;"></td>
  <td align="left" valign="top" style="font-size:x-small;"></td>
  <td align="right" valign="middle">
    <span style="font-size:x-small; color:#666666;"><?php echo $this->Time->format('n月j日', $article['Article']['release_date']); ?></span>
  </td>
</tr>
</table>

<?php elseif($article['Article']['type'] == 4) : // 心理テスト?>
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo $color; ?>">
<tr>
  <td width="25%" rowspan="2" align="left" valign="top" nowrap="nowrap" style="white-space:nowrap; font-size:x-small; color:#ff9900;">
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
    <?php echo $this->Html->image("icn_purple_psycho.gif", array("alt" => "心理テスト", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br />
    <?php if (!empty($article['Article']['photo'])) : ?>
      <?php echo $ktai->image($article['Article']['photo'], array("alt" => "心理テスト画像", "width" => "60", "height" => "60", "style" => "margin:2px 2px 5px 0;")); ?>
    <?php endif; ?>
  </td>
  <td colspan="3" align="left" valign="top">
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
    <a href="<?php echo $this->Html->url('/navigations/prev/1'); ?>" style="color:#9933CC;"><span style="font-size:x-small; color:#9933CC;"><?php echo h($article['Article']['title']); ?></span></a>
  </td>
</tr>
<tr>
  <td colspan="3" align="left" valign="top">
      <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "2")); ?><br />
    <span style="font-size:x-small; color:#333333;"><?php echo $this->Wikiformat->makeLink($article['Article']['body']); ?></span>
  </td>
</tr>
<tr>
  <td valign="middle" nowrap="nowrap" style="white-space:nowrap; font-size:x-small; color:#333333;"></td>
  <td align="left" valign="top" style="font-size:x-small;"></td>
  <td align="right" valign="middle">
    <span style="font-size:x-small; color:#666666;"><?php echo $this->Time->format('n月j日', $article['Article']['release_date']); ?></span>
  </td>
</tr>
</table>
<?php endif; ?>

<?php endforeach; ?>

