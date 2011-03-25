
<center>
    <div>
        <span>ドコモコミュニティにメールで投稿しよう。</span>
    </div>
    <div>
        <div>ﾃﾞｺﾚｰｼｮﾝﾒｰﾙﾃﾝﾌﾟﾚｰﾄをﾀﾞｳﾝﾛｰﾄﾞ下↓下↓</div>
        <div><?php echo $this->Html->link('ﾀﾞｳﾝﾛｰﾄﾞ', '/diaries/downlord/'.$diary['Diary']['id']); ?></div>
    </div>
    <br>
    <div>
        <div>そしてメールを起動して↑でダウンロードしたテンプレートを挿入してメールするんだ！</div>
        <div>
        <?php
        if($this->Ktai->is_imode() and !$this->tk->is_imode_browser()){ ?>
        <a href="mailto:<?php echo Configure::read('Defaults.docomo_community') ?>?subject=<?php echo urlencode(mb_convert_encoding($diary['Diary']['title'], "utf8"));?>">投稿する</a>
        <?php } else { ?>
        <?php $this->Ktai->mailto("投稿する",Configure::read('Defaults.docomo_community'),$diary['Diary']['title']); ?>
        <?php } ?>
        </div>
    </div>
</center>
<br>
<div>
･<?php echo $this->Html->link('今月の思い出記録ﾍﾟｰｼﾞへ戻る', '/diaries/index/'.$diary['Month']['year'].'/'.$diary['Month']['month']); ?>
</div>