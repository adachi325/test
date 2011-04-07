
<!-- html 修正まち -->






<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%")); ?><br />
<?php $month_label = $options['month']; ?>
<?php echo $this->Html->image("album_{$month_label}.gif", array("width" => "100%")); ?><br />
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
</div>
<?php echo $this->Html->image("album_btm.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Html->image("txt_look.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<span style="color:#339933;">・</span><?php echo $options['month'].'月の思い出' ?><br />


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
if($page > 1) { $d = $page*5; $s=$d-5; } else { $d = 0; }
foreach($diaries as $diary):
    $s++;
    if($s > $d && $i < 5) { ?>
        <tr>
            <td width="25%" valign="top">
        <?php
            if ($diary['Diary']['has_image']) {
                echo $html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array("width" => "99%", "style" => "margin:0 5px 5px 0;"));
			} else {
				echo $this->Html->image("dummy.jpg", array("width" => "99%", "style" => "margin:0 5px 5px 0;"));
            }
        ?>
            </td>
            <td width="75%" align="left" valign="top">
			<?php $title = (!empty($diary['Diary']['title'])) ? $diary['Diary']['title'] : '無題'; ?>
	<a href="<?php echo $this->Html->url('/diaries/info/'.$diary['Diary']['id']); ?>" style="color:#339900;"><span style="font-size:x-small; color:#339900;"><?php echo h($title); ?></span></a>

			</td>
        </tr>
    <?php
    $i ++;
    }
endforeach;
?>

</tr>

</table>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />

<div style="text-align:left;" align="left">
<?php if($page > 1): ?>
<a href="<?php echo $this->Html->url('/diaries/index/'.$options['year'].'/'.($options['month']).'/'.($page-1)); ?>" style="color:#339900;"><span style="color:#339900;">前へ</span></a>&nbsp;
<?php endif; ?>
</div>

<div style="text-align:right;" align="right">
<?php if(count($diaries) > ($page * 5)): ?>
<a href="<?php echo $this->Html->url('/diaries/index/'.$options['year'].'/'.($options['month']).'/'.($page+1)); ?>" style="color:#339900;"><span style="color:#339900;">次へ</span></a>&nbsp;
<?php endif; ?>
<?php
if(count($diaries) > ($page * 5)) {
        echo $this->Html->link('次へ', '/diaries/index/'.$options['year'].'/'.($options['month']).'/'.($page+1));
    }
?>
</div>

<div style="text-align:right;" align="right">
<a href="#" style="color:#339900;"><span style="color:#339900;">次へ</span></a>&nbsp;
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div>

<?php echo $this->Html->image("dot_line_green.gif", array("style" => "margin:0 0 10px;")); ?><br />
<span style="color:#339933;">・</span>他の月の思い出を見る<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left">
<a href="#" style="color:#339900;"><span style="font-size:x-small; color:#339900;">前月</span></a>
</td>
<td align="right">
<a href="#" style="color:#339900;"><span style="font-size:x-small; color:#339900;">次月</span></a>
</td>
</tr>

</table>

<?php echo $this->Html->image("line_obj01.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<?php echo $this->Html->image("txt_write.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<span style="color:#339933;">・</span><a href="#" style="color:#339900;"><span style="color:#339900;">5月の思い出を書く</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />



<br><hr><br>
<div>
    <?php echo $this->Html->link($options['month'].'月の思い出を投稿する', '/themes/index/diary/'); ?>
</div>
<br>
<div>
    <p><?php echo '全'.count($diaries).'件中'; ?>&nbsp;
       <?php if($page > 1) { echo(($page*5)-4); } else if(count($diaries) == 0) { echo('0'); } else { echo($page); }
              if(($page*5) < count($diaries)) {echo ('件～'.($page*5).'件を表示'); } else {echo ('件～'.count($diaries).'件を表示');}
       ?>
       <?php //pr ($diaries); ?>
    </p>
</div>
<br>
<table>
<?php
$d = 0;$i = 0;$s = 0;
if($page > 1) { $d = $page*5; $s=$d-5; } else { $d = 0; }
foreach($diaries as $diary):
    $s++;
    if($s > $d && $i < 5) { ?>
        <tr>
            <td>
        <?php
            if ($diary['Diary']['has_image']) {
                echo $html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('width' => '40px', 'height' => '40px'));
            } else {
                echo $html->image('common/dummy.jpg' ,array('width' => '40px', 'height' => '40px'));
            }
        ?>
            </td>
            <td>
        <?php
            if(!empty($diary['Diary']['title']) and $diary['Diary']['title'] != ''){
                echo $this->Html->link($diary['Diary']['title'], '/diaries/info/'.$diary['Diary']['id']);
            } else {
                echo $this->Html->link('無題', '/diaries/info/'.$diary['Diary']['id']);
            }
        ?>
            </td>
        </tr>
    <?php
    $i ++;
    }
endforeach;
?>
</table>
<br>
<div>
<?php 
    if($page > 1) {
        echo $this->Html->link('前へ', '/diaries/index/'.$options['year'].'/'.($options['month']).'/'.($page-1));
    }
?>
</div>
<div>
<?php
    if(count($diaries) > ($page * 5)) {
        echo $this->Html->link('次へ', '/diaries/index/'.$options['year'].'/'.($options['month']).'/'.($page+1));
    }
?>
</div>
<br><hr><br>
<div>
<?php
if($options['year'] >= $beforeFlag['Month']['year'] && $options['month'] > $beforeFlag['Month']['month']) {
    if($options['month'] == 1) {
        echo $this->Html->link('前月', '/diaries/index/'.($options['year']-1).'/12');
    } else {
        echo $this->Html->link('前月', '/diaries/index/'.$options['year'].'/'.($options['month']-1));
    }
}
?>
    　　　　　
<?php
if($options['year'] >= date('Y') && $options['month'] < date('m')) {
    if($options['month'] == 12) {
        echo $this->Html->link('次月', '/diaries/index/'.($options['year']+1).'/1');
    } else {
        echo $this->Html->link('次月', '/diaries/index/'.$options['year'].'/'.($options['month']+1));
    }
}
?>
</div>
