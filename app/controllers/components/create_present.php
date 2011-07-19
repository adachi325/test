<?php

class CreatePresentComponent extends Object {

    function createFlash($args){
        //引数確認
        if(empty($args)){
            return false;
        }
        // テンプレートの指定
        $template = WWW_ROOT.sprintf(Configure::read('Present.path.screen'), $args['present_id']);

	$this->log("1:".$template,LOG_DEBUG);

        // アサイン用変数の設定
        $assign = array(
            // 差し込み画像
            'pic_01' => WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_postcard'), $args['child_id'], $args['diary_id'][0]),
            'pic_02' => WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_postcard'), $args['child_id'], $args['diary_id'][1]),
            'pic_03' => WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_postcard'), $args['child_id'], $args['diary_id'][2]),
        );

        // Almeidaインスタンスを生成
        $almeida = new Almeida();

        // Almeidaに変数をアサイン
        foreach($assign as $name => $value) {
            // UTF-8でアサイン
            $almeida->setVariable($name, mb_convert_encoding($value,"UTF-8","UTF-8"));
            //$almeida->setVariable($name, $value);
        }

        // 文字コードの設定
        $almeida->setVariable("Media.Flash.Codepage","SJIS");

        // テンプレートのロード
        $almeida->load($template);

        // ファイルへ出力する場合
        $outfile = WWW_ROOT.'img/photo/'.$args['child_id'].'/'.$args['child_id'].'.swf';
        $almeida->generateToFile($outfile);

        system("chmod 777 ".$outfile);

        return $outfile;
    }


    function createPostCard($args){
        //引数確認
        if(empty($args)){
            return false;
        }

        /******** ポストカード作成 ********/

        //下地画像生成（はがきサイズ）
	$new_image = ImageCreateTrueColor(566, 840);

        //思い出画像読み込み
	$diaryImgA = ImageCreateFromJpeg(WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_postcard'), $args['child_id'], $args['diary_id'][0]));
	$diaryImgB = ImageCreateFromJpeg(WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_postcard'), $args['child_id'], $args['diary_id'][1]));
	$diaryImgC = ImageCreateFromJpeg(WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_postcard'), $args['child_id'], $args['diary_id'][2]));
        $diaryImgD = ImageCreateFromJpeg(WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_postcard'), $args['child_id'], $args['diary_id'][3]));

        //テンプレート画像読み込み
        $template = imageCreateFromPng(WWW_ROOT.sprintf(Configure::read('Present.path.postcard'), $args['present_id']));

	//下地画像へ、思い出画像を合成
	ImageCopy($new_image, $diaryImgA, 70, 88, 0, 0, 210, 210);
        ImageCopy($new_image, $diaryImgB, 280, 88, 0, 0, 210, 210);
        ImageCopy($new_image, $diaryImgC, 70, 300, 0, 0, 210, 210);
        ImageCopy($new_image, $diaryImgD, 280, 300, 0, 0, 210, 210);

        //下地画像へ、テンプレート画像を合成
        ImageCopy($new_image, $template, 0, 0,  0, 0, 566, 840);

        //画像名生成
        $new_file_name = md5($args['child_id'].time());
	if (mb_strlen ($new_file_name) > 20) {
	    $new_file_name = substr($new_file_name,0,20);
	}

	//画像保存
	$result = ImageJPEG($new_image, (WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output'), $new_file_name)), 100);
	if(!$result){
	    $this->log("ポストカード作成に失敗しました。",LOG_DEBUG);
	    $this->log($result,LOG_DEBUG);
	}

        /******** サムネイル作成 ********/

        //サムネイル元画像読み込み
        $image = imagecreatefromjpeg(WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output'), $new_file_name));

        //画像のサイズを取得
        $width = ImageSX($image); //横幅（ピクセル）
        $height = ImageSY($image); //縦幅（ピクセル）

        //サイズ指定
        $new_width = 150;

        //リサイズの圧縮比
        $rate = $new_width / $width;
        $new_height = $rate * $height;

        //空の画像用意
        $new_thumbnail = ImageCreateTrueColor($new_width, $new_height);

        //リサイズした画像を空の画像にコピー
        ImageCopyResized($new_thumbnail,$image,0,0,0,0,$new_width,$new_height,$width,$height);

	//画像保存
	$result2 = ImageJPEG($new_thumbnail, (WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_thum'), $new_file_name)), 100);
	if(!$result2){
	    $this->log("ポストカードサムネイル作成に失敗しました。",LOG_DEBUG);
	    $this->log($result,LOG_DEBUG);
	}
       
        //メモリを開放します
        imagedestroy($new_image);
        imagedestroy($new_thumbnail);
        ImageDestroy($diaryImgA);
        ImageDestroy($diaryImgB);
        ImageDestroy($diaryImgC);
        ImageDestroy($diaryImgD);
        ImageDestroy($image);
        
        /******** ワンタイムURL登録 ********/

        $postcard_url =& ClassRegistry::init('postcardUrl');
        $options = array(
            'child_id' => 2,
            'token' => $new_file_name
            );
        $postcard_url->create();
        if (!$postcard_url->save($options)) {
	    $this->log("ワンタイムURL登録に失敗しました。",LOG_DEBUG);
	    $this->log($options,LOG_DEBUG);
            //データ登録に失敗した場合、ファイルを消す。
            unlink( WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output'), $new_file_name) );
            unlink( WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_thum'), $new_file_name) );
            return false;
        }

        return $new_file_name;

    }
    
    /** 
     * 指定されたサイズへ画像リサイズ
     * リサイズしたファイルのパスを返す。
     * @param  string    $inputPath   : ファイルフルパス
     * @param  string    $outPutPath : リサイズ後ファイルフルパス
     * @param  int       $size       : 圧縮基本値
     * @param  int       $mainline   : 1=X主軸, 2=Y主軸
     * @return boolean   $result     : 結果
     */
    function imageReSize($inputPath = null, $outPutPath = null, $size = null ,$mainline = null){
        
        //引数ﾁｪｯｸ
        if(empty($mainline) || preg_match("/^[1-2]$/", $size)){
	    $this->log("FileResizeException：引数エラー(mainline)",LOG_DEBUG);
	    $this->log($mainline,LOG_DEBUG);
            return false;
        }
        if(empty($size) || preg_match("/^[0-9]+$/", $size)){
	    $this->log("FileResizeException：引数エラー(size)",LOG_DEBUG);
	    $this->log($mainline,LOG_DEBUG);
            return false;
        }
        if(empty($inputPath) || (file_exists($inputPath))){
	    $this->log("FileResizeException：引数エラー(inputPath)",LOG_DEBUG);
	    $this->log($mainline,LOG_DEBUG);
            return false;
        }
        if(empty($inputPath) || (file_exists($outPutPath))){
	    $this->log("FileResizeException：引数エラー(outPutPath)",LOG_DEBUG);
	    $this->log($mainline,LOG_DEBUG);
            return false;
        }
        
        //元ﾌｧｲﾙ読込
        $image = imagecreatefromjpeg($inputPath);
        
        //元ﾌｧｲﾙXY取得
        $width = ImageSX($image); //横幅（ピクセル）
        $height = ImageSY($image); //縦幅（ピクセル）
        
        if($mainline == 1){
            //X主軸ﾘｻｲｽﾞ
            $rate = $size / $width;
            $new_height = $rate * $height;
            $new_width = $size;
        } else {
            //Y主軸ﾘｻｲｽﾞ
            $rate = $size / $height;
            $new_width = $rate * $width;
            $new_height = $size;
        }

        //空画像用意
        $new_thumbnail = ImageCreateTrueColor($new_width, $new_height);

        //ｻﾑﾈｲﾙ生成
        ImageCopyResampled($new_thumbnail,$image,0,0,0,0,$new_width,$new_height,$width,$height);

	//ﾌｧｲﾙ保存
	$result2 = ImageJPEG($new_thumbnail, $outPutPath, 100);
	if(!$result2){
	    $this->log("MakeFileException：SystemError",LOG_DEBUG);
            $this->log("配置先フォルダのパーミッション等を確認してください。",LOG_DEBUG);
	    $this->log($result,LOG_DEBUG);
            return false;
	}
        return true;
    }

<<<<<<< HEAD
    /**
     * スマートフォン用待受け静止画像および画像作成
     * @param  string    args['child_id']   : child_id
     * @param  string    args['present_id']   : テンプレートpresent_id
     * @param  string    args['diary_id[0-2]']   : diary_id
     * @return boolean   $result     : 結果
     */
    function createWallpaper4SmartPhone($args){
         //引数確認
        if(empty($args)){
            return false;
        }

        /******** 待受け作成 ********/
        $wallpaper_width = Configure::read('Present.template.wallpaper.size_smartphone.width');
        $wallpaper_height = Configure::read('Present.template.wallpaper.size_smartphone.height');
        
        //下地画像生成
	$new_image = ImageCreateTrueColor($wallpaper_width, $wallpaper_height);

        //思い出画像読み込み
        $diaries_in_template = array();
        for($i = 0 ; $i < 3 ; $i++){
            $diary_img_path = WWW_ROOT.'img'.DS.sprintf(Configure::read('Diary.image_path_wallpaper_for_smartphone'), $args['child_id'], $args['diary_id'][$i]);
            $diaryImg = ImageCreateFromJpeg($diary_img_path);
            if($diaryImg === FALSE){
                $this->log('[createWallpaper4SmartPhone][ImageCreateFromJpeg]待受け画像作成失敗.'.$diary_img_path,LOG_DEBUG);
                return false;            
            }
            $diaries_in_template[$i] = $diaryImg;
        }

        //テンプレート画像読み込み
        $template = imageCreateFromPng(WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_for_smartphone'), $args['present_id']));
	if($template === FALSE){
	    $this->log('[createWallpaper4SmartPhone][imageCreateFromPng]待受け画像作成失敗.'.WWW_ROOT.'img/'.sprintf(Configure::read('Present.path.wallpaper_for_smartphone'), $args['present_id']),LOG_DEBUG);
            return false;            
        }

	//下地画像へ、思い出画像を合成
        //各思い出の位置
        $positions_in_template = Configure::read('Present.incentive.position_in_wallpaper_smartphone');
        $diary_size = Configure::read('Diary.image_size_wallpaper_for_smartphone');
        for($i = 0; $i < 3; $i++){
            if(!ImageCopy($new_image, $diaries_in_template[$i], 
                            $positions_in_template[$i]['x'], $positions_in_template[$i]['y'], 
                            0, 0, $diary_size, $diary_size)){
                $this->log('[createWallpaper4SmartPhone][ImageCopy]待受け画像作成失敗。思い出画像を合成。'.($i+1).'番目の画像。', LOG_DEBUG);
                return false;
            }           
        }

        //下地画像へ、テンプレート画像を合成
        if(!ImageCopy($new_image, $template, 0, 0,  0, 0, $wallpaper_width, $wallpaper_height)){
	    $this->log('[createWallpaper4SmartPhone][ImageCopy]待受け画像作成失敗。テンプレートの合成に失敗',LOG_DEBUG);
            return false;
        }

        //画像名生成
        $new_file_name = md5($args['child_id'].time());
	if (mb_strlen ($new_file_name) > 20) {
	    $new_file_name = substr($new_file_name,0,20);
	}

	//画像保存
        $new_wallpaper_path = WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_output_for_smartphone'), $new_file_name);
	$result = ImageJPEG($new_image, $new_wallpaper_path, 100);
	if(!$result){
	    $this->log("[createWallpaper4SmartPhone][ImageJPEG]待受け画像作成失敗。画像の保存。",LOG_DEBUG);
            return false;
	}
        
        /******** サムネイル作成 ********/

        //サムネイル元画像読み込み
        $image = imagecreatefromjpeg($new_wallpaper_path);

        //画像のサイズを取得
        $width = ImageSX($image); //横幅（ピクセル）
        $height = ImageSY($image); //縦幅（ピクセル）

        //サイズ指定
        $new_width = Configure::read('Diary.image_size_thumb_wallpaper_for_smartphone');

        //リサイズの圧縮比
        $rate = $new_width / $width;
        $new_height = $rate * $height;

        //空の画像用意
        $new_thumbnail = ImageCreateTrueColor($new_width, $new_height);
	if($new_thumbnail===FALSE){
	    $this->log("[createWallpaper4SmartPhone][ImageCreateTrueColor]サムネイルの作成に失敗しました。",LOG_DEBUG);
	}

        //リサイズした画像を空の画像にコピー
	if(!ImageCopyResized($new_thumbnail,$image,0,0,0,0,$new_width,$new_height,$width,$height)){
	    $this->log("[createWallpaper4SmartPhone][ImageCopyResized]サムネイルの作成に失敗しました。",LOG_DEBUG);
	}

	//画像保存
	if(!ImageJPEG($new_thumbnail, (WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_output_thumb_for_smartphone'), $new_file_name)), 100)){
	    $this->log("[createWallpaper4SmartPhone][ImageJPEG]サムネイルの作成に失敗しました。",LOG_DEBUG);
	}

        //メモリを開放します
        imagedestroy($new_image);
        imagedestroy($new_thumbnail);
        ImageDestroy($diaries_in_template[0]);
        ImageDestroy($diaries_in_template[1]);
        ImageDestroy($diaries_in_template[2]);
        ImageDestroy($image);
        
        /******** ワンタイムURL登録 ********/

        $postcard_url =& ClassRegistry::init('postcardUrl');
        $options = array(
            'child_id' => $args['child_id'],
            'token' => $new_file_name
            );
        $postcard_url->create();
        if (!$postcard_url->save($options)) {
	    $this->log("ワンタイムURL登録に失敗しました。",LOG_DEBUG);
	    $this->log($options,LOG_DEBUG);
            //データ登録に失敗した場合、ファイルを消す。
            unlink( WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_output_for_smartphone'), $new_file_name) );
            unlink( WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_output_thumb_for_smartphone'), $new_file_name) );
            return false;
        }

        return $new_file_name;

   }

    /*
     * スマートフォン用ポストカード作成
     * @param  string    args['child_id']   : child_id
     * @param  string    args['present_id']   : テンプレートpresent_id
     * @param  string    args['diary_id[0-3]']   : diary_id
     * @return boolean   $result     : 結果
     */
    function createPostCard4SmartPhone($args){
        //引数確認
        if(empty($args)){
            return false;
        }

        /******** ポストカード作成 ********/
        $postcard_width = Configure::read('Present.template.postcard.size_smartphone.width');
        $postcard_height = Configure::read('Present.template.postcard.size_smartphone.height');
        //下地画像生成
	$new_image = ImageCreateTrueColor($postcard_width, $postcard_height);

        //思い出画像読み込み
        $diaries_in_template = array();
        for($i = 0 ; $i < 4 ; $i++){
            $diary_img_path = WWW_ROOT.'img'.DS.sprintf(Configure::read('Diary.image_path_postcard_for_smartphone'), $args['child_id'], $args['diary_id'][$i]);
            $diaryImg = ImageCreateFromJpeg($diary_img_path);
            if($diaryImg === FALSE){
                $this->log('[createPostcard4SmartPhone][ImageCreateFromJpeg]ポストカード作成失敗.'.$diary_img_path,LOG_DEBUG);
                return false;            
            }
            $diaries_in_template[$i] = $diaryImg;
        }

        //テンプレート画像読み込み
        $template = imageCreateFromPng(WWW_ROOT.sprintf(Configure::read('Present.path.postcard_for_smartphone'), $args['present_id']));

	//下地画像へ、思い出画像を合成
        $positions_in_template = Configure::read('Present.incentive.position_in_postcard_smartphone');
        $diary_size = Configure::read('Diary.image_size_postcard_for_smartphone');
        for($i = 0; $i < 4; $i++){
            if(!ImageCopy($new_image, $diaries_in_template[$i], 
                            $positions_in_template[$i]['x'], $positions_in_template[$i]['y'], 
                            0, 0, $diary_size, $diary_size)){
                $this->log('[createPostcard4SmartPhone][ImageCopy]ポストカード作成失敗.テンプレートへの合成に失敗。'.($i+1).'番目の画像。', LOG_DEBUG);
                return false;
            }           
        }

        //下地画像へ、テンプレート画像を合成
        if(!ImageCopy($new_image, $template, 0, 0,  0, 0, $postcard_width, $postcard_height)){
	    $this->log('[createPostcard4SmartPhone][ImageCopy]ポストカード作成失敗.テンプレートの合成に失敗',LOG_DEBUG);
            return false;
        }
=======

    function createSmartPhoneIncentive($args){
        

        /******** ポストカード作成 ********/

        //下地画像生成（はがきサイズ）
	$new_image = ImageCreateTrueColor(566, 840);

        //思い出画像読み込み
	$diaryImgA = ImageCreateFromJpeg(WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_postcard'), $args['child_id'], $args['diary_id'][0]));
	$diaryImgB = ImageCreateFromJpeg(WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_postcard'), $args['child_id'], $args['diary_id'][1]));
	$diaryImgC = ImageCreateFromJpeg(WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_postcard'), $args['child_id'], $args['diary_id'][2]));
        $diaryImgD = ImageCreateFromJpeg(WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_postcard'), $args['child_id'], $args['diary_id'][3]));

        //テンプレート画像読み込み
        $template = imageCreateFromPng(WWW_ROOT.sprintf(Configure::read('Present.path.postcard'), $args['present_id']));

	//下地画像へ、思い出画像を合成
	ImageCopy($new_image, $diaryImgA, 70, 88, 0, 0, 210, 210);
        ImageCopy($new_image, $diaryImgB, 280, 88, 0, 0, 210, 210);
        ImageCopy($new_image, $diaryImgC, 70, 300, 0, 0, 210, 210);
        ImageCopy($new_image, $diaryImgD, 280, 300, 0, 0, 210, 210);

        //下地画像へ、テンプレート画像を合成
        ImageCopy($new_image, $template, 0, 0,  0, 0, 566, 840);
>>>>>>> 97c2288670a84c36d891502a5d48627aed32c453

        //画像名生成
        $new_file_name = md5($args['child_id'].time());
	if (mb_strlen ($new_file_name) > 20) {
	    $new_file_name = substr($new_file_name,0,20);
	}

	//画像保存
<<<<<<< HEAD
	$result = ImageJPEG($new_image, (WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_for_smartphone'), $new_file_name)), 100);
	if($result===FALSE){
	    $this->log("[createPostcard4SmartPhone][ImageJPEG]ポストカード作成失敗.",LOG_DEBUG);
            return false;
=======
	$result = ImageJPEG($new_image, (WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output'), $new_file_name)), 100);
	if(!$result){
	    $this->log("ポストカード作成に失敗しました。",LOG_DEBUG);
	    $this->log($result,LOG_DEBUG);
>>>>>>> 97c2288670a84c36d891502a5d48627aed32c453
	}

        /******** サムネイル作成 ********/

        //サムネイル元画像読み込み
<<<<<<< HEAD
        $image = imagecreatefromjpeg(WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_for_smartphone'), $new_file_name));
	if($result===FALSE){
	    $this->log("[createPostcard4SmartPhone][imagecreatefromjpeg]サムネイル作成失敗.",LOG_DEBUG);
	}
=======
        $image = imagecreatefromjpeg(WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output'), $new_file_name));
>>>>>>> 97c2288670a84c36d891502a5d48627aed32c453

        //画像のサイズを取得
        $width = ImageSX($image); //横幅（ピクセル）
        $height = ImageSY($image); //縦幅（ピクセル）

        //サイズ指定
<<<<<<< HEAD
        $new_width = Configure::read('Diary.image_size_thumb_postcard_for_smartphone');
=======
        $new_width = 150;
>>>>>>> 97c2288670a84c36d891502a5d48627aed32c453

        //リサイズの圧縮比
        $rate = $new_width / $width;
        $new_height = $rate * $height;

        //空の画像用意
        $new_thumbnail = ImageCreateTrueColor($new_width, $new_height);
<<<<<<< HEAD
	if($new_thumbnail===FALSE){
	    $this->log("[createPostcard4SmartPhone][ImageCreateTrueColor]サムネイル作成失敗.",LOG_DEBUG);
	}

        //リサイズした画像を空の画像にコピー
	if(!ImageCopyResized($new_thumbnail,$image,0,0,0,0,$new_width,$new_height,$width,$height)){
	    $this->log("[createPostcard4SmartPhone][ImageCopyResized]サムネイル作成失敗.画像の保存失敗。",LOG_DEBUG);
	}

	//画像保存
	if(!ImageJPEG($new_thumbnail, (WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_thumb_for_smartphone'), $new_file_name)), 100)){
	    $this->log("[createPostcard4SmartPhone][ImageJPEG]サムネイル作成失敗.画像の保存失敗。",LOG_DEBUG);
	}
       
        //メモリを開放します
        imagedestroy($new_image);
        imagedestroy($new_thumbnail);
        ImageDestroy($diaries_in_template[0]);
        ImageDestroy($diaries_in_template[1]);
        ImageDestroy($diaries_in_template[2]);
        ImageDestroy($diaries_in_template[3]);
=======

        //リサイズした画像を空の画像にコピー
        ImageCopyResampled($new_thumbnail,$image,0,0,0,0,$new_width,$new_height,$width,$height);

	//画像保存
	$result2 = ImageJPEG($new_thumbnail, (WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_thum'), $new_file_name)), 100);
	if(!$result2){
	    $this->log("ポストカードサムネイル作成に失敗しました。",LOG_DEBUG);
	    $this->log($result,LOG_DEBUG);
	}

        //メモリを開放します
        imagedestroy($new_image);
        imagedestroy($new_thumbnail);
        ImageDestroy($diaryImgA);
        ImageDestroy($diaryImgB);
        ImageDestroy($diaryImgC);
        ImageDestroy($diaryImgD);
>>>>>>> 97c2288670a84c36d891502a5d48627aed32c453
        ImageDestroy($image);
        
        /******** ワンタイムURL登録 ********/

        $postcard_url =& ClassRegistry::init('postcardUrl');
        $options = array(
            'child_id' => 2,
            'token' => $new_file_name
            );
        $postcard_url->create();
        if (!$postcard_url->save($options)) {
	    $this->log("ワンタイムURL登録に失敗しました。",LOG_DEBUG);
	    $this->log($options,LOG_DEBUG);
            //データ登録に失敗した場合、ファイルを消す。
<<<<<<< HEAD
            unlink( WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_for_smartphone'), $new_file_name) );
            unlink( WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_thumb_for_smartphone'), $new_file_name) );
            return false;
        }

        return $new_file_name;

    }
=======
            unlink( WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output'), $new_file_name) );
            unlink( WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_thum'), $new_file_name) );
            return false;
        }
>>>>>>> 97c2288670a84c36d891502a5d48627aed32c453

        return $new_file_name;

    }
}
?>
