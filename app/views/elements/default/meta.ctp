
<?php
    if (isset($_SERVER['HTTPS'])) {
	if ($this->Ktai->is_ezweb()) {
	    echo '<meta http-equiv="Content-type" content="text/html; charset=sjis-win">';
	} else {
	    echo '<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />';
	}
    } else {
	echo '<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />';
    }
?>

<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="Thu, 01 Dec 1994 16:00:00 GMT" />

<!-- SEO -->

<meta keyword="しまじろう,ひろば,ゲーム,こどもちゃれんじ,こどもチャレンジ,思い出,記録,成長,赤ちゃん,アルバム,育児,日記" />
<meta description="“しまじろうひろば”はこどもちゃれんじ公式サイト。知育ゲームや思い出記録など盛りだくさん！" />

