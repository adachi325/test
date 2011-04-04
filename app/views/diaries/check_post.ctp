<?php echo '投稿が完了しました!'; ?>
<br>
<?php if(!empty($diaries['Diary']['error_code'])) { ?>
<p>
以下の理由により、写真を保存できませんでした。
<br>
<?php if($diaries['Diary']['error_code'] === 'E001') { ?>
・ファイルサイズが2MB以上
<?php } else if ($diaries['Diary']['error_code'] === 'E002'){ ?>
・ファイル形式がJPEG以外
<?php }?>
<br><br>
写真をつけて思い出記録を残したい場合は、JPG形式で容量が2MB以内の写真を添付して、再度投稿し直してください。
</p>
<?php }?>
<?php if(!empty($diary['Diary']['present_id'])) { ?>
<br>
<center>
<div>
    <?php 
    if($diary['Present']['present_type'] == 0){
        echo '思い出記録の背景をﾌﾟﾚｾﾞﾝﾄ!';
    } else if($diary['Present']['present_type'] == 1){
        echo 'ﾃﾞｺﾒ絵文字をﾌﾟﾚｾﾞﾝﾄ!';
    } else if($diary['Present']['present_type'] == 2){
        echo '待受FLASHをﾌﾟﾚｾﾞﾝﾄ!';
    } else if($diary['Present']['present_type'] == 3){
        echo 'ﾎﾟｽﾄｶｰﾄﾞをﾌﾟﾚｾﾞﾝﾄ!';
    }
    ?>
</div>
<br>
<div>
    <?php if ($diary['Present']['present_type'] == 0) { ?>
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
        <br />
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
     <?php } else if ($diary['Present']['present_type'] == 1) {  ?>
        <div><?php echo $html->image($diary['Present']['present_path']); ?></div>
        <br>
        <div>端末ﾒﾆｭｰ(機能)の画像保存からﾃﾞｺﾒを保存してね♪</div>
     <?php   } else {  ?>
            <?php echo $html->image($diary['Present']['present_thumbnail_path']); ?>
     <?php   } ?>
</div>
</center>
<br>
<div>
<?php
if ($diary['Present']['present_type'] == 2) {
    echo $this->Html->link('→このﾃﾝﾌﾟﾚｰﾄを使って待受FLASHを作成する', '/presents/present_list/'.$diary['Present']['present_type']);
} else if($diary['Present']['present_type'] == 3) {
    echo $this->Html->link('→このﾎﾟｽﾄｶｰﾄﾞを作成する', '/presents/present_list/'.$diary['Present']['present_type']);
}
?>
</div>
<?php } ?>
<br>
<div>
    <?php echo $this->Html->link('→投稿した思い出をみる', '/diaries/info/'.$diary['Diary']['id']); ?>
</div>
<br>