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
           <?php echo $html->image('photo'.'/'.$this->data['Diary']['child_id'].'/'.$this->data['Diary']['id'].'.jpg' ,array('width' => '100px', 'height' => '100px')); ?>
        </span>
    </div>
    <br>
    <?php } ?>
    <div>
        <span><?php echo $this->data['Diary']['body'] ?></span>
    </div>
    <br>
    <div>
        <?php echo $form->create('Diary', array('action' => 'edit_complete'));?>
        <?php echo $form->end('変更');?>
    </div>
    <div>
        <?php echo $form->create('Diary', array('action' => 'edit'));?>
        <?php echo $form->end('戻る');?>
    </div>
</center>