<?php
class Article extends AppModel {
	var $name = 'Article';

    /**
     * 重複判定
     */
    function isUnique($type, $external_id = null) {
        if ($external_id == null) {
            return true;
        }

        $count = $this->find('count', array(
            'conditions' => array($this->alias.'.type' => $type, $this->alias.'.external_id', $external_id),
        ));

        return ($count == 0);
    }
}
?>
