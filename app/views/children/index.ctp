
<div style="background:#339933;">
<?php echo $this->element('default/logo'); ?>

<!-- �^�u -->
<?php
$i = 0;
$tabColId=0;

$opt = array('border' => '0', 'style' => 'margin:0 1px;', 'class' => 'test');

foreach ($childrenData as $child) {
    extract($child['Child']);
	$tab_index = $i + 1;
    if($child['Child']['id'] == $currentChild['Child']['id']){
        echo $html->image("tab_btn0{$tab_index}_on.gif", $opt);
        $tabColId = $i;
	}else{
		echo $html->image("tab_btn0{$tab_index}.gif", array_merge($opt, array('url' => "/children/index/{$i}/")));
    }
    $i++;
}
if (count($childrenData) < 3) {
	echo $html->image('tab_btn0'.count($childrenData) + 1.'_plus.gif', array_merge($opt, array('url' => "/children/register/")));
}
?>

</div>

<!-- �q����� -->

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
				array_merge($opt, array('url'=>'/diaries/info/'.$diary['Diary']['id'].'/' )), );
			break;
		}
	}
	if (empty($img)) {
		$img = $this->Html->image("album_pic01.jpg", $opt);
	}
	echo $img;
	?>
</td>
<td><?php echo $this->Html->image("spacer.gif"); ?></td>
</tr>
<tr>
<td align="left" valign="top">
<?php
if ($currentChild['Child']['sex'] == 1) {
	echo $this->Html->image("icn_name_girl.gif", array("style" => "margin-right:2px;"));
} else {
	echo $this->Html->image("icn_name_boy.gif", array("style" => "margin-right:2px;"));
}
?>
<span style="font-size:x-small; color:#333333;"><?php echo h($currentChild['Child']['nickname']); ?></span></td>
</tr>

<tr>
<td align="left" valign="top"><?php echo $this->Html->image("icn_birth.gif", array("style" => "margin-right:2px;")); ?>
<span style="font-size:x-small; color:#333333;">
	<?php
		//�Όv�Z
		$yy = $currentChild['Child']['birth_year'];
		$mm = $currentChild['Child']['birth_month'];
		$yyy = date('Y')-$yy;
		$mmm = date('m')-$mm;
		if($mmm < 0) {
			$mmm = $mmm + 12;
			$yyy = $yyy -1;
		} 
		echo $yyy.'��'.$mmm.'����'; ?>
</span></td>
</tr>

<tr>
<td align="left" valign="top"><?php echo $this->Html->image("icn_course.gif", array("style" => "margin-right:2px;")); ?>
<span style="font-size:x-small; color:#333333;">���:<?php echo $html->link(
	Configure::read('LinesString.strings.'.$currentChild['Child']['line_id']), 
	'/ap/'.$currentLine['Line']['category_name'].'/');?></span></td>
</tr>

<tr>
<td align="left" valign="top"><?php echo $this->Html->image("icn_present.gif", array("style" => "margin-right:2px;")); ?>
<span style="font-size:x-small;"><?php echo $this->Html->link('�l����ھ��Ĉꗗ', '/presents/'); ?></span></td>
</tr>

</table>

<!-- ���m�点 -->

<div style="background:#ff9900;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?></div>

</div>
<br />

<?php echo $this->Html->image("txt_info.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<table width="100%" cellpadding="0" cellspacing="0">

<?php foreach($newslist as $news): ?>
<tr>
<td width="50" valign="top"><span style="font-size:x-small;"><span style="color:#ff9900;">�</span>
<?php echo $this->Time->format('n/d', $news['news']['start_at']); ?>
</span></td>
<td align="left">
<span style="font-size:x-small;"> <?php echo $this->Html->link($news['news']['title'], '/news/info/'.$news['news']['id']); ?> </span>
</td>
</tr>
<?php endforeach; ?>

</table>

<?php if($this->Session->read('Auth.User.created') > date("Y-m-d H:i:s", strtotime("-7 day"))): ?>
	<?php echo $this->Html->link('�������v���[���g', '/presents/user_only'); ?>
<?php endif; ?>
<br />

<!-- �v���o�L�^ -->

<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("album_5.gif", array("width" => "100%")); ?><br />
<div align="center" style="background:#e9f7ff; text-align:center;">
<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>

<td width="33%"><?php
	$i = 0;
	if (isset($diaries[$i])) {
		$diary = $diaries[$i];
		echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']), array('width' => '100%')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
	} else {
		$i++;
		echo $this->Html->image("top/album_pic0{$i}.jpg", array("width" => "100%"));
	}
	?></td>
<td width="33%"><?php
	$i = 1;
	if (isset($diaries[$i])) {
		$diary = $diaries[$i];
		echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']), array('width' => '100%')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
	} else {
		$i++;
		echo $this->Html->image("top/album_pic0{$i}.jpg", array("width" => "100%"));
	}
	?></td>
<td width="33%"><?php echo $this->Html->image("obj01.gif", array("width" => "100%")); ?></td>

</tr>
</table>
<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td  width="33%" align="right"><?php echo $this->Html->image("obj02.gif", array("width" => "100%")); ?></td>
<td width="33%"><?php
	$i = 2;
	if (isset($diaries[$i])) {
		$diary = $diaries[$i];
		echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']), array('width' => '100%')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
	} else {
		$i++;
		echo $this->Html->image("top/album_pic0{$i}.jpg", array("width" => "100%"));
	}
	?></td>
<td width="33%"><?php
	$i = 3;
	if (isset($diaries[$i])) {
		$diary = $diaries[$i];
		echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']), array('width' => '100%')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
	} else {
		$i++;
		echo $this->Html->image("top/album_pic0{$i}.jpg", array("width" => "100%"));
	}
	?></td>
</tr>
</table>
</div>

<?php echo $this->Html->image("album_btm.gif", array("width" => "100%")); ?><br />
<br />

<!-- �v���o������ -->

<?php echo $this->Html->image("txt_look.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<span style="color:#339900;">�</span><a href="<?php echo $this->Html->url('/diaries/');?>" style="color:#339900;"><span style="color:#339900;">�v���o�L�^�������ƌ���</span></a><br />

<!-- �v���o���`�Ɏc�� -->

<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<?php echo $this->Html->image("txt_leave.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<span style="color:#339900;">�</span><a href="<?php echo $this->Html->url('/presents/present_list/2'); ?>" style="color:#339900;"><span style="color:#339900;">���E��1��!�Ҏ��ʂ����</span></a><br />
<span style="color:#339900;">�</span><a href="<?php echo $this->Html->url('/presents/present_list/3'); ?>" style="color:#339900;"><span style="color:#339900;">�����ɏ����!�߽Ķ��ނ����</span></a><br />

<?php echo $this->Html->image("dot_line_green.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<!-- �v���o������ -->

<?php echo $this->Html->image("txt_write.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />

<?php foreach($months as $month): ?>

<?php foreach($month['Theme'] as $theme): ?>
<?php if (!$theme['free_theme']): ?>
<span style="color:#339900;">�</span><a href="<?php echo $this->Html->url('/themes/info/'.$theme['id']);?>" style="color:#339900;"><span style="color:#339900;">�yðρz<?php echo h($theme['title']);?></span></a><br />
<?php endif; ?>
<?php endforeach; ?>

<?php foreach($month['Theme'] as $theme): ?>
<?php if ($theme['free_theme']): ?>
<span style="color:#339900;">�</span><a href="<?php echo $this->Html->url('/themes/info/'.$theme['id']);?>" style="color:#339900;"><span style="color:#339900;">�y�ذ�z<?php echo h($theme['title']);?></span></a><br />
<?php endif; ?>
<?php endforeach; ?>

<?php endforeach; ?>

<?php echo $this->Html->image("line_obj01.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<!-- �����̃v���[���g -->
<?php echo $this->Html->image("txt_present.gif"); ?><br />
<?php foreach($months as $month): ?>
	<?php
	$f = true;
	if($month['month']['year'] == date('Y') and ($month['month']['month'] == (date('m')+0))) { ?>
		<?php foreach($month['Present'] as $present): ?>
			<?php
				if($present['present_type'] == 3 and $f) {
					echo $html->image('/'.sprintf(Configure::read('Present.path.postcard_thum'), $present['id']),
						array("align" => "left", "style" => "float:left; margin-right:10px;"));
					$f = false;
					break;
				}
			?>
		<?php endforeach; ?>
	<?php } ?>
<?php endforeach; ?>
�v���o���c���Ƥ�Ҏ���߽Ķ��ޤ����ڰĂȂǂ����炦���!<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<div align="right" style="text-align:right;"><span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE691); ?>
<a href="<?php echo $this->Html->url('/presents/'); ?>" style="color:#339900;"><span style="color:#339900;">�����Ƃ݂�</span></a></span></div><br clear="all" />

<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?></div>

<!-- ��������̂��ē� -->
<?php if (true): ?>
<?php echo $this->Html->image("line_obj01.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<?php echo $this->Html->image("txt_comunity.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />

<span style="font-size:x-small;">���q�l�̎v���o��Ƒ���F�B�Ƌ��L�ł��܂���ڂ�����<a href="#" style="color:#339900;"><span style="color:#339900;">������</span></a></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php endif; ?>

<?php echo $this->Html->image("ttl_challenge.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<?php echo $this->Html->image("txt_challenge_more.gif", array("style" => "margin-bottom:5px;")); ?><br />

<!-- ���C���ʂ̓��e -->
<?php echo $this->element('lines'.DS.$currentLine['Line']['category_name']); ?>
<!-- ���C���ʂ����܂� -->

<div align="center" style="text-align:center;"><a href="#"><?php echo $this->Html->image("bnr_melmaga.gif", array("width" => "83%", "border" => "0", "style" => "margin:5px 0 0;")); ?></a></div>

<?php echo $this->Html->image("line_obj02.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<?php echo $this->Html->image("txt_tv.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<a href="#" style="color:#ff3333;"><span style="color:#ff3333;">����܂��낤Ϳ�</span></a><br />
���T���j���7:30�`8:00����!<br />
�V�ݶ������ޥ��״è��<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<a href="#" style="color:#ff3333;"><span style="color:#ff3333;">��ݻ��</span></a><br />
&lt;���ǂ��������&gt;�ݻ�Ă̊y������񂪂����ς�!<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />


<!-- �ݒ� -->

<?php echo $this->Html->image("ttl_setting.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<?php echo $this->Html->image("icn_spana.gif", array()); ?><span style="font-size:x-small;"><?php echo h($this->Session->read('Auth.User.loginid')); ?>����̐ݒ�</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<span style="font-size:x-small;">�</span><a href="<?php echo $this->Html->url('/children/edit_menu/'); ?>" style="color:#666666;"><span style="color:#666666;">�q�ǂ����̒ǉ�/�ύX/�폜</span></a><br />
<span style="font-size:x-small;">�</span><a href="<?php echo $this->Html->url('/children/user_menu/'); ?>" style="color:#666666;"><span style="color:#666666;">հ�ް����ݒ肷��</span></a><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<div align="right" style="text-align:right;"><?php $this->Ktai->emoji(0xE6E0); ?><a href="#top" accesskey="#">�߰�ޏ��</a></div>
<br />

