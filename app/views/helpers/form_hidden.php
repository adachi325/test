<?php

class FormhiddenHelper extends AppHelper {
    var $helpers = array('Form');

    function hiddenVars() {
        $ret = "";
        $keyStack = array();
        $this->_hiddenVarsNestParse($this->data, $keyStack, $ret);
        return $ret;
    }

    function _hiddenVarsNestParse($data, &$keyStack, &$ret) {
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                array_push($keyStack, $key);
                $this->_hiddenVarsNestParse($val, $keyStack, $ret);
                array_pop($keyStack);
            }
        } else {
            $ret .= $this->Form->hidden(implode('.' ,$keyStack)) . "\n";
        }
    }
}

?>