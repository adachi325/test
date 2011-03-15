<?php if ($this->data['Diary']['has_image']) {  ?>
<div>
    <span>
       <?php echo $html->image('photo'.'/'.$this->data['Diary']['child_id'].'/'.$this->data['Diary']['id'].'.jpg' ,array('width' => '70px', 'height' => '70px')); ?>
    </span>
</div>
<?php } ?>
<?php echo $form->create('Diary', array('action' => 'edit_confirm'));?>
    <?php echo $this->Form->input('title');?>
    <?php echo $this->Form->input('body');?>
    <?php echo $this->Form->hidden('id');?>
<?php echo $this->Form->hidden('has_image');?>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
