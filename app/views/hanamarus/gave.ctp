<h1>あげたはなまる一覧</h1>
<hr />

全<?php echo $hanamaru_total; ?>コ <?php echo $paginator->counter(array('format' => "%count%件中 %start%件〜%end%件を表示"));?>
<hr />
<table border="1">
<?php foreach ($hanamarus as $hanamaru): ?>
<!-- start: タイトル -->
<tr>
<td colspan="2"><?php echo $hanamaru['Diary']['title']; ?></td>
</tr>
<!-- end: タイトル -->

<!-- start: 写真、ボディ -->
<tr>
<?php
$image_path;
if ($hanamaru['Diary']['has_image']) {
  $image_path = sprintf(Configure::read('Diary.image_path_thumb'), $hanamaru['Diary']['child_id'], $hanamaru['Diary']['id']);
}
if ($hanamaru['Diary']['has_image']) {
  $image_path = "";
} 
?>

<td><?php echo $html->image("", array("style" => "margin:10px 0;")); ?></td>
<td><?php echo $hanamaru['Diary']['body']; ?></td>
</tr>
<!-- end: 写真、ボディ -->

<!-- start: はなまる個数 -->
<tr>
<td colspan="2">はなまる: <?php echo $hanamaru['Diary']['hanamaru_count']; ?></td>
</tr>
<?php endforeach; ?>
<!-- end: はなまる個数 -->
</table>
<hr />
<?php echo $paginator->prev('前へ', null, null, array('class' => 'disabled')); ?>
<?php echo $paginator->numbers(); ?>
<?php echo $paginator->next('次へ', null, null, array('class' => 'disabled')); ?>

