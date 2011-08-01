<?php /* 210 思い出編集確認 */ ?>
<?php echo $this->Html->image("ttl_memory.gif", array("alt" => "思い出記録", "width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

この内容に変更してよろしいですか｡<br />内容修正の場合は｢戻る｣ﾎﾞﾀﾝを押して前の画面に戻って行ってください｡<br />
<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit_complete?guid=ON", "inputDefaults" => array("div" => false, "label" => false))); ?>
<table width="90%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="center">
<span style="color:#ff6666;font-size:x-small;"><?php echo h($this->data['Diary']['title']); ?></span><br /></td>
</tr>
<tr>
<td colspan="2" align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php if ($this->data['Diary']['has_image']) : ?>
  <?php echo $this->Html->image(sprintf(Configure::read('Diary.image_path_thumb'), $this->data['Diary']['child_id'], $this->data['Diary']['id'])); ?>
<?php endif; ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?></td>
</tr>
<tr>
<td colspan="2" align="left"><span style="font-size:x-small; color:#333333;"><?php echo nl2br(h($this->data['Diary']['body'])); ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br /></td>
</tr>
<?php if ($this->data['Diary']['wish_public'] == 1) : ?>
<tr>
<td colspan="2" align="left"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />
<span style="font-size:x-small; color:#cc0000;">※思い出を編集した場合､すでに公開中であった場合も一度非公開にされた上で再度審査が行われます</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?></td>
</tr>
<?php endif; ?>
<tr>
<td align="left"><span style="font-size:x-small; color:#333333;">
<?php echo $this->DiaryCommon->publicStatus($this->data['Diary']['wish_public'], $this->data['Diary']['permit_status'], $this->data['Article']['release_date']); ?>
</span></td>
<td align="right">
<?php if ($this->data['Diary']['hanamaru_count'] > 0 ) : ?>
<span style="font-size:x-small; color:#FF0000;"><?php echo $ktai->image("icn_hanamaru.gif", array("alt" => "はなまる", "border" => "0", "width" => "20", "height" => "18", "style" => "margin:0 4px 0 0;")); ?><?php echo $this->data['Diary']['hanamaru_count']; ?>ｺ</span>
<?php endif; ?>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("変更"); ?>
</td>
</tr>
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Form->create('Diary', array("url" => "/diaries/edit?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%">
<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("戻る"); ?>
<?php echo $this->Form->end(); ?>
</td>
</tr>
</table>
<br />
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

