<?php 
// ドコモコミュニティのリンク先を設定する
if($this->Session->read('Auth.User.dc_user')) {
    if ($this->Ktai->is_imode()) {
      $docomo_commu_url = 'http://docomo-community.cp05.docomo.ne.jp/dj/';
    } else {
      $docomo_commu_url = 'http://docomo-community.com/djs/index.xhtml';
    }
} else {
    $urlItem = split('\/',$_SERVER["SCRIPT_NAME"]);
    $docomo_commu_url = '/'.$urlItem[1].'/diaries/post_info';
}
?>
<div align="center" style="text-align:center">
<a href="<?php echo $docomo_commu_url; ?>" style="color:#ff3333;">
<?php echo $this->Html->image("docomo_commu_banner.gif", array("alt" => "ドコモコミュニティ", "width" => "100%", "border" => "0")); ?></a></div>

