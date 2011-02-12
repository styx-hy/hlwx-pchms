<?php
session_start();     /* initialize session */

/*!
 * Connect to the database for authenticate
 * ========================================
 */
$link = mysql_connect("localhost", "root", "styx_hy");
if (!isset($link))
    die("cannot connect to database");

mysql_select_db("pchms", $link);

$query = "SELECT * FROM logins WHERE username=('$_POST[username]') AND password=MD5('$_POST[passwd]')";

$result = mysql_query($query, $link);

mysql_close($link); // validate user from database

if (mysql_num_rows($result) == 0) {
    echo "this user does not exist";
} else {
    echo "hello, $_POST[username]";
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['passwd'] = md5($_POST['passwd']);
    $_SESSION['login'] = true;
    header("location:/navi.php");
}
?>
