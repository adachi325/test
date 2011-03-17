<div>
★☆投稿ありがとう！☆★
</div>
<br>
<div>
背景テンプレートをGETしたよ！
</div>
<br>
<div>
<?php
echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_h'), date('Y'), date('m')),
        array('width' => '200px', 'height' => '50px'));
?>
</div>
<br>
<div>
<?php
echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_f'), date('Y'), date('m')),
        array('width' => '200px', 'height' => '50px'));
?>
</div>
<br>
<div>
    <?php echo $this->Html->link('次へ', '/navigations/after4/'.$nexthash); ?>
</div>