
<?php 
if ($login_user) {
  if ($this->name == 'Articles' && $this->action == 'timeline') { // 会員かつタイムラインコントローラー上の場合
    $url_all = $this->Html->url('/articles/timeline/');
    $url_diaries = $this->Html->url('/articles/timeline/1/');
    $url_news = $this->Html->url('/articles/timeline/2/');
    $url_notify = $this->Html->url('/articles/timeline/3/');
    $url_test = $this->Html->url('/articles/timeline/4/');
  } else { // 会員 上記以外の場合
    $url_all = $this->Html->url('/articles/top/');
    $url_diaries = $this->Html->url('/articles/top/1/');
    $url_news = $this->Html->url('/articles/top/2/');
    $url_notify = $this->Html->url('/articles/top/3/');
    $url_test = $this->Html->url('/articles/top/4/');
  }
} else { // 非会員の場合は会員登録ナビ(601)
  $url_all = $this->Html->url('/navigations/prev/1');
  $url_diaries = $this->Html->url('/navigations/prev/1');
  $url_news = $this->Html->url('/navigations/prev/1');
  $url_notify = $this->Html->url('/navigations/prev/1');
  $url_test = $this->Html->url('/navigations/prev/1');
}

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td><span style="font-size:x-small; color:#ff9900;">▼ｶﾃｺﾞﾘ別に見る</span><br /><span style="font-size:x-small; color:#333333;"><a href="<?php echo $url_news; ?>" style="color:#0099FF;"><span style="color:#0099FF;">ﾆｭｰｽ</span></a>｜<a href="<?php echo $url_test; ?>"><span style="color:#9933CC;">心理ﾃｽﾄ</span></a>｜<a href="<?php echo $url_diaries; ?>"><span style="color:#339900;">お友達の様子</span></a><br />
<a href="<?php echo $url_notify; ?>"><span style="color:#ff9900;">お知らせ</span></a>｜<a href="<?php echo $url_all; ?>"><span style="color:#ff9900;">すべて</span></a></span></td>
</tr>
</table>

