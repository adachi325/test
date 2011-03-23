<?php echo '投稿が完了しました!'; ?>
<br>
<?php if(!empty($diary['Diary']['present_id'])) { ?>
<br>
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
<?php } ?>
<br>
<?php if($diary['Diary']['error_code'] === 'E001') { ?>
<p>思い出作成に失敗しました。<br>
   投稿された画像サイズが大きすぎます。<br>
   ご確認の上、再度ご投稿お願いします。<br>
</p>
<?php } else if ($diary['Diary']['error_code'] === 'E002'){ ?>
<p>思い出作成に失敗しました。<br>
   投稿された画像がjpeg形式でない為、日記の登録が出来ませんでした。<br>
   ご確認の上、再度ご投稿お願いします。<br>
</p>
<?php }?>
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