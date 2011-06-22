<div style="background-color:#339933;">
<div><?php echo $this->Html->image("top_nypage_main.gif", array("alt" => "ケータイしまじろうひろば×ドコモコミュニティ", "width" => "100%", "border" => "0")); ?></div>
<div style="background-color:#ff6699;">
<div style="background-color:#339933;"><a href="<?php echo $this->Html->url('/');?>"><?php echo $this->Html->image("tab_btn01_green.gif", array("alt" => "育児なう", "width" => "33%", "border" => "0")); ?></a><a href="<?php echo $this->Html->url('/diaries/top/')?>"><?php echo $this->Html->image("tab_btn02_green.gif", array("alt" => "思い出記録", "width" => "33%", "border" => "0", "class" => "test")); ?></a><?php echo $this->Html->image("tab_btn03_on_green.gif", array("alt" => "こどもちゃれんじ", " width" => "33%", "border" => "0", "class" => "test")); ?></div> 
<div style="background-color:#ff6699;"><?php echo $this->Html->image("spacer.gif", array("height" => "2", "width" => "1")); ?></div>
<div style="background-color:#ffff99;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffd4d4">
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
<td><?php echo $this->Html->image("spacer.gif", array("height" => "5")); ?></td> 
</tr>
<tr>
<td align="left" valign="top">
<?php if (count($childrenData) > 0) : ?>
<?php
	$image_file = ($currentChild['Child']['sex'] == 1) ? 'icn_name_girl' : 'icn_name_boy';
    	$suffix = ($currentChild['Child']['sex'] == 1) ? 'ちゃん' : 'くん';
	echo $this->Html->image($image_file.'.gif', array("style" => "margin-right:2px;"));
?>
<span style="font-size:x-small; color:#333333;"><?php echo h($currentChild['Child']['nickname']).$suffix;?></span>
<?php endif; ?>
</td> 
</tr> 
<tr> 
<td align="left" valign="top">
<?php if (count($childrenData) > 0) : ?>
<?php echo $this->Html->image("icn_birth.gif", array("style" => "margin-right:2px;")); ?>
<span style="font-size:x-small; color:#333333;"><?php echo $this->DiaryCommon->formatYearsOld($currentChild['Child']['birth_year'], $currentChild['Child']['birth_month']); ?></span>
<?php endif; ?>
</td> 
</tr> 
<tr> 
<td align="left" valign="top">

<?php if (count($childrenData) > 0) : ?>
<?php echo $this->Html->image("icn_course.gif", array("style" => "margin-right:2px;")); ?><span style="font-size:x-small; color:#333333;"><?php echo Configure::read('LinesString.strings.'.$currentChild['Child']['line_id']) ; ?></span>
<?php else : ?>
<span style="font-size:x-small; color:#333333;">子どもが登録されていません｡</br>子ども情報を追加してください｡</span>
<?php endif; ?>

</td> 
</tr> 
</table> 
</div> 
</div> 
</div> 
 
<table width="100%" border="0" cellpadding="0" cellspacing="0"> 
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />
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
<td><?php echo $this->Html->image($image_file.".gif", array("style" => "margin-right:2px;")); ?><span style="font-size:x-small; color:#333333;"><a href="<?php echo $this->Html->url("/lines/top/{$tab_index}/"); ?>"><?php echo $nickname;?><?php echo $suffix; ?>に切り替え</a></span></td> 
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


<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="85%">
<?php echo $this->Html->image("txt_petit.gif", array("width" => "100%", "alt" => "こどもちゃれんじぷち")); ?>
</td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="85%"><span style="font-size:x-small; color:#e61953;">1～2歳向けｺｰｽ</span>
</td>
<td width="10%">&nbsp;</td>
</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<a href="#check" style="color:#ff3333;"><span style="color:#ff3333;">ﾁｪｯｸ&amp;ｱﾄﾞﾊﾞｲｽ</span></a> / <a href="#diary" style="color:#ff3333;"><span style="color:#ff3333;">たいけんのきろく</span></a> / <a href="#community" style="color:#ff3333;"><span style="color:#ff3333;">体験談のひろば</span></a><br />

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>
<div align="center" style="text-align:center;"><?php echo $this->Html->image("40_shimajiro.gif", array("width" => "100%", "alt" => "スペシャルアプリ")); ?></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<div align="left" style="text-align:left;"><span style="color:#ff9900;"><?php $this->Ktai->emoji(0xE691); ?></span><a href="<?php echo $this->Html->url("/lines/top/{$tab_index}/petit/index/"); ?>" style="color:#ff3333;"><span style="color:#ff3333; font-size:x-small;">詳しく見る</span></a></div>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<a name="check" id="check"></a>
<div style="background:#f3dfc4;">
<?php echo $this->Html->image("petit_magane.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("petit_maganeimg.gif", array("width" => "30%", "align" => "left", "style" => "float:left; margin-right:5px;")); ?>
ご一緒に､お子さんの気持ちがわかる｢こどもめがね｣で見てみませんか?<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></div>
<div align="left" style="text-align:left;"><span style="color:#ff9900;"><?php $this->Ktai->emoji(0xE691); ?></span><a href="http://shimajiromobile.benesse.ne.jp/ap1/petit/advice/" style="color:#ff3333;"><span style="color:#ff3333;">今月の質問をﾁｪｯｸする</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</div>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<a name="diary" id="diary"></a>
<div style="background:#f4b7c8;">
<?php echo $this->Html->image("petit_kiroku.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("petit_kirokuimg.gif", array("width" => "30%", "align" => "left", "style" => "float:left; margin-right:5px;")); ?>
お子さんの成長を記念に残していきませんか?<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></div>
<div align="left" style="text-align:left;"><span style="color:#ff9900;"><?php $this->Ktai->emoji(0xE691); ?></span><a href="http://shimajiromobile.benesse.ne.jp/ap1/petit/reflection/" style="color:#ff3333;"><span style="color:#ff3333;">記録をみる</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</div>


<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_pink.gif", array()); ?></div>

<a name="community" id="community"></a>
<div style="background:#b4cd59;">
<?php echo $this->Html->image("petit_taiken.gif", array("width" => "100%")); ?><br />
子育てのｱｲﾃﾞｨｱやﾜｻﾞを共有できるひろば!<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<div align="left" style="text-align:left;"><span style="color:#ff9900;"><?php $this->Ktai->emoji(0xE691); ?></span><a href="http://shimajiromobile.benesse.ne.jp/ap1/petit/taiken/" style="color:#ff3333;"><span style="color:#ff3333;">みんなの体験談へ</span></a></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</div>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj02.gif", array("alt" => "")); ?></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_mobile.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_course.gif", array("alt" => "各コースの教材", "width" => "100%")); ?></td>
</tr>
</table>

<?php echo $this->element('default/room'); ?>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_pink.gif", array("alt" => "")); ?></div>

<span style="color:#ff8100;"><?php $this->Ktai->emoji(0xE683); ?></span><a href="http://www.jadm.jp/cp/ad.php?sid=800000&ac=in00107&medium=06" style="color:#ff3333;"><span style="color:#ff3333; font-size:x-small;">&lt;こどもちゃれんじ&gt;入会･<br />資料請求</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#000000;"><?php $this->Ktai->emoji(0xE688); ?></span><a href="http://m.shimajiro.co.jp/" style="color:#ff3333;"><span style="color:#ff3333; font-size:x-small;">有料ｹｰﾀｲしまじろう(公式ｻｲﾄ)</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<span style="color:#cc0000; font-size:x-small">※ﾍﾞﾈｯｾのｻｲﾄに移動します</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Html->image("icn_twitter.gif", array("style" => "margin:0 3px 0 0")); ?><a href="http://twitter.com/kodomochallenge" style="color:#ff3333;"><span style="color:#ff3333; font-size:x-small;">twitterでﾍﾞﾈｯｾの情報配信中</span></a><br />

<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj02.gif", array("alt" => "")); ?></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_tv.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_tv.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table>
<span style="color:#cc0000;">&nbsp;･</span><a href="http://w.benesse.jp/gw/http/sv/front/Page.php?st=62&pg=3640&SESS=" style="color:#ff3333;"><span style="color:#ff3333;">しまじろうﾍｿｶ</span></a><br />
毎週月曜､朝7:30～8:00放送!<br />
新ｶﾝｶｸ☆ｷｯｽﾞ･ﾊﾞﾗｴﾃｨｰ｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#cc0000;">&nbsp;･</span><a href="http://w.benesse.jp/gw/http/sv/front/Page.php?st=58&pg=3641&SESS=" style="color:#ff3333;"><span style="color:#ff3333;">ｺﾝｻｰﾄ</span></a><br />
&lt;こどもちゃれんじ&gt;ｺﾝｻｰﾄの楽しい情報がいっぱい!<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php echo $this->element('contents/docomo_community'); ?>

<!-- ページトップへ -->
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="right" style="text-align:right;"><span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE6E0); ?><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></span></div>
<br />

