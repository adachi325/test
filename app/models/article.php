<?php
class Article extends AppModel {
	var $name = 'Article';

    /**
     * 重複判定
     */
    function getArticle($type, $external_id = null) {
        if ($external_id == null) {
            return -1;
        }

        $article = $this->find('first', array(
            'conditions' => array($this->alias.'.type' => $type, $this->alias.'.external_id' => $external_id),
        ));

        return $article;
    }
}
?>
