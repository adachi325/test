<h2>子どものページ</h2>
<div>
    <?php
     //pr($children);
     // 配列の値を改行しながらすべて出力
     for( $i = 0; $i < count( $childrenData ); $i++ ){
         echo '<span>';
         echo $html->link(__('しま'.($i+1), true) , "/children/index/".$i,array('escape' => false));
         echo ' </span>';
     }
     if ($i < 3) {
         echo '<span>';
         echo $html->link('+', "/children/register/",array('escape' => false));
         echo ' </span>';
     }
     pr($lastChildId);
    ?>
    <br><br>
    <?php echo $html->link(__('子供設定', true), array('action' => 'edit')); ?>
    <br><br>
    <?php echo $html->link(__('子供削除', true), array('action' => 'delete')); ?>
</div>
<br>
<div>
    <?php echo $html->link('子どもの思い出記録ページ', '/diaries/' ,array('escape' => false));?>
</div>
<br>
<div>
    <?php echo $html->link('会員情報変更', '/users/edit' ,array('escape' => false));?>
</div>
