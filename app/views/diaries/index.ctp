<hr><br>
<center>
<div><?php echo $options['month'].'月の思い出アルバム' ?></div>
<br>
<div>
<?php
$i=0;
if(!empty($diaries)) {
foreach($diaries as $diary):
    if ($diary['Diary']['has_image'] && $i < 4) {
        $i++;
        echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('width' => '55px', 'height' => '55px')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
    }
endforeach;
}
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
<?php
$d = 0;$i = 0;$s = 0;
if($page > 1) { $d = $page*5; $s=$d-5; } else { $d = 0; }
foreach($diaries as $diary):
    $s++;
    if($s > $d && $i < 5) { ?>
        <div style='vertical-align:top;'>
        <?php
            if ($diary['Diary']['has_image']) {
                echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('width' => '40px', 'height' => '40px'));
            } else {
                echo $html->image('photo/dummy.jpg' ,array('width' => '40px', 'height' => '40px'));
            }
            echo $this->Html->link($diary['Diary']['title'], '/diaries/info/'.$diary['Diary']['id']);
        ?>
        </div>
    <?php
    $i ++;
    }
endforeach;
?>
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
