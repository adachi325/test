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
    <?php echo $this->Html->link('⇒思い出を削除する', '/diaries/delete/'.$this->data['Diary']['id']); ?>
</div>
