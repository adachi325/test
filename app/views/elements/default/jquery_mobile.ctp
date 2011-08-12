<?php
echo $this->Html->css('android_reset.css');
echo $this->Html->css('http://code.jquery.com/mobile/latest/jquery.mobile.min.css');

echo $this->Html->Script('http://code.jquery.com/jquery.min.js');

?>
<script>
$(document).bind("mobileinit", function(){
    $.mobile.ajaxLinksEnabled = false; // Ajax を使用したページ遷移を無効にする
    $.mobile.ajaxFormsEnabled = false; // Ajax を使用したフォーム遷移を無効にする
});
</script>
<?php 
if (!($this->params['controller'] == 'articles' && $this->params['action'] == 'top')) {
    echo $this->Html->Script('http://code.jquery.com/mobile/latest/jquery.mobile.min.js');
}
echo $this->Html->css('android_style.css');
?>
