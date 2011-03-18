<div>
<?php if(count($childData) < 3){echo $html->link(__('子供情報を追加する', true), array('action' => 'register'));}?>
</div>
<div>
<?php if(count($childData) > 0){echo $html->link(__('子供情報を変更する', true), array('action' => 'edit'));}?>
</div>
<div>
<?php if(count($childData) > 0){echo $html->link(__('子供情報を削除する', true), array('action' => 'delete'));}?>
</div>
