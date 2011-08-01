<?php echo $this->Html->image("ttl_memory.gif", array("alt" => "思い出記録", "width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="center" style="text-align:center"><span style="font-size:x-small; color:#333333;">送信が完了しました!</span></div>
<?php if($diary['Diary']['wish_public'] == 1) : ?>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<div align="left" style="color:#CC0000;text-align:left;">
※思い出の掲載申請を受け付けました｡<br />
掲載申請をいただいた思い出はベネッセによる選定の上､しまじろうひろばに掲載されます｡<br />
※掲載設定が反映されるまでには最大で1週間程お時間がかかります｡ご了承ください｡<br />
</div><!-- 公開希望の場合 -->
<?php endif; ?>
<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>

<?php if($diary['Diary']['error_code'] === 'E001') : ?>
<div style="color:#CC0000;text-align:left;" align="left">
以下の理由により､写真を保存できませんでした｡<br /><br />
&nbsp;･ﾌｧｲﾙｻｲｽﾞが2MB以上<br /><br />
<span style="color:#666666">写真をつけて思い出記録を残したい場合は､JPG形式で容量が2MB以内の写真を添付して再度送信し直してください｡</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "20")); ?><br />
</div><!--写真サイズエラーの場合-->
<?php elseif($diary['Diary']['error_code'] === 'E002') : ?>
<div style="color:#CC0000;text-align:left;" align="left">
以下の理由により､写真を保存できませんでした｡<br /><br />
&nbsp;･ﾌｧｲﾙ形式が非対応ﾌｫｰﾏｯﾄ<br /><br />
<span style="color:#666666">写真をつけて思い出記録を残したい場合は､JPG形式で容量が2MB以内の写真を添付して再度送信し直してください｡</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "20")); ?><br />
</div><!--形式エラーの場合-->
<?php endif; ?>

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

<?php if(!empty($diary['Diary']['present_id'])) :
$imgMonth = sprintf('%02d', $diary['Month']['month']);
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
        $text = 'さっそくこの待受Flashを作成';
        $url = $this->Html->url('/presents/present_list/'.$diary['Present']['present_type']);
	break;
case 3:
	$desc = 'ﾎﾟｽﾄｶｰﾄﾞのﾃﾝﾌﾟﾚｰﾄをﾌﾟﾚｾﾞﾝﾄ';
        $text = 'さっそくこのﾎﾟｽﾄｶｰﾄﾞを作成';
        $url = $this->Html->url('/presents/present_list/'.$diary['Present']['present_type']);
	break;
default:
	$desc = '不正なﾌﾟﾚｾﾞﾝﾄIDが指定されました';
	break;
}
?>
<div style="text-align:center;" align="center">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#FF3399"><?php echo $desc; ?></span><span style="color:#ff0000"><?php $this->Ktai->emoji(0xE685); ?></span><br />
<?php if ($type == 0): ?>
        <div>
            <span>
            <?php echo $this->Html->image(sprintf(Configure::read('Present.sample150.0'),  $diary['Month']['year'], $imgMonth), array("style" => "margin:10px 0;")); ?>
            </span>
        </div>
<?php elseif ($type == 1): ?>
	<br /><br />
	<div><?php echo $html->image($diary['Present']['present_path']); ?></div>
        <?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
        <div>端末ﾒﾆｭｰ(機能)の画像保存からﾃﾞｺﾒを保存してね♪</div>

<?php else: ?>
<?php
echo $this->Html->image(sprintf(Configure::read('Present.sample150.'.($type-1)), $diary['Month']['year'], $imgMonth), array("style" => "margin:10px 0;"));
?>
<?php endif;?>
</div>
<div align="center" style="text-align:center;"><?php echo $this->Html->image("dot_line_green.gif", array()); ?></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />
<?php endif; ?>


<?php if (isset($text)): ?>
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $url; ?>" style="color:#339900;"><span style="color:#339900; font-size:x-small;"><?php echo $text; ?></span></a><br />
<?php endif; ?>

<div align="center" style="text-align:center;"><?php echo $this->Html->image("docomo_commu_banner.gif", array("url" => '/diaries/post/' . $diary['Diary']['id'], "style" => "margin:5px 0 5px 0;", "alt" => "ドコモコミュニティバナー", "width" => "100%")); ?></div>
<br />
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/diaries/info/'.$diary['Diary']['id']); ?>" style="color:#339900;"><span style="color:#339900; font-size:x-small;">送信した思い出を見る</span></a><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "5")); ?><br />
<span style="color:#339933;">&nbsp;･</span><a href="<?php echo $this->Html->url('/themes/info/'.$diary['Diary']['theme_id']); ?>" style="color:#339900;"><span style="color:#339900; font-size:x-small;">もう一回思い出を書く</span></a><br />

<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "10")); ?><br />

