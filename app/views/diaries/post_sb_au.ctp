
<div>
    <span>ﾄﾞｺﾓｺﾐｭﾆﾃｨにメールで投稿しよう。</span>
</div>
<br>
<?php if ($diary['Diary']['has_image']) {  ?>
<center>
<div>
    <span>
       <?php echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('escape' => false, 'width' => '100px', 'height' => '100px')); ?>
    </span>
</div>
</center>
<br>
<?php } ?>
<div>
    ①上記の画像を保存<br>
    ②ﾌﾗｲﾊﾟﾝに油を馴染ませる<br>
    ③ﾊﾟﾝ粉はｹﾁらず使う<br>
</div>
<br>
<div>
    メール送信して完成!
</div>
<center>
<?php $this->Ktai->mailto("投稿する",Configure::read('Defaults.docomo_community'),$mailTitle,$mailBody); ?>
</center>
<br>
<div>
･<?php echo $this->Html->link('今月の思い出記録ﾍﾟｰｼﾞへ戻る', '/diaries/index/'.$diary['Month']['year'].'/'.$diary['Month']['month']); ?>
</div>