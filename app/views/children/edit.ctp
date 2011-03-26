
<?php echo $form->create('Child', array('url' => '/children/edit_confirm?guid=ON'));?>

<?php echo $form->input('nickname');?>
<div>
    <span>お子様の性別</span>
</div>
<div>
<table>
<tr>
<?php if(empty($this->data['Child']['sex'])){?>
    <td>
    <?php echo $form->radio('sex', array('1' => ''), array('legend' => false,'value' => 'none')); ?>女の子
    </td>
    <td>
    <?php echo $form->radio('sex', array('2' => ''), array('legend' => false,'value' => 'none')); ?>男の子
    </td>
<?php } else if($this->data['Child']['sex'] == 1) {?>
    <td>
    <?php echo $form->radio('sex', array('1' => ''), array('legend' => false,'value' => '1')); ?>女の子
    </td>
    <td>
    <?php echo $form->radio('sex', array('2' => ''), array('legend' => false )); ?>男の子
    </td>
<?php } else if($this->data['Child']['sex'] == 2) {?>
    <td>
    <?php echo $form->radio('sex', array('1' => ''), array('legend' => false)); ?>女の子
    </td>
    <td>
    <?php echo $form->radio('sex', array('2' => ''), array('legend' => false, 'value' => '2' )); ?>男の子
    </td>
<?php }?>
 </tr>
</table>
<div>
<span>お子様の生年月</span>
<?php echo $form->input('birth_year', array(
        'label' => '',
        'options' => $selectOptions->getOption(array('min' => 2000, 'max' => 2011, 'suffix' => ' 年',)),
        'empty' => __('------ 年', true),
        'class' => 'f_bir',)) ?>
<?php echo $form->input('birth_month', array(
        'label' => '',
        'options' => $selectOptions->getOption(array('min' => 1, 'max' => 12, 'suffix' => ' 月',)),
        'empty' => __('------ 月', true),
        'class' => 'f_bir',)) ?>
</div>

<?php echo $form->input('line_id', array($lines,'label' => 'お子様の年齢')) ?>

<?php echo $form->input('benesse_user');?>
<?php echo $form->submit('確認画面へ');?>
</div>
<div>
    <?php echo $html->link(__('マイページTOP', true), array('action' => 'index'));?>
</div>
