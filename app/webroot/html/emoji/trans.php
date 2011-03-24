<?php

//„¡„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ
//„  [ EMOJI TRANS Ver2.3]
//„  trans.php - 2008/06/15
//„  Copyright (C) DSPT.NET
//„  webmaster@dspt.net
//„  http://www.dspt.net/
//„¤„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ„Ÿ
	
/********************** ‰ŠúÝ’è ***********************/
	//ŠG•¶Žš•ÏŠ·•\
	$emoji_data = "emojix.csv";
	
	//“ü—Í’lŽæ“¾
	$num = $_GET["emoji"];
	
	//PC—pŠG•¶ŽšŠi”[ƒtƒHƒ‹ƒ_
	$img_dir = "/emoji/images/";
	
	//ƒhƒRƒ‚¨auŠG•¶ŽšŽ©“®•ÏŠ·—˜—pion:1 off:0j
	$ie = "1";
	
/********************** ˆÈ‰º‚©‚ç‚Í‰ü•Ï‚µ‚È‚¢‚Ù‚¤‚ª–³“ï ***********************/
	
	//•ÏŠ·•\‚ð”z—ñ‚ÉŠi”[
	$emoji_array = array(); 
	$emoji_array[] = ""; 
	$contents = @file($emoji_data); 
	foreach($contents as $line){ 
		$line = rtrim( $line ); 
		$emoji_array[] = explode(",", $line); 
	}
	
	function encode($data) {
		$data = mb_convert_encoding($data, "SJIS", "auto");
		return $data;
	}
	
	//Œg‘ÑUAŽæ“¾
	$agent = $_SERVER["HTTP_USER_AGENT"];
	
	//Œg‘Ñ’[––‚Ìƒ†[ƒUƒG[ƒWƒFƒ“ƒg‚ð”»’è
	function mobile($data){
		if(preg_match("/^DoCoMo\/[12]\.0/i", $data))
		{
    		return "i";// i-mode
		}
		elseif(preg_match("/^(J\-PHONE|Vodafone|MOT\-[CV]980|SoftBank)\//i", $data))
		{
    		return "s";// softbank
		}
		elseif(preg_match("/^KDDI\-/i", $data) || preg_match("/UP\.Browser/i", $data))
		{
    		return "e";// ezweb
		}
		elseif(preg_match("/^PDXGW/i", $data) || preg_match("/(DDIPOCKET|WILLCOM);/i", $data))
		{
    		return "w";// willcom
		}
		elseif(preg_match("/^L\-mode/i", $data))
		{
    		return "l";// l-mode
		}
		else {
    		return "p";// pc
		}
	}
	
	//Œg‘ÑƒLƒƒƒŠƒA‚É‡‚í‚¹‚ÄŠG•¶Žš‚ðo—Í
	function emoji($data) {
		global $agent,$emoji_array,$img_dir,$ie;
		if(preg_match("/[0-9]{1,3}/", $data) && is_numeric($data) && 0 < $data && $data < 253) {
			switch(mobile($agent)){
				case "i";
					$put = $emoji_array[$data][1];
					break;
				case "e";
					if (preg_match("/[^0-9]/", $emoji_array[$data][2])) {
						$put = $emoji_array[$data][2];
					} elseif ($ie > 0) {
						$put = $emoji_array[$data][1]; // Display such the icons that ezserver transformed as docomo i-emoji.
					} else {
						$put = "<img localsrc=\"".$emoji_array[$data][2]."\" />";
					}
					break;
				case "s";
					if (preg_match("/^[A-Z]{1}?/", $emoji_array[$data][3])) {
						$put = "\x1B\$".encode($emoji_array[$data][3])."\x0F";
					} else {
						$put = encode($emoji_array[$data][3]);
					}
					break;
				case "p";
					$put = "<img src=\"".$img_dir.$emoji_array[$data][0].".gif\" width=\"12\" height=\"12\" border=\"0\" alt=\"\" />";
					break;
			}
			echo $put;
		}
		else {
			echo "[Error!]\n";
		}
	}
	
	//ˆ—
	emoji($num);

?>
