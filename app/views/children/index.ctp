<div style="background:#339933;">

<?php echo $this->element('default/logo'); ?>

<?php if(count($childrenData) > 0) { ?>
<?php
// 配列の値を改行しながらすべて出力
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
<?php echo $this->Html->image('top/icn_name.gif', array('style'=>'margin-right:2px;')); ?>
	<span style="font-size:x-small;"><?php echo $currentChild['Child']['nickname']; ?></span></td>
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

<?php if($this->Session->read('Auth.User.created') > date("Y-m-d H:i:s", strtotime("-7 day"))) { ?>
	<?php echo $this->Html->link('会員限定プレゼント', '/presents/user_only'); ?>
<?php } ?>

<br>


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


<br>
<h3>思い出を書く</h3>
<?php foreach($months as $month): ?>
    <?php foreach($month['Theme'] as $theme): ?>
    <?php
        if(!$theme['free_theme']){
            echo "<p>【ﾃｰﾏ】";
            echo $this->Html->link($theme['title'], '/themes/info/'.$theme['id']);
            echo "</p>";
        }
    ?>
    <?php endforeach; ?>
    <?php foreach($month['Theme'] as $theme): ?>
    <?php
        if($theme['free_theme']){
            echo "<p>【自由】";
            echo $this->Html->link($theme['title'], '/themes/info/'.$theme['id']);
            echo "</p>";
        }
    ?>
    <?php endforeach; ?>
<?php endforeach; ?>
<br>
<div>
<?php echo $this->Html->link('もっと見る', '/themes/'); ?>
</div>
<br>
<h3>今月のプレゼント</h3>
<div>
    <table>
        <tr>
            <td>
            <?php foreach($months as $month): ?>
                <?php
                $f = true;
                if($month['month']['year'] == date('Y') and ($month['month']['month'] == (date('m')+0))) { ?>
                    <?php foreach($month['Present'] as $present): ?>
                        <?php
                            if($present['present_type'] == 3 and $f) {
                                echo $html->image('/'.sprintf(Configure::read('Present.path.postcard_thum'), $present['id']) ,array('width' => '55px', 'height' => '80px'));
                                $f = false;
                            }
                        ?>
                    <?php endforeach; ?>
                <?php } ?>
            <?php endforeach; ?>
            </td>
            <td>
                思い出を残すと待受けやポストカードテンプレート等がもらえるよ!!
            </td>
        </tr>
     </table>
</div>
<br>
<div>
<?php echo $this->Html->link('詳しくはこちら', '/presents/'); ?>
</div>
<br>
<h3>こどもちゃれんじ</h3>

<?php
echo $this->element('lines'.DS.$currentLine['Line']['category_name']);
?>

<br><hr><br>
<div><span><?php echo $this->Session->read('Auth.User.loginid');  ?>さんの設定</span></div>
<div>
    <?php echo $html->link(__('子供情報を追加/変更/削除する', true), array('action' => 'edit_menu')); ?>
</div>
<div>
    <?php echo $html->link(__('ユーザー情報を設定する', true), array('action' => 'user_menu')); ?>
</div>
<?php }  else { ?>
<div>子供情報を登録してください。</div>
<br><hr><br>
<div><span><?php echo $this->Session->read('Auth.User.loginid'); ?>さんの設定</span></div>
<div>
    <?php echo $html->link(__('子供情報を追加/変更/削除する', true), array('action' => 'edit_menu')); ?>
</div>
<div>
    <?php echo $html->link(__('ユーザー情報を設定する', true), array('action' => 'user_menu')); ?>
</div>
<?php } ?>
