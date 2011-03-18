<div>
<?php if(count($childData) < 3){echo $html->link(__('ユーザー情報を変更する', true), array('action' => 'register'));}?>
</div>
<div>
<?php if(count($childData) > 0){echo $html->link(__('退会する', true), array('action' => 'edit'));}?>
</div>

