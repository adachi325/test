<center>
    <div>
        <span>
        <?php
        if($diary['Month']['month'] < 10) {
            $imgMonth = '0'.$diary['Month']['month'];
        }else {
            $imgMonth = $diary['Month']['month'];
        }
        echo $html->image(
                '/present/template/diaryback/diaryback_'.$diary['Month']['year'].$imgMonth.'_header.jpg' ,
                array('width' => '200px', 'height' => '50px'));
        ?>
        </span>
    </div>
    <br>
    <div>
        <span><?php echo $diary['Diary']['title'] ?></span>
    </div>
    <br>
    <?php if ($diary['Diary']['has_image']) {  ?>
    <div>
        <span>
           <?php echo $html->image('photo'.'/'.$diary['Diary']['child_id'].'/'.$diary['Diary']['id'].'.jpg' ,array('width' => '100px', 'height' => '100px')); ?>
        </span>
    </div>
    <br>
    <?php } ?>
    <div>
        <span><?php echo $diary['Diary']['body'] ?></span>
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
        echo $html->image(
                '/present/template/diaryback/diaryback_'.$diary['Month']['year'].$imgMonth.'_footer.jpg' ,
                array('width' => '200px', 'height' => '50px'));
        ?>
        </span>
    </div>
</center>
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
<?php echo $this->Html->link('⇒思い出一覧へ戻る', '/diaries/index/'.$diary['Month']['year'].'/'.$diary['Month']['month']); ?>
</div>

