<div><?php echo $month.'月の思い出アルバム' ?></div>

<div>
    写真X4
</div>
<div>
    <?php echo $this->Html->link($month.'月の思い出を投稿する', '/themes/index/diary'); ?>
</div>
<br>
<?php foreach($diaries as $diary): ?>
<div style='vertical-align:top;'>
<?php
    echo $html->image("photo".DS.$diary['Diary']['child_id'].DS.$diary['Diary']['id'].'.jpg' ,array('width' => '40px', 'height' => '40px'));
    echo $this->Html->link($diary['Diary']['title'], '/diaries/info/'.$diary['Diary']['id']);
?>
</div>
<?php endforeach; ?>
