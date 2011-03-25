
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
            <textarea rows="1"><?php echo Configure::read('Defaults.docomo_community') ?></textarea>
        </div>
    </div>
</center>
<br>
<div>
･<?php echo $this->Html->link('今月の思い出記録ﾍﾟｰｼﾞへ戻る', '/diaries/index/'.$diary['Month']['year'].'/'.$diary['Month']['month']); ?>
</div>