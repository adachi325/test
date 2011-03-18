<div>
    <?php echo $html->link('会員情報変更', '/users/edit' ,array('escape' => false));?>
</div>
<br>
<div>
    <?php echo $ktai->emoji(0x641); ?><?php echo $html->link('退会する', '/users/delete' ,array('escape' => false));?>
</div>

