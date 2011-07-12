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

    /*
     * スマートフォン用待受け静止画像作成
     */
    function createWallpaper4SmartPhone($args){
         //引数確認
        if(empty($args)){
            return false;
        }

        /******** 待受け作成 ********/
        $wallpaper_size = array('x'=>1440, 'y'=>1280);
        
        //下地画像生成
	$new_image = ImageCreateTrueColor($wallpaper_size['x'], $wallpaper_size['y']);

        //思い出画像読み込み
        $diaries_in_template = array();
        for($i = 0 ; $i < 3 ; $i++){
            $diary_img_path = WWW_ROOT.'img'.DS.sprintf(Configure::read('Diary.image_path_rect_wallpaper'), $args['child_id'], $args['diary_id'][$i]);
            $diaryImg = ImageCreateFromJpeg($diary_img_path);
            if($diaryImg === FALSE){
                $this->log('Create DiaryImage failed.'.$diary_img_path,LOG_DEBUG);
                return false;            
            }
            $diaries_in_template[$i] = $diaryImg;
        }

        //テンプレート画像読み込み
        $template = imageCreateFromPng(WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper'), $args['present_id']));
	if($template === FALSE){
	    $this->log('テンプレート画像読み込み failed.'.WWW_ROOT.'img/'.sprintf(Configure::read('Present.path.wallpaper'), $args['present_id']),LOG_DEBUG);
            return false;            
        }

	//下地画像へ、思い出画像を合成
        //各思い出の位置
        $positions_in_template = array(
                                    array('x'=>36, 'y'=>516),     // 左
                                    array('x'=>504, 'y'=>299),     //中央
                                    array('x'=>972, 'y'=>516),     //右
                            );
        $diary_size = Configure::read('Diary.image_size_rect_wallpaper');
        for($i = 0; $i < 3; $i++){
            if(!ImageCopy($new_image, $diaries_in_template[$i], 
                            $positions_in_template[$i]['x'], $positions_in_template[$i]['y'], 
                            0, 0, $diary_size, $diary_size)){
                $this->log('テンプレートへの合成に失敗。'.($i+1).'番目の画像。', LOG_DEBUG);
                return false;
            }           
        }

        //下地画像へ、テンプレート画像を合成
        if(!ImageCopy($new_image, $template, 0, 0,  0, 0, $wallpaper_size['x'], $wallpaper_size['y'])){
	    $this->log('テンプレートの合成に失敗',LOG_DEBUG);
            return false;
        }

        //画像名生成
        $new_file_name = '00000000111111';
        //$new_file_name = md5($args['child_id'].time());
	if (mb_strlen ($new_file_name) > 20) {
	    $new_file_name = substr($new_file_name,0,20);
	}

	//画像保存
	$result = ImageJPEG($new_image, (WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_output'), $new_file_name)), 100);
	if(!$result){
	    $this->log("スマホ用待受け作成に失敗しました。",LOG_DEBUG);
	    $this->log($result,LOG_DEBUG);
	}
        
        ///とりあえずここまで。2011-07-12
        //メモリを開放します
        imagedestroy($new_image);
        imagedestroy($template);
        ImageDestroy($diaries_in_template[0]);
        ImageDestroy($diaries_in_template[1]);
        ImageDestroy($diaries_in_template[2]);
        return $new_file_name;

        /******** サムネイル作成 ********/

        //サムネイル元画像読み込み
        $image = imagecreatefromjpeg(WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_output'), $new_file_name));

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
	$result2 = ImageJPEG($new_thumbnail, (WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_output_thumb'), $new_file_name)), 100);
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
            unlink( WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_output'), $new_file_name) );
            unlink( WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_output_thumb'), $new_file_name) );
            return false;
        }

        return $new_file_name;

   }
}
?>
