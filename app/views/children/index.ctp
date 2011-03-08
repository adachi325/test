<h2>子どものページ</h2>
<div>
    <?php
     //pr($children);
     // 配列の値を改行しながらすべて出力
     for( $i = 0; $i < count( $children ); $i++ ){
         echo '<span>';
         echo $html->link(__('しま'.($i+1), true) , "/children/home/?kodomo=".$i,array('escape' => false));
         echo ' </span>';
     }
     if ($i < 3) {
         echo '<span>';
         echo $html->link('+', "/children/register/",array('escape' => false));
         echo ' </span>';
     }
     
    ?>
    <?php echo $html->link(__('Edit', true), array('action' => 'edit', '1')); ?>
</div>
<br>
<div>
    <?php echo $html->link('子どもの思い出記録ページ', "/diaries/?kodomo=".$i ,array('escape' => false));?>
</div>
