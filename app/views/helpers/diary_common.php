<?php
class DiaryCommonHelper extends Helper {
  var $helpers = array('Time');

  /*
   * 思い出記録の掲載ステータスを返します。
   * 
   * 掲載希望フラグが 0 の場合、非公開
   * 掲載希望フタグが 1 かつ
   *   許可フラグが 0 または 1 の場合、公開申請中
   *   許可フラグが 2 かつ
   *     公開日が現在より前の場合、●月●日公開予
   *     公開日が現在以降の場合、公開中！
   *     
   * in: 掲載希望フラグ (diaries.wish_public)
   * in: 許可フラグ (diaries.permit_status)
   * in: 公開日 (articles.release_date)
   * in: 非公開の場合は空文字列とするか
   * out: 掲載ステータス
   */
  function publicStatus($wish_public = 0, $permit_status = 0, $release_date = null, $withoutClosed = false) {
     
    $status = $withoutClosed ? "" : "非公開";

    if ($wish_public == 1) {
    
      if ($permit_status == 0 || $permit_status == 1) {
    
        $status = "公開申請中";
    
      } elseif ($permit_status == 2) {
    
        $current_time = time();
        $publish_time = strtotime($release_date);
    
        if ($current_time >= $publish_time) {
          $status = "公開中!";
        } else {
          $status = $this->Time->format('n月j日公開予定', $release_date);
        }
      } 
    }

    return $status;
  }

  /*
   * 記事IDを4桁-6桁でハイフン区切りします。
   *
   * in: 記事ID
   * out: 4桁と6桁のハイフン区切りの文字列。10桁以外の場合はそのまま返却する。
   */
  function hyphenateIdentifyToken($token) {

    if (!preg_match("/^\d{10}$/", $token)) {
      return $token;
    }

    $token = substr($token, 0, 4) . '-' . substr($token, 4, 6);
    return $token;
  }
  
}

