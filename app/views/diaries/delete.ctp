<center>
    <div>
        <span>この思い出を削除して</span><br>
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
        <?php echo $this->Html->link('削除', '/diaries/delete_complete/'.$this->data['Diary']['id']); ?>
    </div>
    <div>
        <?php echo $this->Html->link('取消', '/diaries/info/'.$this->data['Diary']['id']); ?>
    </div>
</center>