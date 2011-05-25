<!-- start: タイトル -->
<tr>
<td colspan="2"><?php echo $html->link($hanamaru['Diary']['title'], '/diaries/info/' . $hanamaru['Diary']['id']); ?></td>
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
<!-- end: はなまる個数 -->
