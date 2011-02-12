<?php
$connect = mysql_connect('localhost', 'root', 'styx_hy');
if (!isset($connect)) {
  echo "fail to connect";
} else {
  echo "connect successful";
}

mysql_select_db('pchms', $connect);

//$query = "SELECT * FROM logins WHERE username=('123')";

$query = "SELECT * FROM mouse";

$result = mysql_query($query, $connect);

echo "<table>";
while ($row = mysql_fetch_row($result)) {
  //  echo "<p>", $row[0], $row[1], $row[2], $row[3], $row[4], "</p>";
  printf("<tr><td>%d</td><td>%d</td><td>%d</td><td>%s</td><td>%s</td></tr>", $row[0], $row[1], $row[2], $row[3], strtotime($row[4]) * 1000);
}
echo "</table>";
/* while ($row = mysql_fetch_row($result)) { */
/*   echo($row[0], $row[1], $row[2], $row[3], $row[4]); */
/* } */

mysql_close($connect);

?>