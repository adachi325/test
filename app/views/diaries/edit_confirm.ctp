<?php /* 210 思い出編集確認 */ ?>
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

この内容に変更してよろしいですか｡<br />内容修正の場合は｢戻る｣ﾎﾞﾀﾝを押して前の画面に戻って行ってください｡<br />
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_complete?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<span style="color:#ff6666;font-size:x-small;"> <?php echo h($this->data['Diary']['title']); ?> </span><br />
</td>
</tr>
<?php if ($this->data['Diary']['has_image']) { ?>
<tr>
<td align="center">
<?php 
    echo $this->Html->image(sprintf(Configure::read('Diary.image_path_thumb'), $this->data['Diary']['child_id'], $this->data['Diary']['id']), array("style" => "margin:10px 0;"));
?>
<br />
</td>
</tr>
<?php } ?>
<tr>
<td align="left"><span style="font-size:x-small; color:#333333;"><?php echo nl2br(h($this->data['Diary']['body'])); ?></span></td>
</tr>
<!-- start: 再審査注意文言 -->
<?php if ($this->data['Diary']['wish_public'] == 1) { ?>
<tr>
<td>
<span style="font-size:x-small; color:#cc0000;">※掲載中の思い出を編集した場合､一度非公開にされた上で再度審査が行われます｡</span>
</td>
</tr>
<?php } ?>
<!-- end: 再審査注意文言 -->
</table>

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<!-- stats: 掲載ステータス、はなまる個数 -->
<tr>
<td width="50%">
<span style="font-size:x-small;">
<?php echo $this->DiaryCommon->publicStatus($this->data['Diary']['wish_public'], $this->data['Diary']['permit_status'], $this->data['Article']['release_date']); ?>
</span>
</td>
<td width="50%">
<span style="font-size:x-small;">
<?php if ($this->data['Diary']['hanamaru_count'] > 0 ) { ?>
はなまる <?php echo $this->data['Diary']['hanamaru_count']; ?>ｺ
<?php } ?>
</span>
</td>
</tr>
<!-- end: 掲載ステータス、はなまる個数 -->
</table>

<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php echo $this->Form->submit("変更"); ?><br />
</td>
</tr>
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%">
<tr>
<td align="center">
<?php echo $this->Form->submit("戻る"); ?>
</td>
</tr>
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

