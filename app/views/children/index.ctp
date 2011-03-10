<h2>子どものページ</h2>
<div>
    <?php
     //pr($children);
     // 配列の値を改行しながらすべて出力
     for( $i = 0; $i < count( $children ); $i++ ){
         echo '<span>';
         echo $html->link(__('しま'.($i+1), true) , "/children/index/?c=".$i,array('escape' => false));
         echo ' </span>';
     }
     if ($i < 3) {
         echo '<span>';
         echo $html->link('+', "/children/register/",array('escape' => false));
         echo ' </span>';
     }
     pr($login_user_data);
    ?>
    <br><br>
    <?php echo $html->link(__('子供設定', true), array('action' => 'edit', '?c='.$lastChildId)); ?>
    <br><br>
    <?php echo $html->link(__('子供削除', true), array('action' => 'delete', '?c='.$lastChildId)); ?>
</div>
<br>
<div>
    <?php echo $html->link('子どもの思い出記録ページ', "/diaries/?c=".$lastChildId ,array('escape' => false));?>
</div>
