<?php
class JsonObj {
    var $data;
    function setData($foo) {
        $this->data = $foo;
    }
}

$obj = new JsonObj;
$arr = array(array(array(1, 1), array(2, 2), array(3, 3)));
$obj->setData(array(array(1, 1), array(2, 2), array(3, 3)));
echo json_encode($obj);

?>