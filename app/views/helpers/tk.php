<?php
class tkHelper extends Helper {
    
    public $tk_style;
    public $tk_mode;

    //入力モード設定補助
    function beforeRender() {
        //  DoCoMo 用
        if (ereg( "DoCoMo", $_SERVER["HTTP_USER_AGENT"] )) {
            $this->tk_style = "istyle";
            $this->tk_mode['1'] = 1;
            $this->tk_mode['2'] = 2;
            $this->tk_mode['3'] = 3;
            $this->tk_mode['4'] = 4;
        //  ezweb 用
        } elseif (ereg( "UP\.Browser", $_SERVER["HTTP_USER_AGENT"] )) {
            $this->tk_style = "format";
            $this->tk_mode['1'] = "*M";
            $this->tk_mode['2'] = "*M";
            $this->tk_mode['3'] = "*m";
            $this->tk_mode['4'] = "*N";
        //  J-Phone 用
        } elseif (ereg( "J-PHONE", $_SERVER["HTTP_USER_AGENT"] )
               || ereg( "SoftBank", $_SERVER["HTTP_USER_AGENT"] )
               || ereg( "Vodafone", $_SERVER["HTTP_USER_AGENT"] )) {
            $this->tk_style = "mode";
            $this->tk_mode['1'] = "hiragana";
            $this->tk_mode['2'] = "katakana";
            $this->tk_mode['3'] = "alphabet";
            $this->tk_mode['4'] = "numeric";
        }
    }

    /*
     * USER_AGENTからドコモのブラウザバージョンを返す。
     * ver1.0 : true
     * ver2.0 : false
     */
    function is_imode_browser(){

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
