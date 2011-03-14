<h2>子どものページ</h2>
<div id="tab">
<?php
// 配列の値を改行しながらすべて出力
foreach ($childrenData as $child) {
	extract($child['Child']);
	echo '<span>';
	echo $html->link($nickname, "/children/index/".$id);
	echo '</span> ';
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

<div>
    <br><br>
    <?php echo $html->link(__('子供設定', true), array('action' => 'edit')); ?>
    <br><br>
    <?php echo $html->link(__('子供削除', true), array('action' => 'delete')); ?>
</div>
<div>
    <?php echo $html->link('会員情報変更', '/users/edit' ,array('escape' => false));?>
</div>

<br>

<h3>最新の思い出記録</h3>
<div>
	<div>画像ｘ４</div>
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
<?php echo $this->Html->link('詳しくはこちら', '/'); ?>
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

