<div style="background:#339933;">
<?php echo $this->Html->image("top_nypage_main.gif", array("width" => "100%")); ?><br />
<!-- タブ -->
<?php
$i = 0;
$tabColId=0;

$opt = array('border' => '0', 'style' => 'margin:0 ;', 'class' => 'test');

foreach ($childrenData as $child) {
    extract($child['Child']);
	$tab_index = $i + 1;
    if($id == $currentChild['Child']['id']){
        echo $html->image("tab_btn0{$tab_index}_on.gif", $opt);
        $tabColId = $i;
	}else{
		echo $html->image("tab_btn0{$tab_index}.gif", array_merge($opt, array('url' => "/children/index/{$i}/")));
    }
    $i++;
}
if (count($childrenData) < 3) {
	echo $html->image('tab_btn0'.(count($childrenData) + 1).'_plus.gif', array_merge($opt, array('url' => "/children/register/")));
}
?>
</div>

<!-- 子供情報 -->
<div align="center" style="background:<?php echo sprintf(Configure::read('Child.child_tab_color.'.$tabColId)); ?>; text-align:center;">

<table width="95%" cellpadding="0" cellspacing="0">
<tr>
<td width="30%" rowspan="5">
	<?php
	$img = '';
	$opt = array("width" => "100%", "style" => "margin:5px 2px 5px 0;");

	foreach($diaries as $diary) {
		if ($diary['Diary']['has_image']) {
			$img = $html->image(
				sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']),
				array_merge($opt, array('url'=>'/diaries/info/'.$diary['Diary']['id'].'/' )) );
			break;
		}
	}
	if (empty($img)) {
		$img = $this->Html->image("profile.gif", $opt);
	}
	echo $img;
	?>
</td>
<td><?php echo $this->Html->image("spacer.gif"); ?></td>
</tr>
<tr>
<td align="left" valign="top">
<?php
	$image_file = ($currentChild['Child']['sex'] == 1) ? 'icn_name_girl' : 'icn_name_boy';
	echo $this->Html->image($image_file.'.gif', array("style" => "margin-right:2px;"));
?>
<span style="font-size:x-small; color:#333333;"><?php echo h($currentChild['Child']['nickname']); ?></span></td>
</tr>

<tr>
<td align="left" valign="top"><?php echo $this->Html->image("icn_birth.gif", array("style" => "margin-right:2px;")); ?>
<span style="font-size:x-small; color:#333333;"><?php
		//歳計算
		$yy = $currentChild['Child']['birth_year'];
		$mm = $currentChild['Child']['birth_month'];
		$yyy = date('Y')-$yy;
		$mmm = date('m')-$mm;
		if($mmm < 0) {
			$mmm = $mmm + 12;
			$yyy = $yyy -1;
		} 
		echo $yyy.'才'.$mmm.'ヶ月'; ?>
</span></td>
</tr>

<tr>
<td align="left" valign="top"><?php echo $this->Html->image("icn_course.gif", array("style" => "margin-right:2px;")); ?>
<span style="font-size:x-small; color:#333333;">ｺｰｽ:<a href="#contents"><?php echo Configure::read('LinesString.strings.'.$currentChild['Child']['line_id']); ?></a></span></td>
</tr>
<tr>
<td align="left" valign="top"><?php echo $this->Html->image("icn_present_box.gif", array("style" => "margin-right:2px;")); ?>
<span style="font-size:x-small;"><?php echo $this->Html->link('獲得ﾌﾟﾚｾﾞﾝﾄ一覧', '/presents/#presents'); ?></span></td>
</tr>

</table>

<!-- お知らせ -->
<div style="background:#ff9900;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?></div>

</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_info.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_info.gif", array("width" => "100%")); ?></td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0">

<?php if($this->Session->read('Auth.User.created') > date("Y-m-d H:i:s", strtotime("-7 day"))): ?>
<tr>
<td width="50" valign="top" nowrap="nowrap" style="white-space:nowrap">
<span style="font-size:x-small;color:#ff9900;"><?php $this->Ktai->emoji(0xE6DD); ?></span>
</td>
<td align="left">
<span style="font-size:x-small;"><?php echo $this->Html->link('入会ﾌﾟﾚｾﾞﾝﾄはこちら', '/presents/present_list/-1/'); ?></span>
</td>
</tr>
<?php endif; ?>

<?php foreach($newslist as $news): ?>
<tr>
<td width="60" valign="top" nowrap="nowrap" style="white-space:nowrap"><span style="font-size:x-small;">
<span style="color:#ff9900;">
<span style="color:#ff9900;"><?php echo ($news['news']['start_at'] > date("Y-m-d H:i:s", strtotime("-7 day"))) ? $this->Ktai->emoji(0xE6DD, false) : '&nbsp;・'; ?></span>
</span><?php echo $this->Time->format('n/j', $news['news']['start_at']); ?></span>
</td>
<td align="left">
<span style="font-size:x-small;"><?php echo  $this->Wikiformat->makeLink($news['news']['title']); ?></span>
</td>
</tr>
<?php endforeach; ?>

</table>

<!-- 思い出記録 -->
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%")); ?><br />

<div align="center" style="background:#e9f7ff; text-align:center;">
<?php $month_label = date('n'); ?>
<?php echo $this->Html->image("album_{$month_label}.gif", array("width" => "100%")); ?><br />

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
<br />

<!-- 思い出を見る -->

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_album.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_look.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table>
<span style="color:#339933;">&nbsp;・</span><a href="<?php echo $this->Html->url('/diaries/');?>" style="color:#339900;"><span style="color:#339900;">思い出記録をもっと見る</span></a><br />

<!-- 思い出を形に残す -->

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_leave.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_leave.gif", array("width" => "100%")); ?></td>
</tr>
</table>
<span style="color:#339933;">&nbsp;・</span><a href="<?php echo $this->Html->url('/presents/present_list/2'); ?>" style="color:#339900;"><span style="color:#339900;">世界に1つ!待受画面を作る</span></a><br />
<span style="color:#339933;">&nbsp;・</span><a href="<?php echo $this->Html->url('/presents/present_list/3'); ?>" style="color:#339900;"><span style="color:#339900;">部屋に飾れるﾎﾟｽﾄｶｰﾄﾞを作る</span></a><br />

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<!-- 思い出を書く -->

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_write.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_write.gif", array("width" => "100%")); ?></td>
</tr>
</table>

<?php foreach($months as $month): ?>

<?php foreach($month['Theme'] as $theme): ?>
<?php if (!$theme['free_theme']): ?>
<span style="color:#339933;"><?php echo ($theme['release_date'] > date("Y-m-d H:i:s", strtotime("-7 day"))) ? $this->Ktai->emoji(0xE6DD, false) : '&nbsp;･'; ?></span><a href="<?php echo $this->Html->url('/themes/info/'.$theme['id']);?>" style="color:#339900;"><span style="color:#339900;">【ﾃｰﾏ】<?php echo h($theme['title']);?></span></a><br />
<?php endif; ?>
<?php endforeach; ?>

<?php foreach($month['Theme'] as $theme): ?>
<?php if ($theme['free_theme']): ?>
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/themes/info/'.$theme['id']);?>" style="color:#339900;"><span style="color:#339900;">【ﾌﾘｰ】<?php echo h($theme['title']);?></span></a><br />
<?php endif; ?>
<?php endforeach; ?>

<?php endforeach; ?>
<div align="right" style="text-align:right;"><?php $this->Ktai->emoji(0xE691); ?><a href="<?php echo $this->Html->url('/themes/');?>" style="color:#339900;"><span style="color:#339900;">もっと見る</span></a></div>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj01.gif"); ?></div>

<!-- 今月のプレゼント -->
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_present.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_present.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table>
<?php foreach($months as $month): ?>
	<?php
	$f = true;
	if($month['month']['year'] == date('Y') and ($month['month']['month'] == (date('m')+0))) { ?>
		<?php foreach($month['Present'] as $present): ?>
			<?php
				if($present['present_type'] == 3 and $f) {
					echo $this->Html->image(sprintf(Configure::read('Present.sample.2'), $month['month']['year'], sprintf('%02d', $month['month']['month'])),
                                        array("align" => "left", "style" => "float:left; margin-right:10px;"));
					$f = false;
					break;
				}
			?>
		<?php endforeach; ?>
	<?php } ?>
<?php endforeach; ?>
思い出を残すと､待受やﾎﾟｽﾄｶｰﾄﾞ､ﾃﾝﾌﾟﾚｰﾄなどがもらえるよ!<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<div align="right" style="text-align:right;"><span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE691); ?>
<a href="<?php echo $this->Html->url('/presents/'); ?>" style="color:#339900;"><span style="color:#339900;">もっとみる</span></a></span></div><br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?></div>

<!-- 非会員限定のご案内 -->
<?php if (true): ?>
<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj01.gif"); ?></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_comunity.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_comunity.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table>
<span style="font-size:x-small;">お子様の思い出を､家族や友達と共有できます｡詳しくは<a href="<?php echo $this->Html->url('/diaries/post_info/'); ?>" style="color:#339900;"><span style="color:#339900;">こちら</span></a></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php endif; ?>

<a name="contents" id="contents"></a>
<?php echo $this->Html->image("ttl_challenge.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_mobile.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_challenge_more.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table>

<!-- ライン別の内容 -->
<?php echo $this->element('lines'.DS.$currentLine['Line']['category_name']); ?>
<!-- ライン別ここまで -->

<div align="center" style="text-align:center;"><a href="http://shimajiromobile.benesse.ne.jp/ap1/mail/?guid=ON"><?php echo $this->Html->image("bnr_melmaga.gif", array("width" => "83%", "border" => "0", "style" => "margin:10px 0 0;")); ?></a></div>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj02.gif"); ?></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_tv.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_tv.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table>
<span style="color:#cc0000;">&nbsp;・</span><a href="http://w.benesse.jp/gw/http/sv/front/Page.php?st=62&pg=3640&SESS=" style="color:#ff3333;"><span style="color:#ff3333;">しまじろうﾍｿｶ</span></a><br />
毎週月曜､朝7:30～8:00放送!<br />
新ｶﾝｶｸ☆ｷｯｽﾞ･ﾊﾞﾗｴﾃｨｰ｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#cc0000;">&nbsp;・</span><a href="http://w.benesse.jp/gw/http/sv/front/Page.php?st=58&pg=3641&SESS=" style="color:#ff3333;"><span style="color:#ff3333;">ｺﾝｻｰﾄ</span></a><br />
&lt;こどもちゃんれんじ&gt;ｺﾝｻｰﾄの楽しい情報がいっぱい!<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />


<!-- 設定 -->

<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Html->image("icn_spana.gif"); ?><span style="font-size:x-small;"><?php echo h($this->Session->read('Auth.User.loginid')); ?>さんの設定</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<span style="font-size:x-small;">&nbsp;・</span><a href="<?php echo $this->Html->url('/children/edit_menu/'); ?>" style="color:#666666;"><span style="color:#666666;">子ども情報の追加/変更/削除</span></a><br />
<span style="font-size:x-small;">&nbsp;・</span><a href="<?php echo $this->Html->url('/children/user_menu/'); ?>" style="color:#666666;"><span style="color:#666666;">ﾌﾟﾛﾌｨｰﾙ情報を設定する</span></a><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<div align="right" style="text-align:right;"><?php $this->Ktai->emoji(0xE6E0); ?><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></div>
<br />

