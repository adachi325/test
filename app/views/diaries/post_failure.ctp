<div>
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
<?php echo $this->Html->link('ﾄｯﾌﾟﾍﾟｰｼﾞへ', '/children/'); ?>
</div>
