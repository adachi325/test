
<div>
<?php echo $form->create('Theme');?>

<?php echo $theme['Theme']['title']; ?><br><br>

<?php echo $theme['Theme']['description']; ?><br><br>

<?php $this->Ktai->mailto("思い出を投稿する",$mailStr,$mailTitle); ?>

<span>投稿したら「次へ」ボタンを押してね♪</span>
<br><br>

<?php echo $this->Html->link('次へ', '/diaries/checkPost/'.$nexthash); ?>

</div>