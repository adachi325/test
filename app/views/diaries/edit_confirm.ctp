<center>
    <div>
        <span>この変更内容にして</span><br>
        <span>よろしいですか。</span>
    </div>
    <br>
    <div>
        <span><?php echo $this->data['Diary']['title'] ?></span>
    </div>
    <br>
    <?php if ($this->data['Diary']['has_image']) {  ?>
    <div>
        <span>
           <?php echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $this->data['Diary']['child_id'], $this->data['Diary']['id']) ,array('width' => '100px', 'height' => '100px')); ?>
        </span>
    </div>
    <br>
    <?php } ?>
    <div>
        <span><?php echo $this->data['Diary']['body'] ?></span>
    </div>
    <br>
    <div>
        <?php echo $form->create('Diary', array('url' => '/diaries/edit_complete?guid=ON'));?>
        <?php echo $form->end('変更');?>
    </div>
    <div>
        <?php echo $form->create('Diary', array('url' => '/diaries/edit?guid=ON'));?>
        <?php echo $form->end('戻る');?>
    </div>
</center>