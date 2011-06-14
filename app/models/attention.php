<?php
class Attention extends AppModel {
    var $name = 'Attention';

    function getAttentionCount($type, $external_id) {
        $count = $this->find('count', array(
            'conditions' => array('type' => $type, 'external_id' => $external_id), 
        ));
        return $count;
    }

}
?>
