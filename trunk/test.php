<?php
/* $t = time() * 1000; */
/* $arr[$t] = 10; */
/* echo $t; */
/* echo $arr[$t]; */
/* print_r($arr); */

$con = mysql_connect('localhost', 'root', 'styx_hy');
mysql_select_db('pchms', $con);
$result = mysql_query("SELECT op_code, timestamp FROM mouse LIMIT 10", $con);

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $arr[] = $row;
}
mysql_close($con);

$file = "cache.txt";
$output = serialize($arr);
$fp = fopen($file, "w");
fputs($fp, $output);
fclose($fp)
?>
