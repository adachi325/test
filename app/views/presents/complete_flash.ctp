<div class="presents view">

<?php $path = sprintf(Configure::read('Present.path.flash_output'), $token); ?>

<object declare id="test" data="<?php echo $path; ?>" type="application/x-shockwave-flash" >
<param name="bgcolor" value="ffffff">
<param name="loop" value="on">
<param name="quality" value="high">
</object>

<p>
待受FLASHを作成しました。端末の画像保存機能で保存してお使いください。
</p>

<?php echo $this->Html->link('待受FLASHを作り直す', array('/')); ?>


</div>
