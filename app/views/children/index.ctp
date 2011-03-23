<h2>子どものページ</h2>
<?php if(count($childrenData) > 0) { ?>
<div id="tab">
<?php
// 配列の値を改行しながらすべて出力
$i = 0;
$tabColId=0;
foreach ($childrenData as $child) {
    extract($child['Child']);
    echo '<span>';
    if($child['Child']['id'] == $currentChild['Child']['id']){
        echo $html->image(sprintf(Configure::read('Child.icon_on_path'), $i));
        $tabColId = $i;
    }else{
        echo $html->link($html->image(sprintf(Configure::read('Child.icon_off_path'), $i)), "/children/index/".$i, array('escape' => false));
    }
    echo '</span> ';
    $i++;
}
if (count($childrenData) < 3) {
    echo '<span>';
    echo $html->link('+', "/children/register/");
    echo '</span> ';
}?>
</div>
<?php echo '<table style="background-color:'.sprintf(Configure::read('Child.child_tab_color.'.$tabColId)).'">' ?>
    <tr>
        <td>
            <?php
            $i=0;
            foreach($diaries as $diary):
                if ($diary['Diary']['has_image'] && $i < 1) {
                    $i++;
                    echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('width' => '55px', 'height' => '55px')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
                }
            endforeach;

            if ($i == 0) {
                echo $html->image('common'.'/dummy_2.jpg' ,array('width' => '55px', 'height' => '55px'));
            }

            ?>
        </td>
        <td>
            <div>
            <?php
                echo $html->image('common'.'/sex'.$currentChild['Child']['sex'].'.jpg' ,array('width' => '20px', 'height' => '20px'));
                echo $currentChild['Child']['nickname'];
            ?>
            </div>
            <?php
            //歳計算
            $yy = $currentChild['Child']['birth_year'];
            $mm = $currentChild['Child']['birth_month'];
            $yyy = date('Y')-$yy;
            $mmm = date('m')-$mm;
            if($mmm < 0) {
                $mmm = $mmm + 12;
                $yyy = $yyy -1;
            }
            ?>
            <div>･<?php echo $yyy.'才'.$mmm.'ヶ月'; ?>
            </div>
            <div>･ｺｰｽ:<?php echo Configure::read('LinesString.strings.'.$currentChild['Child']['line_id']); ?></div>
            <div><?php echo $this->Html->link('･獲得ﾌﾟﾚｾﾞﾝﾄ一覧', '/presents/'); ?></div>
        </td>
    </tr>
<?php echo '</table>' ?>
<br>
<div>
    <div>
        <h3>サイトのお知らせ</h3>
    </div>
    <div>
    <?php if($this->Session->read('Auth.User.created') > date("Y-m-d H:i:s", strtotime("-7 day"))) { ?>
        <?php echo $this->Html->link('会員限定プレゼント', '/presents/user_only'); ?>
    <?php } ?>
    <?php foreach($newslist as $news): ?>
        <?php
            echo "<p>";
            echo $this->Html->link($news['news']['title'], '/news/info/'.$news['news']['id']);
            echo "</p>";
        ?>
    <?php endforeach; ?>
    </div>
</div>
<br>

<h3>思い出記録</h3>
<div>
<center>
<div>
<?php
$i=0;
foreach($diaries as $diary):
    if ($diary['Diary']['has_image'] && $i < 4) {
        if($i == 2) {
            echo '<br>';
        }
        $i++;
        echo $html->link($html->image(sprintf(Configure::read('Diary.image_path_rect'), $diary['Diary']['child_id'], $diary['Diary']['id']) ,array('width' => '55px', 'height' => '55px')), '/diaries/info/'.$diary['Diary']['id'], array('escape' => false));
    }
endforeach;
?>
<?php
while($i < 4) {
    if($i == 2) {
        echo '<br>';
    }
    echo $html->image('common'.'/nophoto'.($i+1).'.jpg' ,array('width' => '55px', 'height' => '55px'));
    $i++;
}
?>
</div>
</center>
<br>
<?php echo $html->link('思い出記録をもっと見る', '/diaries/' ,array('escape' => false)); ?>
</div>
<br>
<h3>思い出を形に残す</h3>
<div>
    <?php echo $this->Html->link('世界に1つの待受画面を作る', '/presents/present_list/2'); ?><br>
    <?php echo $this->Html->link('お部屋に飾れる!ﾎﾟｽﾄｶｰﾄﾞを作る', '/presents/present_list/3'); ?>
</div>
<br>
<h3>思い出を書く</h3>
<?php foreach($months as $month): ?>
    <?php foreach($month['Theme'] as $theme): ?>
    <?php
        if(!$theme['free_theme']){
            echo "<p>【ﾃｰﾏ】";
            echo $this->Html->link($theme['title'], '/themes/info/'.$theme['id']);
            echo "</p>";
        }
    ?>
    <?php endforeach; ?>
    <?php foreach($month['Theme'] as $theme): ?>
    <?php
        if($theme['free_theme']){
            echo "<p>【自由】";
            echo $this->Html->link($theme['title'], '/themes/info/'.$theme['id']);
            echo "</p>";
        }
    ?>
    <?php endforeach; ?>
<?php endforeach; ?>
<br>
<div>
<?php echo $this->Html->link('もっと見る', '/themes/'); ?>
</div>
<br>
<h3>今月のプレゼント</h3>
<div>
    <table>
        <tr>
            <td>
            <?php foreach($months as $month): ?>
                <?php
                $f = true;
                if($month['month']['year'] == date('Y') and ($month['month']['month'] == (date('m')+0))) { ?>
                    <?php foreach($month['Present'] as $present): ?>
                        <?php
                            if($present['present_type'] == 3 and $f) {
                                echo $html->image('/'.sprintf(Configure::read('Present.path.postcard_thum'), $present['id']) ,array('width' => '55px', 'height' => '80px'));
                                $f = false;
                            }
                        ?>
                    <?php endforeach; ?>
                <?php } ?>
            <?php endforeach; ?>
            </td>
            <td>
                思い出を残すと待受けやポストカードテンプレート等がもらえるよ!!
            </td>
        </tr>
     </table>
</div>
<br>
<div>
<?php echo $this->Html->link('詳しくはこちら', '/presents/'); ?>
</div>
<br>
<h3>こどもちゃれんじ</h3>
<div>
<ul>
<?php foreach($issues as $issue): ?>
<li>
<?php
	echo h($issue['Issue']['title']);
	if(is_array($issue['Content'])) {
		foreach($issue['Content'] as $content) {
			if ($content['release_date'] < date('Y-m-d')) {
				echo "<p>";
				echo $this->Html->link($content['title'], DS.$content['path'].DS);
				echo "</p>";
			}
		}
	}
?>
</li>
<?php endforeach; ?>
</ul>
<?php echo $this->Html->link('もっと見る', 'http://shimajiromobile.benesse.ne.jp/ap1/'); ?>
</div>
<br><hr><br>
<div><span><?php echo $this->Session->read('Auth.User.loginid');  ?>さんの設定</span></div>
<div>
    <?php echo $html->link(__('子供情報を追加/変更/削除する', true), array('action' => 'edit_menu')); ?>
</div>
<div>
    <?php echo $html->link(__('ユーザー情報を設定する', true), array('action' => 'user_menu')); ?>
</div>
<?php }  else { ?>
<div>子供情報を登録してください。</div>
<br><hr><br>
<div><span><?php echo $this->Session->read('Auth.User.loginid'); ?>さんの設定</span></div>
<div>
    <?php echo $html->link(__('子供情報を追加/変更/削除する', true), array('action' => 'edit_menu')); ?>
</div>
<div>
    <?php echo $html->link(__('ユーザー情報を設定する', true), array('action' => 'user_menu')); ?>
</div>
<?php } ?>
