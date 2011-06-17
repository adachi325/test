<?php 
$docomo_community_url = $this->Ktai->is_imode() ? 'http://docomo-community.cp05.docomo.ne.jp/djs/index.xhtml': 'http://docomo-community.com/djs/index.xhtml';
?>
<div align="center" style="text-align:center">
<a href="<?php echo $docomo_community_url; ?>" style="color:#ff3333;">
<?php echo $this->Html->image("docomo_commu_banner.gif", array("alt" => "ドコモコミュニティ" => "100%", "border" => "0")); ?></a></div>

