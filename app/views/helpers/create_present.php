<?php
require_once APP.'controllers'.DS.'components'.DS.'create_present.php';


class CreatePresentHelper extends Helper {

    function __call($methodName, $args)
    {
        pr(APP.'controllers'.DS.'components'.DS.'create_present.php');
        $create_present = new CreatePresentComponent();
        return call_user_func_array(array($create_present, $methodName), $args);
    }

}
?>
