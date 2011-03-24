
<center>
    <div>
        <span>ドコモコミュニティにメールで投稿しよう。</span>
    </div>
    <div>
        <?php echo $this->Html->link('投稿する', '/diaries/downlord/'.$diary['Diary']['id']); ?>
    </div>
</center>
<br>
<div>
･<?php echo $this->Html->link('今月の思い出記録ﾍﾟｰｼﾞへ戻る', '/diaries/index/'.$diary['Month']['year'].'/'.$diary['Month']['month']); ?>
</div>