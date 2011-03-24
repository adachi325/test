<div>
    <h3>登録ありがつお！</h3>
</div>
<div>
◆まずは投稿してみよう！
</div>
<br>
<div>
<?php
if(!$this->tk->is_imode_browser()){ ?>
<a href="mailto:<?php echo $mailStr ?>?subject=<?php echo urlencode(mb_convert_encoding($mailTitle, "utf8"));?>">投稿する</a>
<?php } else { ?>
    <?php if(!$this->Ktai->is_ezweb()){ ?>
<a href="mailto:<?php echo $mailStr ?>?subject=<?php echo urlencode(mb_convert_encoding($mailTitle, "sjis"));?>">投稿する</a>
    <?php } else { ?>
<?php $this->Ktai->mailto("投稿する",$mailStr,$mailTitle); ?>
    <?php } ?>
<?php } ?>
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