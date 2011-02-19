<?php
session_start();     /* initialize session */
echo count($_SESSION);
switch ($_GET['action']) {
case "login":
    login();
    break;
case "logout":
    logout();
    break;
}




/*!
 * Login: Connect to the database for authenticate
 * ========================================
 */

function login() {
    $link = mysql_connect("localhost", "root", "styx_hy");
    if (!isset($link))
        die("cannot connect to database");

    mysql_select_db("pchms", $link);

    $query = "SELECT * FROM usertable WHERE username=('$_POST[username]') AND password=('$_POST[passwd]')";

    $result = mysql_query($query, $link);

    if (mysql_num_rows($result) == 0) {
        echo "this user does not exist";
        mysql_close($link);
    } else {
        echo "hello, $_POST[username]";
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['passwd'] = md5($_POST['passwd']);
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['login'] = true;
        mysql_close($link);
        header("location:/navi.php");
    }
}

function logout() {
    session_destroy();
    header("location:/index.php");
}
?>
