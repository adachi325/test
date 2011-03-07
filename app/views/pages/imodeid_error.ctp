<?php $this->pageTitle = _PAGE_TITLE;?>

<?php echo $this->renderElement('header_small'); ?> 

<font color="red">iﾓｰﾄﾞIDの取得ができませんでした｡</font><br><br>

恐れ入りますが､iﾓｰﾄﾞIDの通知設定が「通知しない」になっているため､ﾄﾗｲｱﾙｻｰﾋﾞｽを利用できません｡
ﾄﾗｲｱﾙｻｰﾋﾞｽを利用するには､iﾓｰﾄﾞIDを「通知する」に設定してください｡<br><br>

設定は<a href="<?php echo _URL_DOCOMO_COMMUNITY_IMODEID_SETTING?>">こちら</a>から｡<br><br>

またはiﾓｰﾄﾞからは<br>
「iMenu」→「お客様ｻﾎﾟｰﾄ」→「各種設定(確認・変更・利用)」→「iﾓｰﾄﾞID通知設定」で設定できます｡<br>

<?php echo $this->renderElement('footer_imodeid_error'); ?>
