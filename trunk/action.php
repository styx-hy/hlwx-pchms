<?php

$link = mysql_connect("localhost", "root", "styx_hy");
if (!isset($link))
  die("cannot connect to database");

mysql_select_db("user_info", $link);

$query = "SELECT * FROM logins WHERE username=('$_POST[username]') AND pswd=MD5('$_POST[passwd]')";

$result = mysql_query($query, $link);

if (mysql_num_rows($result) == 0) {
  echo "this user does not exist";
} else {
  echo "hello, $_POST[username]";
  $_SESSION['username'] = $_POST['username'];
  $_SESSION['passwd'] = md5($_POST['passwd']);
}
mysql_close($link);
echo $_SESSION['username'];
echo $_SESSION['passwd'];
?>