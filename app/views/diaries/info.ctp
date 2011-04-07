
<div style="background:#e9f7ff; text-align:center;" align="center">
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("memory_top.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<span style="color:#ff6666;font-size:x-small;">初めてのハイハイ!</span><br />
</td>
</tr>
<tr>
<td align="center">
<?php echo $this->Html->image("memory_pic.jpg", array("style" => "margin:10px 0;")); ?><br />
</td>
</tr>
<tr>
<td align="left"><span style="font-size:x-small; color:#333333;">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</span></td>
</tr>
<tr>
<td align="right"><span style="font-size:x-small; color:#666666;">5月10日</span></td>
</tr>
</table><br />
<?php echo $this->Html->image("memory_btm_obj.gif", array("width" => "100%")); ?></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<span style="color:#339933;">・</span><a href="#" style="color:#339900;"><span style="color:#339900;">家族や友達に共有する</span></a><br />
(ﾄﾞｺﾓｺﾐｭﾆﾃｨへ送信)<span style="color:#666666">※ﾄﾞｺﾓｺﾐｭﾆﾃｨ会員登録が必要です</span><br />
<span style="color:#339933;">・</span><a href="#" style="color:#339900;"><span style="color:#339900;">この思い出を編集する</span></a><br />
<span style="color:#339933;">・</span><a href="#" style="color:#339900;"><span style="color:#339900;">この思い出を削除する</span></a><br />

<?php echo $this->Html->image("line_obj01.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<?php echo $this->Html->image("txt_leave.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<span style="color:#339933;">・</span><a href="#" style="color:#339900;"><span style="color:#339900;">世界に1つ!待受画面を作る</span></a><br />
<span style="color:#339933;">・</span><a href="#" style="color:#339900;"><span style="color:#339900;">印刷して送れるﾎﾟｽﾄｶｰﾄﾞを作る</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />


<center>
    <div>
        <span>
        <?php
        if($diary['Month']['month'] < 10) {
            $imgMonth = '0'.$diary['Month']['month'];
        }else {
            $imgMonth = $diary['Month']['month'];
        }
        echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_h'), $diary['Month']['year'], $imgMonth),
                array('width' => '200px', 'height' => '50px'));
        ?>
        </span>
    </div>
    <br>
    <?php if(!empty($diary['Diary']['title']) and $diary['Diary']['title'] != ''){ ?>
    <div>
        <span><?php echo $diary['Diary']['title'] ?></span>
    </div>
    <br>
    <?php } ?>
    <?php if ($diary['Diary']['has_image']) {  ?>
    <div>
        <span>
           <?php echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('escape' => false, 'width' => '50%', 'height' => '50%')); ?>
        </span>
    </div>
    <br>
    <?php } ?>
    <div>
        <span><?php echo nl2br($diary['Diary']['body']); ?></span>
    </div>
    <br>
    <div align="right">
        <span><?php echo date('n月d日', strtotime($diary['Diary']['created'])); ?></span>
    </div>
    <br>
    <div>
        <span>
        <?php
        if($diary['Month']['month'] < 10) {
            $imgMonth = '0'.$diary['Month']['month'];
        }else {
            $imgMonth = $diary['Month']['month'];
        }
        echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_f'), $diary['Month']['year'], $imgMonth),
                array('width' => '200px', 'height' => '50px'));
        ?>
        </span>
    </div>
</center>
<br>
<br><hr><br>
<div>
<?php echo $this->Html->link('⇒ドコモコミュニティへ投稿する', '/diaries/post/'.$diary['Diary']['id']); ?>
</div>
<div>
<?php echo $this->Html->link('⇒獲得したプレゼント一覧', '/presents/'); ?>
</div>
<div>
<?php echo $this->Html->link('⇒思い出を編集する', '/diaries/edit/'.$diary['Diary']['id']); ?>
</div>
<div>
<?php echo $this->Html->link('⇒思い出を削除する', '/diaries/delete/'.$diary['Diary']['id']); ?>
</div>
