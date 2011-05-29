<h1>あげたはなまる一覧</h1>
<hr />

全<?php echo $hanamaru_total; ?>コ <?php echo $paginator->counter(array('format' => "%count%件中 %start%件〜%end%件を表示"));?>
<hr />
<table border="1">
<?php foreach ($hanamarus as $hanamaru): ?>
<?php echo $this->element('hanamarus/diary', array('hanamaru' => $hanamaru));?>
<?php endforeach; ?>
</table>
<hr />
<?php echo $paginator->prev('前へ', null, null, array('class' => 'disabled')); ?>
<?php echo $paginator->next('次へ', null, null, array('class' => 'disabled')); ?>

