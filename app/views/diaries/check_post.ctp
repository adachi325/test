<?php if(!empty($presentId)) { ?>
<div>
    <?php echo $getStr.'をGET！' ?>
</div>
<br>
<div>
    <?php echo $getStr.'サンプル' ?>
</div>
<br>
<div>
    <?php echo $this->Html->link('→プレゼントを見る', '/presents/info/'.$presentId); ?>
</div>
<?php }else{ ?>
<div>
    <?php echo '投稿が完了しました！'; ?>
</div>
<?php } ?>
<br>
<div>
    <?php echo $this->Html->link('→投稿した思い出をみる', '/diaries/info/'.$diaryId); ?>
</div>
<br>
<hr>
<br>
<div>
    <?php echo $this->Html->link('→今月の思い出記録ページへ戻る', '/diaries/'); ?>
</div>