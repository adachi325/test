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

    /**
     * スマートフォン用待受け静止画像および画像作成
     * @param  string    args['child_id']   : child_id
     * @param  string    args['present_id']   : テンプレートpresent_id
     * @param  string    args['diary_id[0-2]']   : diary_id
     * @return boolean   $result     : 結果
     */
    function createWallpaper4SmartPhone($args){
        //ﾊﾟﾗﾒｰﾀ設定

        //$Present =& ClassRegistry::init('Present');  
        //$month = $Present->getMonth($args['present_id']);

        $params = array();
        $params['child_id'] =$args['child_id']; 
        $params['diary_num'] =3; 
        $params['diary_ids'] =$args['diary_id']; 
        $params['diary_size']['width'] = Configure::read('Diary.image_size_wallpaper_for_smartphone');
        $params['diary_size']['height'] = Configure::read('Diary.image_size_wallpaper_for_smartphone');
        $params['alt_diary_size']['width'] = Configure::read('Diary.image_size_postcard');
        $params['alt_diary_size']['height'] = Configure::read('Diary.image_size_postcard');
        $params['positions_in_template'] = Configure::read('Present.incentive.position_in_wallpaper_smartphone');
        $params['template_size'] =Configure::read('Present.template.wallpaper.size_smartphone');
        $params['template_file_path'] =WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_for_smartphone'), $args['present_id']);
        $params['diary_path'] =Configure::read('Diary.image_path_wallpaper_for_smartphone');
        $params['alt_diary_path'] =Configure::read('Diary.image_path_postcard');
        $params['output_dir'] =Configure::read('Present.path.wallpaper_output_for_smartphone');
        
        // 待受け画像作成
        $result = $this->_createCompositeImage($params);
        if($result === FALSE){
            return FALSE;
        }

        //thumbnail作成
        $params = array();
        $params['compositeimage_file_path'] =WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_output_for_smartphone'), $result); 
        $params['thumbnail_size']['width'] =Configure::read('Diary.image_size_thumb_wallpaper_width_for_smartphone'); 
        $params['thumbnail_size']['height'] =Configure::read('Diary.image_size_thumb_wallpaper_height_for_smartphone'); 
        $params['thumbnail_file_path'] =WWW_ROOT.sprintf(Configure::read('Present.path.wallpaper_output_thumb_for_smartphone'), $result); 
        if(!$this->_createThumbnailOf($params)){
            //データ登録に失敗した場合、ファイルを消す。
            unlink( $params['compositeimage_file_path'] );
            return FALSE;
        }

        // ワンタイムURL登録
        if(!$this->_registerIncentiveTempUrl($args['child_id'], $result)){
            //データ登録に失敗した場合、ファイルを消す。
            unlink($params['compositeimage_file_path']);
            unlink($params['thumbnail_file_path']);
            return false;
        }
        // returns token
        return $result;
    }

    /*
     * スマートフォン用ポストカード作成
     * @param  string    args['child_id']   : child_id
     * @param  string    args['present_id']   : テンプレートpresent_id
     * @param  string    args['diary_id[0-3]']   : diary_id
     * @return boolean   $result     : 結果
     */
    function createPostCard4SmartPhone($args){

        //$Present =& ClassRegistry::init('Present');  
        //$month = $Present->getMonth($args['present_id']);

        //ﾊﾟﾗﾒｰﾀ設定
        $params = array();
        $params['child_id'] =$args['child_id']; 
        $params['diary_num'] =4; 
        $params['diary_ids'] =$args['diary_id']; 
        $params['diary_size']['width'] = Configure::read('Diary.image_size_postcard_for_smartphone');
        $params['diary_size']['height'] = Configure::read('Diary.image_size_postcard_for_smartphone');
        $params['alt_diary_size']['width'] = Configure::read('Diary.image_size_postcard');
        $params['alt_diary_size']['height'] = Configure::read('Diary.image_size_postcard');
        $params['positions_in_template'] = Configure::read('Present.incentive.position_in_postcard_smartphone');
        $params['template_size'] =Configure::read('Present.template.postcard.size_smartphone');
        $params['template_file_path'] =WWW_ROOT.sprintf(Configure::read('Present.path.postcard_for_smartphone'), $args['present_id']);
        $params['diary_path'] =Configure::read('Diary.image_path_postcard_for_smartphone'); 
        $params['alt_diary_path'] =Configure::read('Diary.image_path_postcard'); 
        $params['output_dir'] =Configure::read('Present.path.postcard_output_for_smartphone');
        // postcard画像作成
        $result = $this->_createCompositeImage($params);
        if($result === FALSE){
            return FALSE;
        }

        //thumbnail_4sp作成
        $params = array();
        $params['compositeimage_file_path'] =WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_for_smartphone'), $result); 
        $params['thumbnail_size']['width'] =Configure::read('Diary.image_size_thumb_postcard_width_for_smartphone'); 
        $params['thumbnail_size']['height'] =Configure::read('Diary.image_size_thumb_postcard_height_for_smartphone'); 
        $params['thumbnail_file_path'] =WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_thumb_for_smartphone'), $result); 
        if(!$this->_createThumbnailOf($params)){
            //データ登録に失敗した場合、ファイルを消す。
            unlink( $params['compositeimage_file_path'] );
            return FALSE;
        }
        //thumbnail_4web作成
        $params = array();
        $params['compositeimage_file_path'] =WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_for_smartphone'), $result); 
        $params['thumbnail_size']['width'] =150; 
        $params['thumbnail_size']['height'] =0; 
        $params['thumbnail_file_path'] =WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output_thum'), $result); 
        if(!$this->_createThumbnailOf($params)){
            //データ登録に失敗した場合、ファイルを消す。
            unlink( $params['compositeimage_file_path'] );
            return FALSE;
        }

        // ワンタイムURL登録
        if(!$this->_registerIncentiveTempUrl($args['child_id'], $result)){
            //データ登録に失敗した場合、ファイルを消す。
            unlink($params['compositeimage_file_path']);
            unlink($params['thumbnail_file_path']);
            return false;
        }
        // returns token
        return $result;
    }

    /*
     * スマートフォン用ポストカード／待受け合成画像作成
     * @return boolean   $result     : 成功＝ファイル名トークン、失敗＝FALSE
     */
    function _createCompositeImage($args){
        $check_args = array(
            'child_id',
            'diary_num',
            'diary_ids',
            'diary_size',
            'positions_in_template',
            'template_size',
            'template_file_path',
            'diary_path',
            'output_dir',
        );
        //引数確認
        foreach($check_args as $chk_arg){
            if(!isset($args[$chk_arg])){
                $this->log('[_createCompositeImage]必須ﾊﾟﾗﾒｰﾀがありません.'.$chk_arg,LOG_DEBUG);
                return false;
            }
        }

        /******** ポストカード／待受け作成 ********/
        //下地画像生成
        $new_image = ImageCreateTrueColor($args['template_size']['width'], $args['template_size']['height']);

        for ($i = 0 ; $i < $args['diary_num'] ; $i++) {
            //思い出画像読み込み
            $diary_img_path = WWW_ROOT.'img'.DS.sprintf($args['diary_path'], $args['child_id'], $args['diary_ids'][$i]);

            //ファイルが作成されていない場合の対策
            if (!file_exists($diary_img_path)) {
                
                $alt_diary_img_path = WWW_ROOT.'img'.DS.sprintf($args['alt_diary_path'], $args['child_id'], $args['diary_ids'][$i]);
                if (!file_exists($alt_diary_img_path)) {
                    ImageDestroy($new_image);
                    return false;
                }

                $image = ImageCreateFromJpeg($alt_diary_img_path);
                $this->__saveImageFile($image, $diary_img_path);
                $this->__resize_image($diary_img_path, $args['diary_size']['width'], false);
                chmod($diary_img_path, 0777);
            }

            $diaryImg = ImageCreateFromJpeg($diary_img_path);
            if($diaryImg === FALSE){
                ImageDestroy($new_image);
                $this->log('[_createCompositeImage][ImageCreateFromJpeg]ポストカード／待受け作成失敗.'.$diary_img_path,LOG_DEBUG);
                return false;            
            }
            //下地画像へ、思い出画像を合成
            if(!ImageCopy($new_image, $diaryImg, 
                $args['positions_in_template'][$i]['x'], $args['positions_in_template'][$i]['y'], 
                0, 0, $args['diary_size']['width'], $args['diary_size']['height'])){
                    ImageDestroy($new_image);
                    $this->log('[_createCompositeImage][ImageCopy]ポストカード／待受け作成失敗.思い出画像の合成に失敗。'.($i+1).'番目の画像。', LOG_DEBUG);
                    return false;
                }           
            ImageDestroy($diaryImg);
        }

        //テンプレート画像読み込み
        $template = imageCreateFromPng($args['template_file_path']);
        //下地画像へ、テンプレート画像を合成
        if(!ImageCopy($new_image, $template, 0, 0,  0, 0, $args['template_size']['width'], $args['template_size']['height'])){
            ImageDestroy($new_image);
            $this->log('[_createCompositeImage][ImageCopy]ポストカード／待受け作成失敗.テンプレートの合成に失敗',LOG_DEBUG);
            return false;
        }

        //画像名生成
        $new_file_name = md5($args['child_id'].time());
        if (mb_strlen ($new_file_name) > 20) {
            $new_file_name = substr($new_file_name,0,20);
        }

        //画像保存
        $result = ImageJPEG($new_image, (WWW_ROOT.sprintf($args['output_dir'], $new_file_name)), 100);
        if($result===FALSE){
            ImageDestroy($new_image);
            $this->log("[_createCompositeImage][ImageJPEG]ポストカード作成失敗.",LOG_DEBUG);
            return false;
        }
        //
        ImageDestroy($new_image);
        ImageDestroy($template);

        return $new_file_name;

    }

    /*
     * スマートフォン用ポストカード作成
     * @param  string    args['child_id']   : child_id
     * @param  string    args['present_id']   : テンプレートpresent_id
     * @param  string    args['diary_id[0-3]']   : diary_id
     * @return boolean   $result     : 成功＝TRUE、失敗＝FALSE
     */
    function _createThumbnailOf($args){
        $check_args = array(
            'compositeimage_file_path',
            'thumbnail_size',      // array('width'=>111,'height'=>111)
            'thumbnail_file_path',
        );
        //引数確認
        foreach($check_args as $chk_arg){
            if(!isset($args[$chk_arg])){
                $this->log('[_createThumbnailOf]必須ﾊﾟﾗﾒｰﾀがありません.'.$chk_arg,LOG_DEBUG);
                return false;
            }
        }

        //サムネイル元画像読み込み
        $image = imagecreatefromjpeg($args['compositeimage_file_path']);
        if($image===FALSE){
            $this->log("[_createThumbnailOf][imagecreatefromjpeg]サムネイル作成失敗.",LOG_DEBUG);
            $this->log($args, LOG_DEBUG);
            return false;
        }

        //画像のサイズを取得
        $width = ImageSX($image); //横幅（ピクセル）
        $height = ImageSY($image); //縦幅（ピクセル）

        //サイズ指定
        $new_width = $args['thumbnail_size']['width'];
        $new_height = $args['thumbnail_size']['height'];

        //リサイズの圧縮比
        if($new_height < 1){
            $new_height = $height * ($new_width / $width);
        }else if($new_width < 1){
            $new_width = $width * ($new_height / $height);
        }

        //空の画像用意
        $new_thumbnail = ImageCreateTrueColor($new_width, $new_height);
        if($new_thumbnail===FALSE){
            $this->log("[_createThumbnailOf][ImageCreateTrueColor]サムネイル作成失敗.",LOG_DEBUG);
            $this->log($args, LOG_DEBUG);
            return false;
        }

        //リサイズした画像を空の画像にコピー
        if(!ImageCopyResized($new_thumbnail,$image,0,0,0,0,$new_width,$new_height,$width,$height)){
            $this->log("[_createThumbnailOf][ImageCopyResized]サムネイル作成失敗.画像の保存失敗。",LOG_DEBUG);
            $this->log($args, LOG_DEBUG);
            return false;
        }

        //画像保存
        if(!ImageJPEG($new_thumbnail, $args['thumbnail_file_path'], 100)){
            $this->log("[_createThumbnailOf][ImageJPEG]サムネイル作成失敗.画像の保存失敗。",LOG_DEBUG);
            $this->log($args, LOG_DEBUG);
            return false;
        }

        //メモリを開放します
        imagedestroy($new_thumbnail);
        ImageDestroy($image);        

        return TRUE;

    }

    /**
     * インセンティブ用ワンタイムURLの登録
     */
    function _registerIncentiveTempUrl($child_id, $file_token){
        /******** ワンタイムURL登録 ********/
        $postcard_url =& ClassRegistry::init('postcardUrl');
        $options = array(
            'child_id' => $child_id,
            'token' => $file_token
        );
        $postcard_url->create();
        if (!$postcard_url->save($options)) {
            $this->log("ワンタイムURL登録に失敗しました。",LOG_DEBUG);
            $this->log($options,LOG_DEBUG);
            return false;
        }
        return TRUE;
    }

}
?>
