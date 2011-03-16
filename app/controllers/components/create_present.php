<?php

class CreatePresentComponent extends Object {

    function createFlash($args){
        //引数確認
        if(empty($args)){
            return false;
        }

        
    }


    function createPostCard($args){
        //引数確認
        if(empty($args)){
            return false;
        }

        //下地画像読み込み
	$new_image = ImageCreateTrueColor(400, 592);

        //思い出画像読み込み
	$diaryImgA = ImageCreateFromJpeg(WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_original'), $args['child_id'], $args['diary_id'][0]));
	$diaryImgB = ImageCreateFromJpeg(WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_original'), $args['child_id'], $args['diary_id'][1]));
	$diaryImgC = ImageCreateFromJpeg(WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_original'), $args['child_id'], $args['diary_id'][2]));
        $diaryImgD = ImageCreateFromJpeg(WWW_ROOT.'img/'.sprintf(Configure::read('Diary.image_path_original'), $args['child_id'], $args['diary_id'][3]));

        //テンプレート画像読み込み
        $template = ImageCreateFromGif(WWW_ROOT.sprintf(Configure::read('Present.path.postcard'), $args['present_id']));

	//下地画像へ、思い出画像を合成
	ImageCopy($new_image, $diaryImgA, 20, 20, 30, 30, 200, 200);
        ImageCopy($new_image, $diaryImgB, 220, 120, 30, 30, 200, 200);
        ImageCopy($new_image, $diaryImgC, 40, 290, 30, 30, 200, 200);
        ImageCopy($new_image, $diaryImgD, 230, 390, 30, 30, 200, 200);

        //下地画像へ、テンプレート画像を合成
        ImageCopy($new_image, $template, 0, 0,  0, 0, 400, 592);

        //画像名生成
        $new_file_name = substr(md5($args['child_id'].time()),0,20);

	//画像保存
	ImageJPEG($new_image, (WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output'), $new_file_name)), 100);

        //メモリを開放します
        imagedestroy($new_image);

        //ワンタイムURL登録
        $postcard_url =& ClassRegistry::init('postcardUrl');
        $options = array(
            'child_id' => 2,
            'token' => $new_file_name
            );
        $postcard_url->create();
        if (!$postcard_url->save($options)) {
            //データ登録に失敗した場合、ファイルを消す。
            unlink( WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output'), $new_file_name) );
            return false;
        }
        return true;

    }

}
?>
