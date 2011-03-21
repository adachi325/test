<h2>TOPページ</h2>
<div>
	<?php echo $html->link('さらに詳しく見る', "/navigations/prev/1",array('escape' => false));?>
</div>
<br>
<div>
    <h5>すでに会員の方は<?php echo $html->link('こちら', "/users/login/",array('escape' => false));?></h5>
</div>
<br>
<div>
	<?php echo $html->link('今すぐ会員登録(無料)', "/navigations/rule",array('escape' => false));?>
</div>
<br>
<div>
    <span>お子様の思い出</span><br>
	<?php echo $html->link('⇒こんなことができるよ', "/pages/navi",array('escape' => false));?>
</div>
<br>
<div>
    <span>思い出テーマ</span><br>
    <span>テーマタイトル１</span><br>
    <span>テーマタイトル２</span><br>
	<?php echo $html->link('もっと見る', "/pages/navi",array('escape' => false));?>
</div>
<br>
<div>
    <span>今月のプレゼント</span><br>
    <span>プレゼント１</span><br>
    <span>プレゼント２</span><br>
	<?php echo $html->link('詳しくはこちら', "/pages/present",array('escape' => false));?>
</div>
<br>
<div>
    <span>子供御チャレンジ教材コンテンツ</span><br>
    <span>コンテンツ１</span><br>
    <span>コンテンツ２</span><br>
</div>