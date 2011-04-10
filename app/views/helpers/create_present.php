<?php
//require_once APP.'controllers/components/create_present.php';


class CreatePresentHelper extends Helper {

//    function __call($methodName, $args)
//    {
//        pr(APP.'controllers'.DS.'components'.DS.'create_present.php');
//        $create_present = new CreatePresentComponent();
//        return call_user_func_array(array($create_present, $methodName), $args);
//    }

    function createFlash($args){
        //引数確認
        if(empty($args)){
            return false;
        }
        // テンプレートの指定
        $template = WWW_ROOT.sprintf(Configure::read('Present.path.screen'), $args['present_id']);

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

        //ヘッダー出力
        header("Content-type: application/x-shockwave-flash");
        header("Expires: Sat, 01 Jan 2000 01:01:01 GMT");

        // Flash生成
        $almeida->generateFlash();
    }
}
?>
