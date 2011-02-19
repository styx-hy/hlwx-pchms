<?php
session_start();
/**
 * prepare json object
 * ===================
 */
class JsonObj {
    var $data;
    function setData($foo) {
        $this->data = $foo;
    }
}

$obj = new JsonObj;

/**
 * connect to database and fetch data
 * ==================================
 */

$con = mysql_connect('localhost', 'root', 'styx_hy');
if (!isset($con)) {
    echo "cannot connect to db";
}

mysql_select_db('pchms', $con);


/*!
 * Query data from database
 * ========================
 */
$query = "SELECT * FROM (SELECT span*600000 as stamp, times FROM (SELECT CEIL(UNIX_TIMESTAMP(dtstamp)/600.0) span, COUNT(dtstamp) times FROM keytable WHERE userid=('$_SESSION[userid]') GROUP BY span) x ) y WHERE stamp<=UNIX_TIMESTAMP(date_add(curdate(), interval -1 day))*1000 and stamp >= UNIX_TIMESTAMP(date_add(curdate(),interval -20 day))*1000;";
$result = mysql_query($query, $con);

while ($tmp = mysql_fetch_array($result, MYSQL_NUM)) {
    $final[] = $tmp;
}


/**
 * Data Completion for JSON object
 * ===============================
 */
$obj->setData($final);
echo json_encode($obj);
mysql_close($con);

?>