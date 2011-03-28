<?php if ($this->data['Diary']['has_image']) {  ?>
<div>
    <span>
       <?php echo $html->image(sprintf(Configure::read('Diary.image_path_thumb'), $this->data['Diary']['child_id'], $this->data['Diary']['id']) ,array('width' => '70px', 'height' => '70px')); ?>
    </span>
</div>
<?php } ?>
<div>
<?php echo $form->create('Diary', array('url' => '/diaries/edit_confirm?guid=ON'));?>
    <?php echo $this->Form->input('title');?>
    <?php echo $this->Form->input('body');?>
    <?php echo $this->Form->hidden('id');?>
<?php echo $this->Form->hidden('has_image');?>
<?php echo $this->Form->end(__('確認', true));?>
</div>