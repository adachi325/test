
<div>
<?php echo $form->create('Theme');?>

<?php echo $theme['Theme']['title']; ?><br><br>

<?php echo $theme['Theme']['description']; ?><br><br>

<?php
if($this->Ktai->is_imode() and !$this->tk->is_imode_browser()){ ?>
<a href="mailto:<?php echo $mailStr ?>?subject=<?php echo urlencode(mb_convert_encoding($mailTitle, "utf8"));?>">思い出を投稿する</a>
<?php } else { ?>
<?php $this->Ktai->mailto("思い出を投稿する",$mailStr,$mailTitle); ?>
<?php } ?>

<span>投稿したら「次へ」ボタンを押してね♪</span>
<br><br>

<?php echo $this->Html->link('次へ', '/diaries/checkPost/'.$nexthash); ?>

</div>