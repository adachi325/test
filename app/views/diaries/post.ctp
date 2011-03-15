<?php
if($un_dc_user) { ?>
<div>
    <?php echo 'どこもこみゅにてぃに入ってから再度サクセスしてください。'; ?>
</div>
<?php } else {?>
<center>
    <div>
        <span>ドコモコミュニティにメールで投稿しよう。</span>
    </div>
    <div>
        <?php echo $this->Html->link('投稿する', '/diaries/downlord/'.$id); ?>
    </div>
</center>
<?php } ?>
<div>
<?php echo $this->Html->link('⇒日記に戻る','/diaries/info/'.$id); ?>
</div>
<div>
<?php echo $this->Html->link('⇒思い出一覧へ戻る', '/diaries/index/'); ?>
</div>