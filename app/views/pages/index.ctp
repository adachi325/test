
<div align="center" style="text-align:center;">
<?php echo $this->Html->image('101/main.gif'); ?><br />
楽しく遊んで記録が残せる!<br />
&lt;こどもちゃれんじ&gt;会員ｻｲﾄ
</div>

<?php echo $this->Html->image('spacer.gif', array('width'=>'1', 'height'=>'10')); ?><br />

<div align="center" style="background:#ffff99; text-align:center;">
<?php echo $this->Html->image('spacer.gif', array('width'=>'1', 'height'=>'5')); ?><br />

<span style="color:#cc0000;">ﾌﾟﾛﾌｨｰﾙ登録で今ならｹﾞｰﾑﾌﾟﾚｾﾞﾝﾄ!</span><br />
<span style="font-size:medium;"><span style="color:#ff00ff;"><?php $this->Ktai->emoji(0xE6F8); ?></span>
<a href="#">今すぐ登録!（無料）</a>
<span style="color:#ff00ff;"> <?php $this->Ktai->emoji(0xE6F8); ?></span></span><br />
<?php echo $this->Html->image('spacer.gif', array('width'=>'1', 'height'=>'5')); ?>
</div>

<?php echo $this->Html->image('spacer.gif', array('width'=>'1', 'height'=>'10')); ?><br />
※ｻｰﾋﾞｽ利用料は<span style="color:#cc0000;">無料</span>です<br />
※別途ﾊﾟｹｯﾄ通信料がかかります<br />
<?php echo $this->Html->image('spacer.gif', array('width'=>'1', 'height'=>'5')); ?><br />

<div align="right" style="text-align:right;">登録済みの方は <?php echo $this->Html->link('こちら', array('/users/login/')); ?> </div>
<?php echo $this->Html->image('105/main_btm.gif'); ?> <br />


<div style="background:#ff9900;"><?php echo $this->Html->image('spacer.gif', array('width'=>'1', 'height'=>'1')); ?></div>
<?php echo $this->Html->image('spacer.gif', array('width'=>'1', 'height'=>'10')); ?><br />

<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left"><?php echo $this->Html->image('105/txt_info.gif', array('style'=>'margin-bottom:5px;')); ?></td>
</tr>

<?php
foreach ($news as $article) :

	extract($article['News']);
	?>

	<tr>
	<td width="45" valign="top"><span style="font-size:x-small;"><span style="color:#ff9900;">･</span><?php echo $this->Time->format('n/d', $start_at); ?></span></td>
	<td width="185" align="left"><a href="<?php echo $this->Html->url("/news/view/{$id}"); ?>" style="color:#ff6600;"><span style="font-size:x-small; color:#ff6600;"><?php echo h($title); ?></span></a></td>
	</tr>

<?php endforeach; ?>
</table>
</div>
<br />
<?php echo $this->Html->image('101/ttl_fun.gif', array('style'=>'margin-bottom:10px;')); ?><br />

<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">

<tr>
<td colspan="2" align="left"><?php echo $this->Html->image('101/txt_challenge.gif', array('style'=>'margin-bottom:5px;')); ?></td>
</tr>
<tr>
<td width="58" valign="top"><?php echo $this->Html->image('dummy.gif', array('width'=>'58', 'style'=>'margin-bottom:5px;')); ?></td>
<td width="172" align="left" valign="top"><span style="font-size:x-small;">こどもちゃれんじ教材と連動したｺﾝﾃﾝﾂが楽しめる!</span></td>
</tr>

</table>
</div>

<?php echo $this->Html->image('101/line.gif', array('style'=>'margin:10px 0;')); ?><br />

<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left"><img src="img/101/txt_memory.gif" style="margin-bottom:5px;" /></td>
</tr>
<tr>
<td width="58" valign="top"><img src="img/dummy.gif" width="58" style="margin-right:5px;" /></td><td width="172" align="left" valign="top"><span style="font-size:x-small;">子どもの成長がかわいく残せる!写真を撮って思い出記録を書こう♪</span></td>
</tr>
</table>
</div>
<img src="img/spacer.gif" width="1" height="10" /><br />

<div align="center" style="text-align:center;"><a href="#"><span style="color:#ff6600;">更に詳しく見る</span></a><span style="color:#cc0000;"><!--#include virtual="/emoji/trans.php?emoji=145"--></span></div>
<img src="img/spacer.gif" width="1" height="10" /><br />

<div align="center" style="background:#ffff99; text-align:center;">
<img src="img/spacer.gif" width="1" height="5" /><br />
<span style="font-size:medium;"><span style="color:#ff00ff;"><!--#include virtual="/emoji/trans.php?emoji=148"--></span><a href="#">今すぐ登録!（無料）</a><span style="color:#ff00ff;"><!--#include virtual="/emoji/trans.php?emoji=148"--></span></span><br />
<img src="img/spacer.gif" width="1" height="5" />
</div>

<img src="img/101/ttl_challenge.gif" style="margin-bottom:10px;" />
<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td colspan="2" align="left"><img src="img/101/txt_course.gif" style="margin-bottom:5px;" /></td>
</tr>
<tr>
<td width="1" valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td><td width="229" align="left"><a href="#" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;">0～1歳向け　baby/ぷちﾌｧｰｽﾄ</span></a></td>
</tr>
<tr>
<td valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td><td align="left"><a href="#" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;">1～2歳向け　ぷち</span></a></td>
</tr>
<tr>
<td valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td><td align="left"><a href="#" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;">2～3歳向け　ぽけっと</span></a></td>
</tr>
<tr>
<td valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td><td align="left"><a href="#" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;">3～4歳向け　ほっぷ</span></a></td>
</tr>
<tr>
<td valign="top"><span style="font-size:x-small; color:#cc0000;">･</span></td><td align="left"><a href="#" style="color:#ff3333;"><span style="font-size:x-small; color:#ff3333;">4～5歳向け　すてっぷ</span></a></td>
</tr>
</table>
</div>

<div align="center" style="text-align:center;"><a href="#"><img src="img/105/bnr_melmaga.gif" border="0" style="margin:10px 0 0;" /></a></div>
<img src="img/105/line_obj02.gif" style="margin:10px 0;" /><br />

<div align="center" style="text-align:center;">
<table width="230" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="left"><img src="img/105/txt_tv.gif" style="margin-bottom:5px;" /></td>
</tr>
<tr>
<td align="left" valign="top"><span style="font-size:x-small;"><a href="#" style="color:#ff3333;"><span style="color:#ff3333;">しまじろうﾍｿｶ</span></a><br />
毎週月曜、朝7:30～8:00放送！<br />
新ｶﾝｶｸ☆ｷｯｽﾞ･ﾊﾞﾗｴﾃｨｰ。</span><br />
<img src="img/spacer.gif" width="1" height="5" /></td>
</tr>
<tr>
<td align="left" valign="top"><span style="font-size:x-small;"><a href="#" style="color:#ff3333;"><span style="color:#ff3333;">ｺﾝｻｰﾄ</span></a><br />
&lt;こどもちゃんれんじ&gt;<br />
ｺﾝｻｰﾄの楽しい情報がいっぱい！</span></td>
</tr>
</table>
</div>
<br />

<div align="right" style="text-align:right;"><span style="font-size:x-small;"><!--#include virtual="/emoji/trans.php?emoji=123"--><a href="#top" accesskey="#">ﾍﾟｰｼﾞ上へ</a></span></div>
<br />






<h2>TOPページ</h2>
<?php if($ktai->is_ktai()){ ?>
<div>
	<?php echo $html->link('さらに詳しく見る', "/navigations/prev/1",array('escape' => false));?>
</div>
<br>
<div>
    <h5>すでに会員の方は<?php echo $html->link('こちら', "/users/login/",array('escape' => false));?></h5>
</div>
<br>
<div>
	<?php echo $html->link('今すぐ会員登録(無料)', "/navigations/prev/2",array('escape' => false));?>
</div>
<br>
<?php } ?>
<div>
    <div>
        <h3>サイトのお知らせ</h3>
    </div>
    <div>
    <?php foreach($newslist as $news): ?>
        <?php
            echo "<p>";
            echo $this->Html->link($news['news']['title'], '/news/info/'.$news['news']['id']);
            echo "</p>";
        ?>
    <?php endforeach; ?>
    </div>
</div>
<br>
<div>
    <span>子供御チャレンジ教材コンテンツ</span><br>
    <span>コンテンツ１</span><br>
    <span>コンテンツ２</span><br>
</div>
