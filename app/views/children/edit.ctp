<div>
<?php echo $form->create('Child', array('action' => 'edit_confirm'));?>

<?php echo $form->input('nickname');?>
<div>
    <span>お子様の性別</span>
</div>
<div>
    
<?php
//pr($this->data);

echo $form->radio('Child.sex', array('1' => '男', '2' => '女'), array('legend' => false)); ?>
<?php echo $form->error('Child.sex','必須項目です。'); ?>
</div>
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

<div>
アイコン選択<br>
<table>
<tr>
<?php
for ($i =0; $i < 6 ; $i++){
    echo '<td>';
    if(empty($this->data)){
            echo $form->radio( 'iconId', array( $i=>'' ) ,array('legend' => false,'value' => 'none') ); echo $html->image(sprintf(Configure::read('Child.icon_path'), $i));
    } else {
        if($this->data['Child']['iconId'] == $i){
            echo $form->radio( 'iconId', array( $i=>'' ) ,array('legend' => false,'value' => $i) ); echo $html->image(sprintf(Configure::read('Child.icon_path'), $i));
        } else {
            echo $form->radio( 'iconId', array( $i=>'' ) ,array('legend' => false) ); echo $html->image(sprintf(Configure::read('Child.icon_path'), $i));
        }
    }
    echo '</td>';
    if($i == 2){
        echo '</tr>';
        echo '<tr>';
    }
}
?>
</tr>
</table>
<?php echo $form->error('iconId','必須項目です。'); ?>
</div>

<?php echo $form->input('benesse_user');?>
<?php echo $form->end('確認画面へ');?>
</div>
<div>
    <?php echo $html->link(__('マイページTOP', true), array('action' => 'index'));?>
</div>
