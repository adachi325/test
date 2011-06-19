<?php
class linesController extends AppController {

    var $name = 'Lines';

    // 使用するモデルを指定
    var $uses = array('Line', 'Diary', 'Child', 'Article', 'Hanamaru');
    var $helpers = array('Wikiformat.Wikiformat', 'DiaryCommon');
    
    var $components = array('Toppage');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('top');
    }
   
    function top($index = null, $line_name = null) {
        // 非会員の場合のチェック

        $this->set('line_name', $line_name);

        $user = $this->Auth->user();
        $this->set(compact($user));

        if($user) {
            $this->Toppage->getChilddata($index);
            $this->Toppage->getLinedata($line_name);
            $this->Toppage->getProfiledata();
        } else {
            $line = array();
            if ($line_name) {
                $line = $this->Line->find('first', array('Line.category_name' => $line_name));
            }

            if (!empty($line)) {
                $name = $line['Line']['category_name'];
                $this->redirect(Router::url("/ap/{$name}/", true));
            } else {
                $this->render('top_guest');
            }
        }
    }

}
?>
