<?php
  //$arr = $_POST; //若以$.get()方式发送数据，则要改成$_GET.或者干脆:$_REQUEST
  $arr = $_REQUEST;
  $arr['append'] = '测试字符串';
  //print_r($arr);
  $myjson = my_json_encode($arr);
  echo $myjson;

  function my_json_encode($phparr)
  {
    if(function_exists("json_encode"))
    {
      return json_encode($phparr);
    }
    else
    {
      require_once 'json/json.class.php';
      $json = new Services_JSON;
      return $json->encode($phparr);
    }
  }
?>