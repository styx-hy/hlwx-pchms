<?php
$connect = mysql_connect('localhost', 'root', 'styx_hy');
if (!isset($connect)) {
  echo "fail to connect";
} else {
  echo "connect successful";
}

mysql_select_db('user_info', $connect);

$query = "SELECT * FROM logins WHERE username=('123')";

$result = mysql_query($query, $connect);

/* if (mysql_num_rows($result) == 0) { */
/*   echo "nothing retrieved"; */
/* } else { */
/*   echo $result; */
/* } */

echo (mysql_num_rows($result));
mysql_close($connect);

?>