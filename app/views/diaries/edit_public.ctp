<?php /* 220 思い出記録 公開・非公開の設定 */ ?>

<?php echo $this->Html->image("ttl_memory.gif", array("alt" => "思い出記録", "width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_public_confirm?guid=ON", "inputDefaults" => array("div" => false, "label" => false))); ?>
<?php echo $this->Form->hidden('id');?>
<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<span style="font-size:x-small;"><?php echo h($this->data['Diary']['title']); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</td>
</tr>
<tr>
<td align="center">
<span style="font-size:x-small; color:#333333;">現在の状態：</span><span style="font-size:x-small; color:#cc0000;">
<?php /* 掲載ステータスは現在状態を表すため、公開希望フラグをPOSTデータからではなく、現在のレコードの値を使用する */
  echo $this->DiaryCommon->publicStatus($wish_public_origin, $this->data['Diary']['permit_status'], $this->data['Article']['release_date']); ?>
</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?>
</td>
</tr>
</table>

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<?php
if (!isset($this->data['Diary']['wish_public'])) {
	$this->data['Diary']['wish_public'] = 0;
}
?>
<tr>
<td align="left">
<?php echo $this->Form->radio('wish_public', array('1' => ''), array('legend' => false)); ?><span style="font-size:x-small; color:#333333;">公開する</span>
</td>
</tr>
<tr>
<td align="left">
<?php echo $this->Form->radio('wish_public', array('0' => ''), array('legend' => false)); ?><span style="font-size:x-small; color:#333333;">公開しない</span>
</tr>
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("確認"); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</td>
</tr>
</table>
<?php echo $this->Form->end(); ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

