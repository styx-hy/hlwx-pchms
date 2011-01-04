<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

</body>
</html>-->

<?php
$arr = array(1, 2, 3, 4, 5, 6, 7);
$json_obj = json_encode($arr);
$filename = "returndata.json";
$fp = fopen($filename, "w");
fwrite($fp, $json_obj);
fclose($fp);
?>