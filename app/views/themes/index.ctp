<div>
<?php foreach($months as $month): ?>
    <?php foreach($month['Theme'] as $theme): ?>
    <?php
        if(!$theme['free_theme']){
            echo "<p>";
            echo $this->Html->link($theme['title'], '/themes/info/'.$theme['id']);
            echo "</p>";
        }
    ?>
    <?php endforeach; ?>
    <?php foreach($month['Theme'] as $theme): ?>
    <?php
        if($theme['free_theme']){
            echo "<p>";
            echo $this->Html->link($theme['title'], '/themes/info/'.$theme['id']);
            echo "</p>";
        }
    ?>
    <?php endforeach; ?>
<?php endforeach; ?>
</div>
<div>
<?php
if($beforeFlag){
    echo $this->Html->link('前月', '/themes/index/before');
}
?>
</div>
<div>
<?php
if($nextFlag){
    echo $this->Html->link('次月', '/themes/index/next');
}
?>
</div>