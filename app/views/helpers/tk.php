<?php
class tkHelper extends Helper {

    /*
     * USER_AGENTからドコモのブラウザバージョンを返す。
     * ver1.0 : true
     * ver2.0 : false
     */
    function imode_browser_v1(){

        $ua = $_SERVER['HTTP_USER_AGENT'];

        if(ereg('DoCoMo/1.0/',$ua)){
            return true;
        } else if(ereg('DoCoMo/2.0',$ua)){
            if (ereg('c100\;',$ua)) {
                return true;
            }
        }
        return false;
    }

}


?>
