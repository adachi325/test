<div align="center" style="text-align:center;">
<?php echo $this->Html->image("main.gif", array("width" => "100%")); ?><br />
楽しく遊んで記録が残せる!<br />
&lt;こどもちゃれんじ&gt;会員ｻｲﾄ
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<div align="center" style="background:#ffff99; text-align:center;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#cc0000;">ﾌﾟﾛﾌｨｰﾙ登録で今なら<br />ｹﾞｰﾑﾌﾟﾚｾﾞﾝﾄ!</span><br />
<span style="font-size:medium;"><span style="color:#ff00ff;"><?php $this->Ktai->emoji(0xE6FA); ?></span><a href="<?php echo $this->Html->url('/navigations/prev/2'); ?>">今すぐ登録!(無料)</a><span style="color:#ff00ff;"><?php $this->Ktai->emoji(0xE6FA); ?></span></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
※ｻｰﾋﾞｽ利用料は<span style="color:#cc0000;">無料</span>です<br />
※別途ﾊﾟｹｯﾄ通信料がかかります<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="right" style="text-align:right;">登録済みの方は<a href="<?php echo $this->Html->url("/users/login/"); ?>">こちら</a></div>
<?php echo $this->Html->image("img_obj.gif", array("width" => "100%")); ?><br />
<div style="background:#ff9900;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php echo $this->Html->image("txt_info.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />

<table width="100%" cellpadding="0" cellspacing="0">

<?php foreach($newslist as $news): ?>
        <?php
            echo "<p>";
            echo $this->Html->link($news['news']['title'], '/news/info/'.$news['news']['id']);
            echo "</p>";
        ?>
 
<tr>
<td width="50" valign="top"><span style="font-size:x-small;"><span style="color:#ff9900;">・</span>5/1</span></td>
<td align="left"><a href="#" style="color:#ff6600;"><span style="font-size:x-small; color:#ff6600;">おしらせおしらせおしらせおしらせ</span></a></td>
</tr>

<?php endforeach; ?>
</table>

<br />

<?php echo $this->Html->image("ttl_fun.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<?php echo $this->Html->image("txt_challenge.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<?php echo $this->Html->image("dummy.gif", array("width" => "58", "align" => "left", "style" => "float:left; margin-right:5px;")); ?>
&lt;こどもちゃれんじ&gt;教材と連動したｺﾝﾃﾝﾂが楽しめる!<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "1")); ?></div>

<?php echo $this->Html->image("dot_line_orrange.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />
<?php echo $this->Html->image("txt_memory.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<?php echo $this->Html->image("dummy.gif", array("width" => "58", "align" => "left", "style" => "float:left; margin-right:5px;")); ?>子どもの成長がかわいく残せる!写真を撮って思い出記録を書こう♪<br clear="all" />
<div style="clear:both;"><?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?></div>

<div align="center" style="text-align:center;"><a href="<?php echo $this->Html->url('/navigations/prev/1');?>"><span style="color:#ff6600;">更に詳しく見る</span></a><span style="color:#cc0000;"><?php $this->Ktai->emoji(0xE6F5); ?></span></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<div align="center" style="background:#ffff99; text-align:center;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="font-size:medium;"><span style="color:#ff00ff;"><?php $this->Ktai->emoji(0xE6FA); ?></span><a href="<?php echo $this->Html->url('/navigations/prev/2'); ?>">今すぐ登録!(無料)</a><span style="color:#ff00ff;"><?php $this->Ktai->emoji(0xE6FA); ?></span></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?>
</div>

<?php echo $this->Html->image("ttl_challenge.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />
<?php echo $this->Html->image("txt_course.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<span style="color:#cc0000;">・</span><a href="<?php echo $this->Html->url('/ap/baby/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">0～1歳向け baby/ぷちﾌｧｰｽﾄ</span></a><br />
<span style="color:#cc0000;">・</span><a href="<?php echo $this->Html->url('/ap/petit/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">1～2歳向け ぷち</span></a><br />
<span style="color:#cc0000;">・</span><a href="<?php echo $this->Html->url('/ap/pocket/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">2～3歳向け ぽけっと</span></a><br />
<span style="color:#cc0000;">・</span><a href="<?php echo $this->Html->url('/ap/hop/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">3～4歳向け ほっぷ</span></a><br />
<span style="color:#cc0000;">・</span><a href="<?php echo $this->Html->url('/ap/step/'); ?>" style="color:#ff3333;"><span style="color:#ff3333;">4～5歳向け すてっぷ</span></a>

<div align="center" style="text-align:center;"><a href="#"><?php echo $this->Html->image("bnr_melmaga.gif", array("width" => "83%", "border" => "0", "style" => "margin:10px 0 0;")); ?></a></div>
<?php echo $this->Html->image("line_obj02.gif", array("width" => "100%", "style" => "margin:10px 0;")); ?><br />

<?php echo $this->Html->image("txt_tv.gif", array("width" => "100%", "style" => "margin-bottom:5px;")); ?><br />
<span style="color:#cc0000;">・</span><a href="#" style="color:#ff3333;"><span style="color:#ff3333;">しまじろうﾍｿｶ</span></a><br />
毎週月曜､朝7:30～8:00放送!<br />
新ｶﾝｶｸ☆ｷｯｽﾞ・ﾊﾞﾗｴﾃｨｰ｡<br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#cc0000;">・</span><a href="#" style="color:#ff3333;"><span style="color:#ff3333;">ｺﾝｻｰﾄ</span></a><br />
&lt;こどもちゃんれんじ&gt;ｺﾝｻｰﾄの楽しい情報がいっぱい!<br />

<div align="right" style="text-align:right;"><span style="font-size:x-small;"><?php $this->Ktai->emoji(0xE6E0); ?><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></span></div>
<br />

