
<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

この思い出をﾄﾞｺﾓｺﾐｭﾆﾃｨに投稿し､家族や友達と共有しよう!<br />

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<span style="color:#339933;">&nbsp;・</span>送信の仕方<br />
<span style="color:#339900;">【事前準備】</span><br />
以下のﾒｰﾙｱﾄﾞﾚｽをｺﾋﾟｰして電話帳に登録すれば､ﾒｰﾙでﾄﾞｺﾓｺﾐｭﾆﾃｨの日記を送信できます｡<br />

<?php echo $this->Form->input("mail_address", array("type" => "text", "value" => "diary@docomo-community.ne.jp", "style" => "font-size:x-small; width:100%")); ?>

<span style="color:#339900;">【投稿の仕方】</span><br />
<ol>
<li>下記のﾘﾝｸよりﾃﾞｺﾒになった思い出をﾀﾞｳﾝﾛｰﾄﾞ<br />
<a href="<?php echo $this->Html->url('/diaries/downlord/'.$diary['Diary']['id']); ?>">ﾀﾞｳﾝﾛｰﾄﾞ</a></li>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<li>ﾀﾞｳﾝﾛｰﾄﾞしたら｢このﾃﾝﾌﾟﾚｰﾄでﾒｰﾙを作成｣で｢はい｣を選択</li>
<li>ﾒｰﾙ画面でﾃﾞｺﾒ日記を作成<br />
宛先:電話帳に登録したdiary@docomo-community.ne.jpを選択<br />
題名:日記のﾀｲﾄﾙを入力</li>
<li>ﾒｰﾙを送信して完成!</li>
<li>送信した日記を確認する<br />
⇒<a href="http://docomo-community.cp05.docomo.ne.jp/dj/index.xhtml">ﾄﾞｺﾓｺﾐｭﾆﾃｨのﾏｲﾍﾟｰｼﾞへ</a></li>
</ol>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<span style="color:#339933;">&nbsp;・</span><a href="<?php echo $this->Html->url('/diaries/index/'.$diary['Month']['year'].'/'.$diary['Month']['month']);?>" style="color:#339900;"><span style="color:#339900;">今月の思い出記録ﾍﾟｰｼﾞへ戻る</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

