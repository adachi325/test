<?php /* 220 思い出記録 公開・非公開の設定 */ ?>
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_public_confirm?guid=ON", "inputDefaults" => array("div" => false, "label" => false))); ?>
<?php echo $this->Form->hidden('id');?>

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<!-- start: タイトル -->
<tr>
<td align="left">
<span style="font-size:x-small">
<?php echo $this->data['Diary']['title']; ?>
</span>
</td>
</tr>
<!-- end: タイトル -->
<!-- start: 掲載ステータス -->
<tr>
<td align="left">
<span style="font-size:x-small">
<?php echo $this->DiaryCommon->publicStatus($this->data['Diary']['wish_public'], $this->data['Diary']['permit_status'], $this->data['Diary']['publish_date']); ?>
</span>
</td>
</tr>
<!-- end: 掲載ステータス -->
<!-- start: 公開設定 -->
<tr>
<td align="left">
<?php
if (!isset($this->data['Diary']['wish_public'])) {
	$this->data['Diary']['wish_public'] = 0;
}
$selection = array("1" => "公開する", "0" => "公開しない");
?>
<?php echo $this->Form->radio('wish_public', $selection, array('legend' => false, 'separator' => "<br />", 'value' => $this->data['Diary']['wish_public'])); ?>
</td>
</tr>
<!-- end: 公開設定 -->

<!-- start: 確認ボタン -->
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("確認"); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>
<!-- end: 確認ボタン -->
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>

