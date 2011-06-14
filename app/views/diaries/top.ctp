<a name="top" id="top"></a> 
<div style="font-size:x-small; color:#333333;"> 
<!-- 背景グリーンタブ --> 
<div style="background-color:#339933;"> 
<div><?php echo $this->Html->image("top_nypage_main.gif", array("alt" => "ケータイしまじろうひろば×ドコモコミュニティ", "width" => "100%", "border" => "0")); ?></div> 
<div style="background-color:#66cc00;"> 
<div style="background-color:#339933;"><a href="<?php echo $this->Html->url('/');?>"><?php echo $this->Html->image("tab_btn01_green.gif", array("alt" => "育児なう", "width" => "33%", "border" => "0")); ?></a><?php echo $this->Html->image("tab_btn02_on_green.gif", array("alt" => "思い出記録", "width" => "33%", "border" => "0", "class" => "test")); ?><a href="<?php echo $this->Html->url('/lines/top/');?>"><?php echo $this->Html->image("tab_btn03_green.gif", array("alt" => "こどもちゃれんじ", " width" => "33%", "border" => "0", "class" => "test")); ?></a></div> 
<div style="background-color:#66cc00;"><?php echo $this->Html->image("spacer.gif", array("height" => "2", "width" => "1")); ?></div> 
<div style="background-color:#ffff99;"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ccff99"> 
<tr> 
<td width="25%" rowspan="4" align="left" valign="top">
	<?php
	$img = '';
	$opt = array("alt" => "子ども画像", "width" => "100%", "style" => "margin:5px 2px 5px 0;");

	if(empty($prof_diary)) {
		$img = $this->Html->image('profile.gif', $opt);
	} else {
		$img = $html->image(
			sprintf(Configure::read('Diary.image_path_rect'), $prof_diary['Diary']['child_id'], $prof_diary['Diary']['id']),
			array_merge($opt, array('url'=>'/diaries/info/'.$prof_diary['Diary']['id'].'/' )) );
	}

	echo $img;
	?>
</td> 
<td><?php echo $this->Html->image("spacer.gif", array()); ?></td> 
</tr> 
<tr> 
<td align="left" valign="top">
<?php
    $image_file = ($currentChild['Child']['sex'] == 1) ? 'icn_name_girl' : 'icn_name_boy';
    $suffix = ($currentChild['Child']['sex'] == 1) ? 'ちゃん' : 'くん';
	echo $this->Html->image($image_file.'.gif', array("style" => "margin-right:2px;"));
?>
<span style="font-size:x-small; color:#333333;"><?php echo h($currentChild['Child']['nickname']).$suffix;?></span></td> 
</tr> 
<tr> 
<td align="left" valign="top"><?php echo $this->Html->image("icn_birth.gif", array("style" => "margin-right:2px;")); ?>
<span style="font-size:x-small; color:#333333;"><?php echo $this->DiaryCommon->formatYearsOld($currentChild['Child']['birth_year'], $currentChild['Child']['birth_month']); ?></span>
</td> 
</tr> 
<tr> 
<td align="left" valign="top"><?php echo $this->Html->image("icn_present_box.gif", array("style" => "margin-right:2px;")); ?><span style="font-size:x-small; color:#333333;"><?php echo $this->Html->link('獲得ﾌﾟﾚｾﾞﾝﾄ一覧', '/presents/#presents'); ?></span></td> 
</tr> 
</table> 
</div> 
</div> 
</div> 
 
<table width="100%" border="0" cellpadding="0" cellspacing="0"> 

<?php
$i = 0;
$tabColId=0;

foreach ($childrenData as $child) :
    extract($child['Child']);
	$tab_index = $i + 1;
    if ($id != $currentChild['Child']['id']) :
        $tabColId = $i;

        $image_file = ($sex == 1) ? 'icn_name_girl' : 'icn_name_boy';
        $suffix = ($sex == 1) ? 'ちゃん' : 'くん';
?>
<tr> 
<td><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br /><?php echo $this->Html->image($image_file.".gif", array("style" => "margin-right:2px;")); ?><span style="font-size:x-small; color:#333333;"><a href="<?php echo $this->Html->url("/diaries/top/{$i}/"); ?>"><?php echo $nickname;?><?php echo $suffix; ?>に切り替え</a></span></td> 
</tr> 
<?php
    endif;
    $i++;
endforeach;

if (count($childrenData) < 3) :
?>

<tr> 
<td><?php echo $this->Html->image("icn_name_plus.gif", array("style" => "margin-right:2px;")); ?><span style="font-size:x-small; color:#333333;"><a href="<?php echo $this->Html->url('/children/register/')?>">子ども情報の追加</a></span></td> 
</tr> 

<?php endif; ?>

</table> 
 
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br /> 
<div align="center" style="text-align:center;"><a href="http://docomo-community.cp05.docomo.ne.jp/dj/"><?php echo $this->Html->image("docomo_commu_banner.gif", array("alt" => "ドコモコミュニティ", "width" => "80%", "border" => "0")); ?></a></div> 
<div align="center" style="text-align:center; font-size:x-small; color:#666666"><?php echo $this->Html->image("dot_line_green.gif", array()); ?><br /> 
思い出を書くと<br />ﾌﾟﾚｾﾞﾝﾄがもらえるよ♪</div> 
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br /> 
 
<div align="center" style="background:#e9f7ff; text-align:center;"> 

<?php $month_label = date('n'); ?>
<?php echo $this->Html->image("album_{$month_label}.gif", array("alt" => "{$month_label}月のアルバム1", "width" => "100%")); ?><br />

<table width="90%" cellpadding="0" cellspacing="0" align="center"> 
<tr> 
<td width="33%"><?php
	$i = 0;
	if (isset($diaries[$i])) {
		$diary = $diaries[$i];
		echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']), array('width' => '100%')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
	} else {
		$i++;
		echo $this->Html->image("album_pic0{$i}.gif", array("width" => "100%"));
	}
	?></td>
<td width="33%"><?php
	$i = 1;
	if (isset($diaries[$i])) {
		$diary = $diaries[$i];
		echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']), array('width' => '100%')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
	} else {
		$i++;
		echo $this->Html->image("album_pic0{$i}.gif", array("width" => "100%"));
	}
	?></td>
<td width="33%">
<?php echo $this->Html->image("album_obj01_{$month_label}.gif", array("width" => "100%")); ?>
</td>

</tr> 
</table> 
<table width="90%" cellpadding="0" cellspacing="0" align="center"> 
<tr> 
<td  width="33%" align="right">
<?php echo $this->Html->image("album_obj02_{$month_label}.gif", array("width" => "100%")); ?>
</td>
<td width="33%"><?php
	$i = 2;
	if (isset($diaries[$i])) {
		$diary = $diaries[$i];
		echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']), array('width' => '100%')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
	} else {
		$i++;
		echo $this->Html->image("album_pic0{$i}.gif", array("width" => "100%"));
	}
	?></td>
<td width="33%"><?php
	$i = 3;
	if (isset($diaries[$i])) {
		$diary = $diaries[$i];
		echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']), array('width' => '100%')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
	} else {
		$i++;
		echo $this->Html->image("album_pic0{$i}.gif", array("width" => "100%"));
	}
	?></td>
</tr> 
</table> 
<?php echo $this->Html->image("album_btm.gif", array("width" => "100%")); ?><br /></div> 
 
 
<table width="100%" cellpadding="0" cellspacing="0"> 
<tr> 
<td width="10%"><?php echo $this->Html->image("icn_write.gif", array("width" => "100%")); ?></td> 
<td width="85%"><?php echo $this->Html->image("txt_write.gif", array("alt" => "思い出を書く", "width" => "100%")); ?></td> 
</tr> 
</table>

<?php foreach($months as $month): ?>

<?php
$i=0;
foreach($month['Theme'] as $theme): ?>
<?php if (!$theme['free_theme']):
$i++;
?>
<span style="color:#339933;"><?php echo ($theme['release_date'] > date("Y-m-d H:i:s", strtotime("-7 day"))) ? $this->Ktai->emoji(0xE6DD, false) : '&nbsp;･'; ?></span><a href="<?php echo $this->Html->url('/themes/info/'.$theme['id']);?>" style="color:#339900;"><span style="color:#339900;">【ﾃｰﾏ】<?php echo h($theme['title']);?></span></a><br />
<?php endif; ?>
<?php
if($i==2) {
    break;
}
?>
<?php endforeach; ?>

<?php foreach($month['Theme'] as $theme): ?>
<?php if ($theme['free_theme']): ?>
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/themes/info/'.$theme['id']);?>" style="color:#339900;"><span style="color:#339900;">【ﾌﾘｰ】<?php echo h($theme['title']);?></span></a><br />
<?php endif; ?>
<?php endforeach; ?>

<?php endforeach; ?>
 
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br /> 
<div align="right" style="text-align:right;"><span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE691); ?><a href="<?php echo $this->Html->url('/themes/');?>" style="color:#339900;"><span style="color:#339900;">もっと見る</span></a></span></div><br clear="all" /> 
 
<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array("alt" => "")); ?></div> 


<table width="100%" cellpadding="0" cellspacing="0"> 
<tr> 
<td width="10%"><?php echo $this->Html->image("icn_album.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td> 
<td width="85%"><?php echo $this->Html->image("txt_look.gif", array("alt" => "思い出を見る", "width" => "100%", "style" => "margin-bottom:5px;")); ?></td> 
</tr> 
</table> 
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/diaries/');?>" style="color:#339900;"><span style="color:#339900;">思い出記録をもっと見る</span></a><br /> 
 
 
<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div> 
 
<table width="100%" cellpadding="0" cellspacing="0"> 
<tr> 
<td width="10%"><?php echo $this->Html->image("icn_leave.gif", array("width" => "100%")); ?></td> 
<td width="85%"><?php echo $this->Html->image("txt_makes.gif", array("alt" => "待受&nbsp;･ポストカードを作る", "width" => "100%")); ?></td> 
</tr> 
</table> 
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/presents/present_list/2'); ?>" style="color:#339900;"><span style="color:#339900;">世界に1つ!待受Flashを作る</span></a><br /> 
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/presents/present_list/3'); ?>" style="color:#339900;"><span style="color:#339900;">家族に送れるﾎﾟｽﾄｶｰﾄﾞを作る</span></a><br /> 
 
<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj01.gif", array("alt" => "")); ?></div> 
 
<table width="100%" cellpadding="0" cellspacing="0"> 
<tr> 
<td width="10%"><?php echo $this->Html->image("icn_present.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td> 
<td width="85%"><?php echo $this->Html->image("txt_present.gif", array("alt" => "今月のプレゼント", "width" => "100%", "style" => "margin-bottom:5px;")); ?></td> 
</tr> 
</table> 
<?php echo $this->Html->image("pic_present.jpg", array("align" => "left", "style" => "float:left; margin-right:10px;")); ?>思い出を残すと､待受Flashやﾎﾟｽﾄｶｰﾄﾞなどがもらえる!<br /> 
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br /> 
<div align="right" style="text-align:right;"><span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE691); ?><a href="<?php echo $this->Html->url('/presents/'); ?>" style="color:#339900;"><span style="color:#339900;">もっと見る</span></a></span></div><br clear="all" /> 
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?></div> 
 
<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj01.gif", array()); ?></div> 
 
<table width="100%" cellpadding="0" cellspacing="0"> 
<tr> 
<td width="10%"><?php echo $this->Html->image("icn_comunity.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td> 
<td width="85%"><?php echo $this->Html->image("txt_comunity.gif", array("alt" => "ドコモコミュニティでもっと楽しく！", "width" => "100%", "style" => "margin-bottom:5px;")); ?></td> 
</tr> 
</table> 
<span style="font-size:x-small;">お子さんの思い出を家族や友達と共有できます。詳しくは<a href="<?php echo $this->Html->url('/diaries/post_info/'); ?>" style="color:#339900;"><span style="color:#339900;">こちら</span></a></span><br /> 
 
<!-- ページトップへ --> 
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br /> 
<div align="right" style="text-align:right;"><span style="font-size:x-small;"><?php echo $this->Html->image("emoji/images/123.gif", array("width" => "12", "height" => "12", "border" => "0", "alt" => "")); ?><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></span></div> 
<br /> 
