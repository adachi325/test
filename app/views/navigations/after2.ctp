<div>
ほら！こんな簡単に<br>
かわいい日記が作れちゃったよ♪
</div>
<br>
<center>
    <div>
        <span>
        <?php
        echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_h'), date('Y'), date('m')),
                array('width' => '200px', 'height' => '50px'));
        ?>
        </span>
    </div>
    <br>
    <div>
        <span><?php echo $diaries['Diary']['title'] ?></span>
    </div>
    <br>
    <?php if ($diaries['Diary']['has_image']) {  ?>
    <div>
        <span>
           <?php echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $diaries['Diary']['child_id'], $diaries['Diary']['id']) ,array('escape' => false, 'width' => '100px', 'height' => '100px')); ?>
        </span>
    </div>
    <br>
    <?php } ?>
    <div>
        <span><?php echo $diaries['Diary']['body'] ?></span>
    </div>
    <br>
    <div align="right">
        <span><?php echo date('n月d日', strtotime($diaries['Diary']['created'])); ?></span>
    </div>
    <br>
    <div>
        <span>
        <?php
        echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_f'), date('Y'), date('m')),
                array('width' => '200px', 'height' => '50px'));
        ?>
        </span>
    </div>
    <br>
    <div>
        <span>
            思い出記録を渡航していくと、色々とハッピーでグッドなアイテムをゲッツ。
        </span>
    </div>
</center>
<br><hr><br>
<div>
    <?php echo $this->Html->link('ﾄｯﾌﾟﾍﾟｰｼﾞへ', '/children/'); ?>
</div>