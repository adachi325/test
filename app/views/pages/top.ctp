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
	<?php echo $html->link('今すぐ会員登録(無料)', "/navigations/prev/2",array('escape' => false));?>
</div>
<br>
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