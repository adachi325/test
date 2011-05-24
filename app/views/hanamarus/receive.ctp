<h1>もらったはなまる一覧</h1>
全○個 
<table>
<tr>
  <th>ID</th>
  <th>Type</th>
  <th>ExternalID</th>
  <th>UserID</th>
  <th>OwnerID</th>
  <th>Created</th>
  <th>Modified</th>
  <th>ID</th>
  <th>ChildID</th>
  <th>MonthID</th>
  <th>ThemeID</th>
  <th>PresentID</th>
  <th>Hash</th>
  <th>Title</th>
  <th>Body</th>
  <th>HasImage</th>
  <th>ErrorCode</th>
  <th>WishPublic</th>
  <th>PermitStatus</th>
  <th>Created</th>
  <th>Modified</th>
</tr>
<?php foreach ($hanamarus as $hanamaru): ?>
<tr>
  <th><?php echo $hanamaru['Hanamaru']['id']; ?></th>
  <th><?php echo $hanamaru['Hanamaru']['type']; ?></th>
  <th><?php echo $hanamaru['Hanamaru']['external_id']; ?></th>
  <th><?php echo $hanamaru['Hanamaru']['user_id']; ?></th>
  <th><?php echo $hanamaru['Hanamaru']['owner_id']; ?></th>
  <th><?php echo $hanamaru['Hanamaru']['created']; ?></th>
  <th><?php echo $hanamaru['Hanamaru']['modified']; ?></th>
  <th><?php echo $hanamaru['Diary']['id']; ?></th>
  <th><?php echo $hanamaru['Diary']['child_id']; ?></th>
  <th><?php echo $hanamaru['Diary']['month_id']; ?></th>
  <th><?php echo $hanamaru['Diary']['theme_id']; ?></th>
  <th><?php echo $hanamaru['Diary']['present_id']; ?></th>
  <th><?php echo $hanamaru['Diary']['hash']; ?></th>
  <th><?php echo $hanamaru['Diary']['title']; ?></th>
  <th><?php echo $hanamaru['Diary']['body']; ?></th>
  <th><?php echo $hanamaru['Diary']['has_image']; ?></th>
  <th><?php echo $hanamaru['Diary']['error_code']; ?></th>
  <th><?php echo $hanamaru['Diary']['wish_public']; ?></th>
  <th><?php echo $hanamaru['Diary']['permit_status']; ?></th>
  <th><?php echo $hanamaru['Diary']['created']; ?></th>
  <th><?php echo $hanamaru['Diary']['modified']; ?></th>
</tr>
<?php endforeach; ?>
</table>

<table>
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
  $image_path = sprintf(Configure::read('Diary.image_path_thumb'), $diary['Diary']['child_id'], $diary['Diary']['id']);
}
if ($diary['Diary']['has_image']) {
  $image_path = "";
} 
?>

<td><?php echo $html->image("", array("style" => "margin:10px 0;")); ?></td>
<td><?php echo $hanamaru['Diary']['body']; ?></td>
</tr>
<!-- end: 写真、ボディ -->

<!-- start: はなまる個数 -->
<tr>
<td colspan="2">はなまる個数</td>
</tr>
<?php endforeach; ?>
<!-- end: はなまる個数 -->
</table>
