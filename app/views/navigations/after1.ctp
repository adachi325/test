<div>
    <h3>登録ありがつお！</h3>
</div>
<div>
◆まずは投稿してみよう！
</div>
<br>
<div>
<a href="mailto:<?php echo $mailStr ?>?subject=<?php echo urlencode(mb_convert_encoding($mailTitle, 'utf8'));?>">投稿する</a>
<?php $this->Ktai->mailto("投稿する",$mailStr,$mailTitle); ?>
<br>
<br>
</div>
<div>
    <?php echo $this->Html->link('今は投稿しないで、マイページに進む', '/children/'); ?>
</div>
<br>
<div>
    <?php echo $this->Html->link('投稿したよ', '/navigations/after2/'.$nexthash); ?>
</div>