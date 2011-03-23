
<div>
<?php echo $form->create('Theme');?>

<?php echo $theme['Theme']['title']; ?><br><br>

<?php echo $theme['Theme']['description']; ?><br><br>

<?php echo $html->link("思い出を投稿する", $mailStr); ?><br><br>

<span>投稿したら「次へ」ボタンを押してね♪</span>
<br><br>

<?php echo $this->Html->link('次へ', '/diaries/checkPost/'.$nexthash); ?>

</div>