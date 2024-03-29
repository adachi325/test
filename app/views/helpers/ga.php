<?php
class GaHelper extends Helper {
  private $GA_ACCOUNT="";
  private $GA_PIXEL="/ga.php";
  function getUrl() {

    $this->GA_ACCOUNT = Configure::read('GoogleAnalytics.TrackingCode.'.$_SERVER["SERVER_NAME"]);
    $urlItem = split('\/',$_SERVER["SCRIPT_NAME"]);

    $url = "";
    $url .= "/".$urlItem[1].$this->GA_PIXEL . "?";
    $url .= "utmac=" . $this->GA_ACCOUNT;
    $url .= "&utmn=" . rand(0, 0x7fffffff);
    $referer = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '';
    $query = $_SERVER["QUERY_STRING"];
    $path = $_SERVER["REQUEST_URI"];
    if (empty($referer)) {
      $referer = "-";
    }
    $url .= "&utmr=" . urlencode($referer);
    if (!empty($path)) {
      $url .= "&utmp=" . urlencode($path);
    }
    $url .= "&guid=ON";
    return str_replace("&", "&amp;", $url);
  }
}
?>