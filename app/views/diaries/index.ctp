<?php /* 207 思い出記録一覧 */ ?>
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="center" style="background:#e9f7ff; text-align:center;">

<?php $month_label = $options['month']; ?>
<?php echo $this->Html->image("album_{$month_label}.gif", array("width" => "100%")); ?><br />

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="33%"><?php
	$i = 0;
	if (isset($diariesTop[$i])) {
    $diary = $diariesTop[$i];
    if ($diariesTop[$i]['Diary']['has_image']) {
      echo $html->link($this->DiaryCommon->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']), array("width" => "100%")), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
    } else {
      echo $html->link($html->image('omoide_nophoto.gif', array("width" => "100%")), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
    }
	} else {
		$i++;
		echo $this->Html->image("album_pic0{$i}.gif", array("width" => "100%"));
	}
	?></td>
<td width="33%"><?php
	$i = 1;
	if (isset($diariesTop[$i])) {
		$diary = $diariesTop[$i];
    if ($diariesTop[$i]['Diary']['has_image']) {
      echo $html->link($this->DiaryCommon->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']), array("width" => "100%")), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
    } else {
      echo $html->link($html->image('omoide_nophoto.gif', array("width" => "100%")), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
    }
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
<td width="33%" align="right">
<?php echo $this->Html->image("album_obj02_{$month_label}.gif", array("width" => "100%")); ?>
</td>
<td width="33%"><?php
	$i = 2;
	if (isset($diariesTop[$i])) {
		$diary = $diariesTop[$i];
    if ($diariesTop[$i]['Diary']['has_image']) {
      echo $html->link($this->DiaryCommon->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']), array("width" => "100%")), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
    } else {
      echo $html->link($html->image('omoide_nophoto.gif', array("width" => "100%")), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
    }
	} else {
		$i++;
		echo $this->Html->image("album_pic0{$i}.gif", array("width" => "100%"));
	}
	?></td>
<td width="33%"><?php
	$i = 3;
	if (isset($diariesTop[$i])) {
		$diary = $diariesTop[$i];
    if ($diariesTop[$i]['Diary']['has_image']) {
      echo $html->link($this->DiaryCommon->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']), array("width" => "100%")), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
    } else {
      echo $html->link($html->image('omoide_nophoto.gif', array("width" => "100%")), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
    }
	} else {
		$i++;
		echo $this->Html->image("album_pic0{$i}.gif", array("width" => "100%"));
	}
	?></td>
</tr>
</table>
<?php echo $this->Html->image("album_btm.gif", array("width" => "100%")); ?><br /></div>
<br />


<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_album.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_look.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?></td>
</tr>
</table>

<span style="color:#339933;">&nbsp;･</span><?php echo $month_label; ?>月の思い出<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<div align="center" style="background:#e9f7ff; text-align:center;">

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<?php echo '全'.count($diaries).'件 '; ?>&nbsp;
<?php if($page > 1) { echo(($page*5)-4); } else if(count($diaries) == 0) { echo('0'); } else { echo($page); }
	if(($page*5) < count($diaries)) {echo ('件～'.($page*5).'件を表示'); } else {echo ('件～'.count($diaries).'件を表示');}
?><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<table width="100%" cellpadding="0" cellspacing="0" align="center">

<?php
$d = 0;$i = 0;$s = 0;
if($page > 1) { $d = ($page-1)*5; } else { $d = 0; }
foreach($diaries as $diary):
    $s++;
    if((int)$s > (int)$d and (int)$i < (int)5) {
?>
	<tr>
	<td width="25%" rowspan="3" valign="top">
	<?php
	echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5"));
	if ($diary['Diary']['has_image']) {
		echo $this->DiaryCommon->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array("width" => "60", "height" => "60", "style" => "margin:0 5px 5px 0;"));
	} else {
		echo $this->Html->image("omoide_nophoto.gif", array("width" => "60", "height" => "60", "style" => "margin:0 5px 5px 0;"));
	}
	echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5"));
	?>
	</td>
  <td width="75%" align="left" valign="top">
  <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
	<?php $title = (!empty($diary['Diary']['title'])) ? $diary['Diary']['title'] : '無題'; ?>
  <a href="<?php echo $this->Html->url('/diaries/info/'.$diary['Diary']['id']); ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;"><?php echo h($title); ?></span></a><br />
  </tr>
  <tr>
    <td align="left" valign="top"><span style="font-size:x-small; color:#333333;"><?php echo $this->DiaryCommon->publicStatus($diary['Diary']['wish_public'], $diary['Diary']['permit_status'], $diary['Article']['release_date'], true); ?></span></td>
  </tr>
  <tr>
    <td align="right" valign="top">
    <?php if ($diary['Diary']['hanamaru_count'] > 0) { ?>
      <?php echo $ktai->image("icn_hanamaru.gif", array("alt" => "はなまる", "width" => "20", "height" => "18", "border" => "0")); ?>
      <span style="font-size:x-small; color:#FF0000;"><?php echo $diary['Diary']['hanamaru_count']; ?>ｺ</span>
    <?php } ?>
    </td>
  </tr>
	<?php
	$i ++;

    }
endforeach;
?>

</table>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<?php if($page > 1): ?>
<td width="50%" align="left">
	<a href="<?php echo $this->Html->url('/diaries/index/'.$options['year'].'/'.($options['month']).'/'.($page-1)); ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">前へ</span></a>&nbsp;
</td>
<?php endif; ?>
<?php if(count($diaries) > ($page * 5)): ?>
<td width="50%" align="right">
    <a href="<?php echo $this->Html->url('/diaries/index/'.$options['year'].'/'.($options['month']).'/'.($page+1)); ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">次へ</span></a>&nbsp;
</td>
<?php endif; ?>
</tr>
</table>


<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>
<span style="color:#339933;">&nbsp;･</span>他の月の思い出を見る<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php
if($options['year'] >= $beforeFlag['Month']['year'] && $options['month'] > $beforeFlag['Month']['month']) {
	$prev = ($options['month'] == 1) ?
		$this->Html->url('/diaries/index/'.($options['year']-1).'/12') :
		$this->Html->url('/diaries/index/'.$options['year'].'/'.($options['month']-1));
}

if($options['year'] >= date('Y') && $options['month'] < date('m')) {
	$next = ($options['month'] == 12) ?
		$this->Html->url('/diaries/index/'.($options['year']+1).'/1') :
		$this->Html->url('/diaries/index/'.$options['year'].'/'.($options['month']+1));
}
?>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<?php if(isset($prev)): ?>
<td align="left"><a href="<?php echo $prev; ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">前月</span></a></td>
<?php endif; ?>
<?php if(isset($next)): ?>
<td align="right"><a href="<?php echo $next; ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;">次月</span></a></td>
<?php endif; ?>
</tr>
</table>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("line_obj01.gif", array("width" => "228")); ?></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="10%"><?php echo $this->Html->image("icn_write.gif", array("width" => "100%")); ?></td>
<td width="85%"><?php echo $this->Html->image("txt_write.gif", array("width" => "100%")); ?></td>
</tr>
</table>

<span style="color:#339933;">&nbsp;･</span>
<a href="<?php echo $this->Html->url('/themes/index/diary/'.$options['year'].'/'.$options['month'].'/'); ?>" style="color:#339900;"><span style="color:#339900;"><?php echo $month_label; ?>月の思い出を書く</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

