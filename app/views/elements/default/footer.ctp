<!-- footer -->
<div align="center" style="background:#996633; text-align:center;">
<?php echo $this->Html->image("footer_pic.gif", array("alt" => "フッター画像", "width" => "100%")); ?><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />
<table width="100%" cellpadding="0" cellspacing="0" align="center">
<tr>

<td align="left"><span style="font-size:x-small"><?php
if (!(($this->params['controller'] == 'articles' && $this->params['action'] == 'top') || ($this->params['controller'] == 'articles' && $this->params['action'] == 'timeline'))):
?>

<?php 
    if (isset($_SERVER['HTTPS']) && $this->Ktai->is_ezweb()) {
	    echo '<span style="color:#ffcc33;"><img localsrc="188" /></span>';
    } else {
	    echo '<span style="color:#ffcc33;">'.$this->Ktai->emoji(0xE6EA,false).'</span>';
    }
?>
<a href="<?php echo $this->Html->url('/'); ?>" style="color:#ffffff;" accesskey="9"><span style="color:#ffffff;">ﾄｯﾌﾟﾍﾟ-ｼﾞへ</span></a><br />
<?php else: ?>
<a href="<?php echo $this->Html->url('/'); ?>" style="color:#ffffff;" accesskey="9"><span style="color:#ffffff;">育児なうﾄｯﾌﾟへ</span></a><br />
<?php endif; ?>

<span style="color:#ffcc33;">&nbsp;･</span><a href="<?php echo $this->Html->url('/diaries/top/'); ?>" style="color:#ffffff;"><span style="color:#ffffff;">思い出記録ﾄｯﾌﾟへ</span></a><br />
<span style="color:#ffcc33;">&nbsp;･</span><a href="<?php echo $this->Html->url('/lines/top/'); ?>" style="color:#ffffff;"><span style="color:#ffffff;">こどもちゃれんじﾄｯﾌﾟへ</span></a></span>
</td>
</tr>
</table>
<div align="center" style="text-align:center;"><?php echo $this->Html->image("footer_line_yellow.gif", array()); ?></div>
<table width="100%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="left"><span style="font-size:x-small;"><span style="color:#ffcc33;">&nbsp;･</span><a href="<?php echo $this->Html->url('/pages/list_models'); ?>" style="color:#ffffff;"><span style="color:#ffffff;">対応機種</span></a></span></td>
<td align="left"><span style="font-size:x-small;"><span style="color:#ffcc33;">&nbsp;･</span><a href="<?php echo $this->Html->url('/pages/charges'); ?>" style="color:#ffffff;"><span style="color:#ffffff;">通信料の目安</span></a></span></td>
</tr>
<tr>
<td colspan="2" align="left"><span style="font-size:x-small;"><span style="color:#ffcc33;">&nbsp;･</span><a href="<?php echo $this->Html->url('/pages/help'); ?>" style="color:#ffffff;"><span style="color:#ffffff;">よくある質問･問い合わせ</span></a></span></td>
</tr>
<tr>
<?php if ($this->Session->read('Auth.User')): ?>
<td align="left"><span style="font-size:x-small;"><span style="color:#ffcc33;">&nbsp;･</span><a href="<?php echo $this->Html->url('/users/menu/')?>" style="color:#ffffff;"><span style="color:#ffffff;">設定変更</span></a></span></td>
<td align="left"><span style="font-size:x-small;"><span style="color:#ffcc33;">&nbsp;･</span><a href="<?php echo $this->Html->url('/pages/rules'); ?>" style="color:#ffffff;"><span style="color:#ffffff;">利用規約</span></a></span></td>
<?php else: ?>
<td colspan="2" align="left"><span style="font-size:x-small;"><span style="color:#ffcc33;">&nbsp;･</span><a href="<?php echo $this->Html->url('/pages/rules'); ?>" style="color:#ffffff;"><span style="color:#ffffff;">利用規約</span></a></span></td>
<?php endif; ?>
</tr>
<tr>
<td colspan="2" align="left"><span style="font-size:x-small;"><span style="color:#ffcc33;">&nbsp;･</span><a href="http://shimajiromobile.benesse.ne.jp/ap1/about/" style="color:#ffffff;"><span style="color:#ffffff;">ｹｰﾀｲしまじろうひろばとは</span></a></span></td>
</tr>
</table>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />
<div align="center" style="text-align:left; margin-left:5px; margin-right: 5px;">
<span style="font-size:xx-small; color:#ffffff;">このｻｰﾋﾞｽはﾍﾞﾈｯｾｺｰﾎﾟﾚｰｼｮﾝと<br />
NTTﾄﾞｺﾓの共同で提供しています</span></div>
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />
<div align="center" style="background:#663300; text-align:center;">
<span style="color:#ffffff;">
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?><br />
<?php $this->Ktai->emoji(0xE731); ?> <a href="http://c.benesse.co.jp/co/" style="color:#ffffff;"><span style="color:#ffffff;">Benesse Corporation</span></a><br />
&amp;<?php $this->Ktai->emoji(0xE731); ?> NTT DOCOMO</span><br />
<?php echo $this->Html->image("spacer.gif", array("width" => "1", "height" => "7")); ?>
</div>
</div>
<!-- footer -->

