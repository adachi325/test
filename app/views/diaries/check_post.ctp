<?php echo $this->Html->image("ttl_memory.gif", array("width" => "100%", "style" => "margin-bottom:10px;")); ?><br />

<div style="text-align:center;" align="center">
送信が完了しました!<br />
</div>

<?php if($diary['Diary']['error_code'] === 'E001') : ?>
<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>
<div style="color:#CC0000;text-align:left;" align="left">
以下の理由により､写真を保存できませんでした｡<br /><br />
・ﾌｧｲﾙｻｲｽﾞが2MB以上<br /><br />
<span style="color:#666666">写真をつけて思い出記録を残したい場合は､JPG形式で容量が2MB以内の写真を添付して再度送信し直してください｡</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "20")); ?><br />
</div><!--写真サイズエラーの場合-->

<?php elseif($diary['Diary']['error_code'] === 'E002') : ?>
<div style="color:#CC0000;text-align:left;" align="left">
以下の理由により､写真を保存できませんでした｡<br /><br />
・ﾌｧｲﾙ形式が非対応ﾌｫｰﾏｯﾄ<br /><br />
<span style="color:#666666">写真をつけて思い出記録を残したい場合は､JPG形式で容量が2MB以内の写真を添付して再度送信し直してください｡</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "20")); ?><br />
</div><!--形式エラーの場合-->
<?php endif; ?>


<?php if(!empty($diary['Diary']['present_id'])) : ?>
<?php 
$desc = '';
$type = $diary['Present']['present_type'];

switch ($type) {
case 0:
	$desc = '思い出記録の背景をﾌﾟﾚｾﾞﾝﾄ';
	break;
case 1:
	$desc = 'ﾃﾞｺﾒ絵文字をﾌﾟﾚｾﾞﾝﾄ';
	break;
case 2:
	$desc = '待受Flashをﾌﾟﾚｾﾞﾝﾄ';
	break;
case 3:
	$desc = 'ﾎﾟｽﾄｶｰﾄﾞのﾃﾝﾌﾟﾚｰﾄをﾌﾟﾚｾﾞﾝﾄ';
	break;
default:
	$desc = '不正なﾌﾟﾚｾﾞﾝﾄIDが指定されました';
	break;
}
?>
<?php
$url = $this->Html->url('/presents/present_list/'.$diary['Present']['present_type']);
if ($type === 2) {
	$text = 'さっそくこの待受Flashを作成';
} elseif ($type === 3) {
	$text = 'さっそくこのﾎﾟｽﾄｶｰﾄﾞを作成';
}
?>
	
<div style="text-align:center;" align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#FF3399"><?php $this->Ktai->emoji(0xE685); ?><?php echo $desc; ?></span><br />

<?php if ($type === 0): ?>
        <div>
            <span>
            <?php
            $imgMonth = sprintf('%02d', $$diary['Month']['month']);
            echo $html->image('/'.sprintf(Configure::read('Present.path.diaryback_t'), $diary['Month']['year'], $imgMonth));
            ?>
            </span>
        </div>
<?php elseif ($type === 1): ?>
		<div><?php echo $html->image($diary['Present']['present_path']); ?></div>
        <br>
        <div>端末ﾒﾆｭｰ(機能)の画像保存からﾃﾞｺﾒを保存してね♪</div>

<?php else: ?>
		<?php echo $html->image($diary['Present']['present_thumbnail_path'], 
				array("style" => "margin:10px 0;")); ?>
<?php endif;?>

</div>
<?php endif; ?>

<?php if(!empty($diary['Diary']['present_id'])) : ?>

<div align="center" style="text-align:center"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<?php endif; ?>
<?php pr('----'.$text.'----'); ?>
<?php if (isset($text)): ?>
<span style="color:#339933;">・</span>
<span style="color:#339900;"><a href="<?php echo $url; ?>" style="color:#339900;"><?php echo $text; ?></a></span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php endif; ?>

<span style="color:#339933;">・</span><a href="<?php echo $this->Html->url('/diaries/info/'.$diary['Diary']['id']); ?>" style="color:#339900;"><span style="color:#339900;">送信した思い出を見る</span></a><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />


