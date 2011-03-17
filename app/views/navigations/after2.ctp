<div>
◆まずは投稿してみよう！
</div>
<br>
<div>
    <?php echo $html->link("投稿する", "mailto:".$mailStr); ?>
</div>
<br>
<div>
    <?php echo $this->Html->link('今は投稿しないで、マイページに進む', '/children/'); ?>
</div>
<br>
<div>
    <?php echo $this->Html->link('投稿したよ', '/navigations/after3/'.$nexthash); ?>
</div>