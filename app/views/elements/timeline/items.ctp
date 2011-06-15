
<?php
$i = false;

$url_news_detail = "http://".$_SERVER["HTTP_HOST"]."/shimajiro/-apis/view_news.php?guid=ON&id=";
$url_test_detail = "http://".$_SERVER["HTTP_HOST"]."/shimajiro/-apis/view_psychological_tests.php?guid=ON&id=";

$url_set_hanamaru = $this->Html->url('/hanamarus/add_hanamaru/', true)."?id=%s&user_id=%s&returnPath=%s";
$url_set_attention = $this->Html->url('/attentions/attention/', true)."?id=%s&user_id=%s&returnPath=%s";

$login_user = $this->Session->read('Auth.User'); 
?>

<?php foreach ($articles as $article) : ?>

<?php
if ($i) {
    $color = "#ffffcc";
} else {
    $color = "#ffffff";
}
$i = !$i;
?>


<?php if ($article['Article']['type'] == 1) : // 思い出?>
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo $color; ?>">
<tr>
<td width="25%" rowspan="2" align="left" valign="top"><?php echo $this->Html->image("icn_green_aboutfriend.gif", array("alt" => "お友達の様子", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br /><?php 
if (!empty($article['Article']['photo']) && file_exists(IMAGES.$article['Article']['photo'])) {
    echo $this->Html->image($article['Article']['photo'], array("alt" => "子ども画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); 
} else {
    echo $this->Html->image('omoide_nophoto.gif', array("alt" => "子ども画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); 
} 
?></td>
<td colspan="2" align="left" valign="top"><a href="<?php
echo $this->Html->url('/diaries/info/'.$article['Article']['external_id'].'/');
?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;"><?php
echo h($article['Article']['title']);
?></span></a></td>
</tr>
<tr>
<td colspan="2" align="left" valign="top"><span style="font-size:x-small;"><span style="color:#333333;"><?php
echo h($article['Article']['body']);
?></span><br /><span style="color:#339933;"><?php echo $this->DiaryCommon->formatYearsOld($article['Child']['birth_year'], $article['Child']['birth_month']);?>のお友達</span></span></td>
</tr>
<tr>
<td valign="middle">

<?php if (!empty($login_user)) : ?>
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
<?php echo $this->Html->image("icn_hanamaru_btn.gif",
  array("url" => "/hanamarus/add_hanamaru?id={$article['Article']['external_id']}&user_id={$login_user['hash']}&returnPath={$encoded_url}", "alt" => "はなまる", "width" => "100%", "style" => "margin:0 0 3px 0;")); ?>
<?php endif; ?>
</td>
<td align="left" valign="middle"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?><br /><?php echo $this->Html->image("spacer.gif", array("width" => "4", "height" => "1")); ?><span style="font-size:x-small; color:#FF0000;"><?php echo $article['Diary']['hanamaru_count']; ?>ｺ</span></td>
<td align="right" valign="middle"><span style="font-size:x-small; color:#666666;"><?php echo $this->Time->format('n月j日', $article['Article']['release_date']); ?></span></td>
</tr>
</table>

<?php elseif($article['Article']['type'] == 2) : // ニュース?>
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo $color; ?>">
<tr>
<td width="25%" rowspan="2" align="left" valign="top" style=" font-size:x-small; color:#ff9900;"><?php echo $this->Html->image("icn_bule_news.gif", array("alt" => "ニュース", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br />
<?php if (!empty($article['Article']['photo'])) : ?>
<?php echo $this->Html->image($article['Article']['photo'], array("alt" => "ニュース画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); ?>
<?php endif; ?>
</td>
<td colspan="2" align="left" valign="top"><a href="<?php echo $url_news_detail.$article['Article']['external_id']; ?>" style="color:#0099FF;"><span style="font-size:x-small; color:#0099FF;"><?php echo h($article['Article']['title']); ?></span></a></td>
</tr>
<tr>
<td colspan="2" align="left" valign="top"><span style="font-size:x-small; color:#333333;"><?php echo h($article['Article']['body']); ?></span></td>
</tr>
<tr>
<?php if (!empty($login_user)) : ?>
<td valign="middle" nowrap="nowrap" style="white-space:nowrap;"><a href="<?php echo sprintf($url_set_attention, $article['Article']['external_id'], $login_user['hash'], '/'.$this->here); ?>"><?php echo $this->Html->image("icn_attention.gif", array("alt" => "注目", "width" => "100%", "style" => "margin:0 0 3px 0;")); ?></a></td>
<?php endif; ?>
<td align="left" valign="middle"><?php echo $this->Html->image("spacer.gif", array("width" => "4", "height" => "1")); ?><span style="font-size:x-small; color:#FF0000;"><?php echo $article['Article']['attention_count']; ?>ｺ</span></td>
<td align="right" valign="middle"><span style="font-size:x-small; color:#666666;"><?php echo $this->Time->format('n月j日', $article['Article']['release_date']); ?></span></td>
</tr>
</table>

<?php elseif($article['Article']['type'] == 3) : // お知らせ?>
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo $color; ?>">
<tr>
<td width="25%" rowspan="2" align="left" valign="top" nowrap="nowrap" style="white-space:nowrap; font-size:x-small; color:#ff9900;"><?php echo $this->Html->image("icn_yellow_oshirase.gif", array("alt" => "お知らせ", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br />
<?php if (!empty($article['Article']['photo'])) : ?>
<?php echo $this->Html->image($article['Article']['photo'], array("alt" => "お知らせ画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); ?>
<?php endif; ?>
</td>
<td colspan="2" align="left" valign="top"><!--<a href="#" style="color:#ff9900;">--><span style="font-size:x-small; color:#ff9900;"><?php echo $this->Wikiformat->makeLink(h($article['Article']['title'])); ?></span><!--</a>--></td>
</tr>
<tr>
<td colspan="2" align="left" valign="top"><span style="font-size:x-small; color:#333333;"><?php echo h($article['Article']['body']); ?></span></td>
</tr>
<tr>
<td valign="middle" nowrap="nowrap" style="white-space:nowrap; font-size:x-small; color:#333333;"></td>
<td align="left" valign="top"></td>
<td align="right" valign="middle"><span style="font-size:x-small; color:#666666;"><?php echo $this->Time->format('n月j日', $article['Article']['release_date']); ?></span></td>
</tr>
</table>

<?php elseif($article['Article']['type'] == 4) : // 心理テスト?>
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo $color; ?>">
<tr>
<td width="25%" rowspan="2" align="left" valign="top" nowrap="nowrap" style="white-space:nowrap; font-size:x-small; color:#ff9900;"><?php echo $this->Html->image("icn_purple_psycho.gif", array("alt" => "心理テスト", "width" => "100%", "style" => "margin:1px 3px 0 0;")); ?><br />
<?php if (!empty($article['Article']['photo'])) : ?>
<?php echo $this->Html->image($article['Article']['photo'], array("alt" => "心理テスト画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;")); ?>
<?php endif; ?>
</td>
<td colspan="2" align="left" valign="top"><a href="<?php echo $url_test_detail.$article['Article']['external_id']; ?>" style="color:#9933CC;"><span style="font-size:x-small; color:#9933CC;"><?php echo h($article['Article']['title']); ?></span></a></td>
</tr>
<tr>
<td colspan="2" align="left" valign="top"><span style="font-size:x-small; color:#333333;"><?php echo $this->Wikiformat->makeLink($article['Article']['body']); ?>
</span>
</td>
</tr>
<tr>
<td valign="middle" nowrap="nowrap" style="white-space:nowrap; font-size:x-small; color:#333333;"></td>
<td align="left" valign="top" style="font-size:x-small;"></td>
<td align="right" valign="middle"><span style="font-size:x-small; color:#666666;"><?php echo $this->Time->format('n月j日', $article['Article']['release_date']); ?></span></td>
</tr>
</table>
<?php endif; ?>

<?php endforeach; ?>

