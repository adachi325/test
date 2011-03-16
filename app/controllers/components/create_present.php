<?php

class CreatePresentComponent extends Object {

    function createPostCard($args){

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

	//画像保存
	ImageJPEG($new_image, (WWW_ROOT.sprintf(Configure::read('Present.path.postcard_output'), $args['present_id'])), 100);

        //メモリを開放します
        imagedestroy($new_image);

        return true;

    }

}
?>
