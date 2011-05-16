
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

<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="Thu, 01 Dec 1994 16:00:00 GMT">


