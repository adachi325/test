<?php if(!empty($diary['Diary']['present_id'])) { ?>
<center>
<div>
    <?php echo sprintf(Configure::read('Present.type.'.$diary['Present']['present_type'])).'をGET！' ?>
</div>
<br>
<div>
    <?php
        if ($diary['Present']['present_type'] == 0) {
            echo '思い出ページがきれいになりました、かくにんしてみてね！';
        } else if ($diary['Present']['present_type'] == 1) {
            echo $html->image($diary['Present']['present_path']);
        } else {
            echo $html->image($diary['Present']['present_thumbnail_path']);
        } 
    ?>
</div>
</center>
<br>
<div>
<?php
if ($diary['Present']['present_type'] == 2 or $diary['Present']['present_type'] == 3) {
    echo $this->Html->link('→プレゼントを見る', '/presents/present_list/'.$diary['Present']['present_type']);
}
?>
</div>
<?php }else{ ?>
<div>
<?php echo '投稿が完了しました！'; ?>
</div>
<?php } ?>
<br>
<div>
    <?php echo $this->Html->link('→投稿した思い出をみる', '/diaries/info/'.$diary['Diary']['id']); ?>
</div>
<br>
<hr>
<br>
<div>
    <?php echo $this->Html->link('→今月の思い出記録ページへ戻る', '/diaries/'); ?>
</div>