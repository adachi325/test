<div style="background:#339933;">

<?php echo $this->element('default/logo'); ?>
<!-- タブ -->
<?php
$i = 0;
$tabColId=0;

$opt = array('border' => '0', 'style' => 'margin:0 1px;', 'class' => 'test');

foreach ($childrenData as $child) {
    extract($child['Child']);
	$tab_index = $i + 1;
    if($child['Child']['id'] == $currentChild['Child']['id']){
        echo $html->image("top/tab_btn0{$tab_index}.gif", $opt);
        $tabColId = $i;
	}else{
		echo $html->image("top/tab_btn0{$tab_index}.gif", array_merge($opt, array('url' => "/children/index/{$i}/")));
    }
    $i++;
}

if (count($childrenData) < 3) {
    // echo '<span>';
    // echo $html->link('+', "/children/register/");
    // echo '</span> ';
}?>
</div>
<!-- 子供情報 -->
<div align="center" style="background:<?php echo sprintf(Configure::read('Child.child_tab_color.'.$tabColId)); ?>; text-align:center;">
<table width="230" cellpadding="0" cellspacing="0">
<tr>
<td width="75" rowspan="5">
	<?php
	$img = '';
	foreach($diaries as $diary) {
		if ($diary['Diary']['has_image']) {
			$img = $html->image(
				sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']),
				array('url'=>'/diaries/info/'.$diary['Diary']['id'], 'width' => '55px', 'height' => '55px'));
			break;
		}
	}

	if (empty($img)) {
		$img = $html->image('common'.'/dummy_2.jpg' ,array('width' => '55px', 'height' => '55px'));
	}
	echo $img;
	?>
</td>
<td> <?php echo $this->Html->image('spacer.gif'); ?> </td>
</tr>
<tr>
<td align="left" valign="top">

<?php
//echo $html->image('common'.'/sex'.$currentChild['Child']['sex'].'.jpg' ,array('width' => '20px', 'height' => '20px'));
?>
<?php echo $this->Html->image('top/icn_name.gif', array('style'=>'margin-right:2px;')); ?>
	<span style="font-size:x-small;"><?php echo h($currentChild['Child']['nickname']); ?></span></td>
</tr>
<tr>
<td align="left" valign="top">
<?php echo $this->Html->image('top/icn_birth.gif', array('style'=>'margin-right:2px;')); ?>
	<span style="font-size:x-small;">
	<?php
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
<td align="left" valign="top">
<?php echo $this->Html->image('top/icn_course.gif', array('style'=>'margin-right:2px;')); ?>
<span style="font-size:x-small;">ｺｰｽ:<?php echo $html->link(
	Configure::read('LinesString.strings.'.$currentChild['Child']['line_id']), 
	'/ap/'.$currentLine['Line']['category_name'].'/');?></span></td>
</tr>
<tr>
<td align="left" valign="top">
<?php echo $this->Html->image('top/icn_present.gif', array('style'=>'margin-right:2px;')); ?>
	<span style="font-size:x-small;"><?php echo $this->Html->link('･獲得ﾌﾟﾚｾﾞﾝﾄ一覧', '/presents/'); ?></span></td>
</tr>
</table>
<div style="background:#ff9900;"><?php echo $this->Html->image('spacer.gif', array('width' => '1', 'height' => '1')); ?></div>
</div>

<br>

<!-- お知らせ -->

<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left">
<?php echo $this->Html->image('top/txt_info.gif', array('style'=>'margin-bottom:5px;')); ?>
</td>
</tr>

<?php foreach($newslist as $news): ?>
<tr>
<td width="45" valign="top"><span style="font-size:x-small;"><span style="color:#ff9900;">･</span>
<?php echo $this->Time->format('n/d', $news['news']['start_at']); ?>
</span></td>
<td width="185" align="left">
<span style="font-size:x-small;"> <?php echo $this->Html->link($news['news']['title'], '/news/info/'.$news['news']['id']); ?> </span>
</td>
</tr>
<?php endforeach; ?>

</table>
</div>

<?php if($this->Session->read('Auth.User.created') > date("Y-m-d H:i:s", strtotime("-7 day"))): ?>
	<?php echo $this->Html->link('会員限定プレゼント', '/presents/user_only'); ?>
<?php endif; ?>

<br>

<!-- 思い出記録 -->

<?php echo $this->Html->image('top/ttl_memory.gif'); ?><br />
<?php
   	$m = date('n');
	echo $this->Html->image("top/album_{$m}.gif"); 
?><br />
<div align="center" style="background:#e9f7ff; text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="78">
<?php
	$i = 0;
	if (isset($diaries[$i])) {
		$diary = $diaries[$i];
		echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('width' => '55px', 'height' => '55px')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
	} else {
		$i++;
		echo $this->Html->image("top/album_pic0{$i}.jpg");
	}
	?>
</td>
<td width="78">
<?php
	$i = 1;
	if (isset($diaries[$i])) {
		$diary = $diaries[$i];
		echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('width' => '55px', 'height' => '55px')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
	} else {
		$i++;
		echo $this->Html->image("top/album_pic0{$i}.jpg");
	}
	?>
</td>
<td><?php echo $this->Html->image('top/obj01.gif'); ?></td>
</tr>
</table>

<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td><?php echo $this->Html->image('top/obj02.gif'); ?></td>
<td width="78">
<?php
	$i = 2;
	if (isset($diaries[$i])) {
		$diary = $diaries[$i];
		echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('width' => '55px', 'height' => '55px')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
	} else {
		$i++;
		echo $this->Html->image("top/album_pic0{$i}.jpg");
	}
	?>
</td>
<td width="78">
<?php
	$i = 3;
	if (isset($diaries[$i])) {
		$diary = $diaries[$i];
		echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('width' => '55px', 'height' => '55px')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
	} else {
		$i++;
		echo $this->Html->image("top/album_pic0{$i}.jpg");
	}
	?>
</td>
</tr>
</table>
</div>
<?php echo $this->Html->image('top/album_btm.gif'); ?><br />
<br />

<!-- 思い出を見る -->

<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left">
	<?php echo $this->Html->image('top/txt_look.gif', array('style'=>'margin-bottom:5px;')); ?>
</td>
</tr>
<tr>
<td width="1" valign="top"><span style="font-size:x-small; color:#339900;">･</span></td>
<td width="229" align="left"><a href="<?php echo $this->Html->url('/diaries/');?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">思い出記録をもっと見る</span></a></td>
</tr>
</table>
</div>

<?php echo $this->Html->image('top/dot_line.gif', array('style'=>'margin:10px 0;')); ?><br />

<!-- 思い出を形に残す -->

<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left">
<?php echo $this->Html->image('top/txt_leave.gif', array('style'=>'margin-bottom:5px;')); ?>
</td>
</tr>
<tr>
<td width="1" valign="top"><span style="font-size:x-small; color:#339900;">･</span></td>
<td width="229" align="left"><a href="<?php echo $this->Html->url('/presents/present_list/2'); ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">世界に1つ!待受画面を作る</span></a></td>
</tr>
<tr>
<td valign="top"><span style="font-size:x-small; color:#339900;">･</span></td>
<td align="left"><a href="<?php echo $this->Html->url('/presents/present_list/3'); ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">お部屋に飾れる!ﾎﾟｽﾄｶｰﾄﾞを作る</span></a></td>
</tr>
</table>
</div>

<?php echo $this->Html->image('top/dot_line.gif', array('style'=>'margin:10px 0;')); ?><br />

<!-- 思い出を書く -->


<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left">
	<?php echo $this->Html->image('top/txt_write.gif', array('style'=>'margin-bottom:5px;')); ?>
</td>
</tr>

<?php foreach($months as $month): ?>

<?php foreach($month['Theme'] as $theme): ?>
<?php if (!$theme['free_theme']): ?>
<tr>
<td width="1" valign="top"><span style="font-size:x-small; color:#339900;">･</span></td>
<td width="229" align="left"><a href="<?php echo $this->Html->url('/themes/info/'.$theme['id']);?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">【ﾃｰﾏ】<?php echo h($theme['title']);?></span></a></td>
</tr>
<?php endif; ?>
<?php endforeach; ?>

<?php foreach($month['Theme'] as $theme): ?>
<?php if ($theme['free_theme']): ?>
<tr>
<td width="1" valign="top"><span style="font-size:x-small; color:#339900;">･</span></td>
<td width="229" align="left"><a href="<?php echo $this->Html->url('/themes/info/'.$theme['id']);?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">【ﾌﾘｰ】<?php echo h($theme['title']);?></span></a></td>
</tr>
<?php endif; ?>
<?php endforeach; ?>

<?php endforeach; ?>
</table>
</div>

<?php echo $this->Html->image('top/line_obj01.gif', array('style'=>'margin:10px 0;')); ?><br />


<!-- 今月のプレゼント -->


<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left"> <?php echo $this->Html->image('top/txt_present.gif'); ?> </td>
</tr>

<tr>
<td width="65">

<?php foreach($months as $month): ?>
	<?php
	$f = true;
	if($month['month']['year'] == date('Y') and ($month['month']['month'] == (date('m')+0))) { ?>
		<?php foreach($month['Present'] as $present): ?>
			<?php
				if($present['present_type'] == 3 and $f) {
					echo $html->image('/'.sprintf(Configure::read('Present.path.postcard_thum'), $present['id']) ,array('width' => '55px', 'height' => '80px'));
					$f = false;
					break;
				}
			?>
		<?php endforeach; ?>
	<?php } ?>
<?php endforeach; ?>

</td><td width="165" valign="top" align="left"><span style="font-size:x-small;">思い出を残すと､待受やﾎﾟｽﾄｶｰﾄﾞやﾃﾝﾌﾟﾚｰﾄなどがもらえるよ!</span><br />
<?php echo $this->Html->image('spacer.gif', array('alt'=>'', 'width' => '1', 'height' => '5')); ?><br />
<div align="right" style="text-align:right;"><span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE691); ?>
<a href="<?php echo $this->Html->url('/presents/'); ?>" style="color:#339900;"><span style="color:#339900;">もっとみる</span></a></span></div></td>
</tr>
</table>
</div>

<?php if (true): ?>

<?php echo $this->Html->image('top/line_obj01.gif', array('style'=>'margin:10px 0;')); ?><br />

<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="left">
<?php echo $this->Html->image('top/txt_comunity.gif', array('style'=>'margin-bottom:5px;')); ?>
</td>
</tr>
<tr>
<td align="left"><span style="font-size:x-small;">お子様の思い出を家族や友達と共有できます。詳しくは<a href="<?php echo $this->Html->url('/diaries/post_info/');?>" style="color:#339900;"><span style="color:#339900;">こちら</span></a></span></td></td>
</tr>
</table>
</div>
<br />

<?php endif; ?>

<!-- こどもちゃれんじ -->

<?php echo $this->Html->image('top/ttl_challenge.gif', array('style'=>'margin-bottom:5px;')); ?><br />

<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left">
<?php echo $this->Html->image('top/txt_challenge.gif', array('style'=>'margin-bottom:5px;')); ?>
</td>
</tr>

<!-- ライン別の内容 -->

<?php echo $this->element('lines'.DS.$currentLine['Line']['category_name']); ?>

<tr>
<td valign="top"><span style="font-size:x-small; color:#cc0000;"><?php $this->Ktai->emoji(0xE6DD); ?></span></td>
<td align="left"><span style="font-size:x-small;">いきものｸｲｽﾞ(5/30更新予定)</span></td>
</tr>

<tr>
<td width="1" valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td>
<td width="229" align="left"><a href="#" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;">いっぱい食べよう【Flash】</span></a></td>
</tr>

<tr>
<td valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td>
<td align="left"><a href="#" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;">わんわんと遊ぼう【動画】</span></a></td>
</tr>

<tr>
<td valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td>
<td align="left"><a href="#" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;">はみがきできたよ【Flash】</span></a></td>
</tr>

<tr>
<td colspan="2" align="right"><img src="img/spacer.gif" width="1" height="5" /><br />
<span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE691); ?><a href="#" style="color:#ff3333;"><span style="color:#ff3333;">もっとみる</span></a></span></td>
</tr>

<!-- ライン別ここまで -->

</table>
</div>
<br />

<div align="center" style="text-align:center;"><a href="#"><img src="img/top/bnr_melmaga.gif" border="0" style="margin:5px 0 0;" /></a></div>

<?php echo $this->Html->image('top/line_obj02.gif', array('style'=>'margin:10px 0;')); ?><br />

<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left"> <?php echo $this->Html->image('top/txt_tv.gif', array('style'=>'margin-bottom:5px;')); ?> </td>
</tr>
<tr>
<td width="65" valign="top"> <?php echo $this->Html->image('top/pic_tv.gif', array('style'=>'margin-bottom:5px;')); ?> </td>
<td width="165" align="left" valign="top"><span style="font-size:x-small;">
<a href="#" style="color:#ff3333;"><span style="color:#ff3333;">しまじろうﾍｿｶ</span></a><br />
毎週月曜、朝7:30～<br />
8:00放送！新ｶﾝｶｸ☆<br />
ｷｯｽﾞ･ﾊﾞﾗｴﾃｨｰ。</span><br />
<?php echo $this->Html->image('spacer.gif', array('width'=>'1', 'height'=>'10')); ?>
</td>
</tr>
<tr>
<td width="65" valign="top">
<?php echo $this->Html->image('top/pic_connert.jpg'); ?>
</td>
<td width="165" align="left" valign="top"><span style="font-size:x-small;">
<a href="#" style="color:#ff3333;"><span style="color:#ff3333;">ｺﾝｻｰﾄ</span></a><br />
&lt;こどもちゃんれんじ&gt;<br />
ｺﾝｻｰﾄの楽しい情報がいっぱい！</span></td>
</tr>
</table>
</div>
<br />


<!-- 設定 -->

<?php echo $this->Html->image('top/ttl_setting.gif', array('style'=>'margin-bottom:5px;')); ?><br />

<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left">
	<?php echo $this->Html->image('top/icn_spana.gif'); ?>
<span style="font-size:x-small;"><?php echo h($this->Session->read('Auth.User.loginid')); ?>さんの設定</span><br />
<?php echo $this->Html->image('spacer.gif', array('alt'=>'', 'width' => '1', 'height' => '5')); ?></td>
</tr>
<tr>
<td width="1" valign="top"><span style="font-size:x-small;">･</span></td>
<td width="229" align="left"><a href="<?php echo $this->Html->url('/childlen/edit_menu/'); ?>" style="color:#666666;"><span style="font-size:x-small; color:#666666;">子ども情報の追加/変更/削除</span></a></td>
</tr>
<tr>
<td valign="top"><span style="font-size:x-small;">･</span></td>
<td align="left"><a href="<?php echo $this->Html->url('/childlen/user_menu/'); ?>" style="color:#666666;"><span style="font-size:x-small; color:#666666;">ﾕｰｻﾞｰ情報を設定する</span></a></td>
</tr>
</table>
</div>
<br />

<div align="right" style="text-align:right;"><span style="font-size:x-small;">
<?php $this->Ktai->emoji(0xE6E0); ?><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></span></div>
<br />

