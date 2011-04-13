
<div style="background:#ff6600;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="font-size:x-small;font-weight:bold; color:#ffffff;">ﾌﾟﾛﾌｨｰﾙ登録</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

内容をご確認の上､｢登録｣ﾎﾞﾀﾝを押してください｡<br />内容修正の場合は｢戻る｣ﾎﾞﾀﾝを押して前の画面に戻って行ってください｡  <br />
<span style="color:#666666">※ﾛｸﾞｲﾝ名､ﾊﾟｽﾜｰﾄﾞは機種変更の際に必要となりますので､ﾒﾓ等でお手元にお控えください｡</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Form->create('User', array("url" => "/users/register_complete?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%">
<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
  <p><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
    <span style="color:#333333;">■ﾛｸﾞｲﾝ名</span> <br />
    <span style="color:#000000;"><?php echo $this->data['User']['loginid']; ?></span><br />
    <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?></p>
</div></td>
</tr>
<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾊﾟｽﾜｰﾄﾞ</span> <br />
<span style="color:#000000;">●●●●</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どものﾆｯｸﾈｰﾑ</span><br />
<span style="color:#000000;"><?php echo $this->data['Child']['0']['nickname']; ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの性別</span><br />
<span style="color:#000000;"><?php echo ($this->data['Child']['0']['sex'] == 1) ? '女の子' : '男の子'; ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの生年月</span><br />
<span style="color:#000000;"><?php echo $this->data['Child']['0']['birth_year']; ?>年 <?php echo $this->data['Child']['0']['birth_month']; ?>月</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■子どもの年齢</span><br />
<span style="color:#000000;"><?php echo $lines[$this->data['Child']['0']['line_id']]; ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td bgcolor="#ffecd9"><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■こどもちゃれんじ会員</span><br />
<span style="color:#000000;"><?php echo ($this->data['Child']['0']['benesse_user'] == 1) ? 'はい' : 'いいえ'; ?></span><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td><div style="font-size:x-small;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#333333;">■ﾄﾞｺﾓｺﾐｭﾆﾃｨ会員</span><br />
<span style="color:#000000;"><?php echo ($this->data['User']['dc_user'] == 1) ? 'はい' : 'いいえ'; ?></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div></td>
</tr>

<tr>
<td align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<?php echo $this->Form->submit("登録"); ?><br />
</td>
</tr>
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Form->create('User', array("url" => "/users/register?guid=ON", "inputDefaults" => array("dev" => false, "label" => false))); ?>
<table width="100%">
    <tr>
        <td align="center">
            <?php echo $this->Form->submit("戻る"); ?><br />
        </td>
    </tr>
</table>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

