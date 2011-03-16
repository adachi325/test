<h2>子どものページ</h2>
<div id="tab">
<?php
// 配列の値を改行しながらすべて出力
$i = 0;
foreach ($childrenData as $child) {
    extract($child['Child']);
    echo '<span>';
    echo $html->link($html->image(sprintf(Configure::read('Child.icon_path'), $child['Child']['iconId'])), "/children/index/".$i, array('escape' => false));
    echo '</span> ';
    $i++;
}
if (count($childrenData) < 3) {
    echo '<span>';
    echo $html->link('+', "/children/register/");
    echo '</span> ';
}?>
</div>
<div id="child_data">

<div>ニックネーム：<?php echo $currentChild['Child']['nickname']; ?> </div>
<div>誕生日：
<?php echo h($currentChild['Child']['birth_year']); ?>年 
<?php echo h($currentChild['Child']['birth_month']); ?>月
</div>
<div>コース：<?php echo $lines[$currentChild['Child']['line_id']]; ?>  </div>
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
<div>
    <br><br>
    <?php echo $html->link(__('子供設定', true), array('action' => 'edit')); ?>
    <br>
    <?php echo $html->link(__('子供削除', true), array('action' => 'delete')); ?>
</div>
<div>
    <?php echo $html->link('会員情報変更', '/users/edit' ,array('escape' => false));?>
</div>

<br>

<h3>最新の思い出記録</h3>
<div>
<center>
<div>
<?php
$i=0;
foreach($diaries as $diary):
    if ($diary['Diary']['has_image'] && $i < 4) {
        $i++;
        echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('width' => '55px', 'height' => '55px')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
    }
endforeach;
?>
<?php
while($i < 4) {
    if($i == 2) {
        echo '<br>';
    }
    echo $html->image('photo'.'/nophoto'.($i+1).'.jpg' ,array('width' => '55px', 'height' => '55px'));
    $i++;
}
?>
</div>
</center>
<br>
<?php echo $html->link('子どもの思い出記録ページ', '/diaries/' ,array('escape' => false)); ?>
</div>

<br>
<h3>最新の思い出テーマ</h3>
<?php foreach($months as $month): ?>
    <?php foreach($month['Theme'] as $theme): ?>
    <?php
        echo "<p>";
        echo $this->Html->link($theme['title'], '/themes/info/'.$theme['id']);
        echo "</p>";
    ?>
    <?php endforeach; ?>
<?php endforeach; ?>
<div>
<?php echo $this->Html->link('もっと見る', '/themes/'); ?>
</div>

<h3>今月のプレゼント</h3>
<div>
<div>flash x2</div>
<?php echo $this->Html->link('詳しくはこちら', '/presents/'); ?>
</div>

<h3>今月の連動教材</h3>
<div>
<ul>
<?php foreach($issues as $issue): ?>
<li>
<?php
	echo h($issue['Issue']['title']);
	if(is_array($issue['Content'])) {
		foreach($issue['Content'] as $content) {
			if ($content['release_date'] < date('Y-m-d')) {
				echo "<p>";
				echo $this->Html->link($content['title'], DS.$content['path'].DS);
				echo "</p>";
			}
		}
	}
?>
</li>
<?php endforeach; ?>
</ul>
<?php echo $this->Html->link('先月までの教材を全部見る', 'http://shimajiromobile.benesse.ne.jp/ap1/'); ?>
</div>

