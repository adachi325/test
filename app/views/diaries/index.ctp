<hr><br>
<center>
<div><?php echo $month.'月の思い出アルバム' ?></div>
<br>
<div>
<?php
$i=0;
foreach($diaries as $diary): 
    if ($diary['Diary']['has_image']) {
        $i++;
        echo $html->image('photo'.'/'.$diary['Diary']['child_id'].'/'.$diary['Diary']['id'].'.jpg' ,array('width' => '55px', 'height' => '55px'));
    }
endforeach;
?>
<?php
while($i < 4) {
    if($i == 2) {
        echo '<br>';
    }
    echo $html->image('photo'.'/nophoto'.($i+1).'.jpg' ,array('width' => '55px', 'height' => '55px'));
    $i++;
}
?>
</div>
</center>
<br><hr><br>
<div>
    <?php echo $this->Html->link($month.'月の思い出を投稿する', '/themes/index/diary'); ?>
</div>
<br>
<?php foreach($diaries as $diary): ?>
<div style='vertical-align:top;'>
<?php
    if ($diary['Diary']['has_image']) {
        echo $html->image('photo'.'/'.$diary['Diary']['child_id'].'/'.$diary['Diary']['id'].'.jpg' ,array('width' => '40px', 'height' => '40px'));
    } else {
        echo $html->image('photo/dummy.jpg' ,array('width' => '40px', 'height' => '40px'));
    }
    echo $this->Html->link($diary['Diary']['title'], '/diaries/info/'.$diary['Diary']['id']);
?>
</div>
<?php endforeach; ?>
