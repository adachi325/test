<h1>hanamarus</h1>
<table>
<tr>
  <th>ID</th>
  <th>Type</th>
  <th>ExternalID</th>
  <th>UserID</th>
  <th>OwnerID</th>
  <th>Created</th>
  <th>Modified</th>
</tr>
<?php foreach ($hanamarus as $hanamaru): ?>
<tr>
  <td><?php echo $hanamaru['Hanamaru']['id']; ?></td>
  <td><?php echo $hanamaru['Hanamaru']['type']; ?></td>
  <td><?php echo $hanamaru['Hanamaru']['external_id']; ?></td>
  <td><?php echo $hanamaru['Hanamaru']['user_id']; ?></td>
  <td><?php echo $hanamaru['Hanamaru']['owner_id']; ?></td>
  <td><?php echo $hanamaru['Hanamaru']['created']; ?></td>
  <td><?php echo $hanamaru['Hanamaru']['modified']; ?></td>
</tr>
<?php endforeach; ?>
</table>

