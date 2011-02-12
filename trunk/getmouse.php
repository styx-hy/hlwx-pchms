<?php

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
$query = "SELECT span*900000, times FROM (SELECT CEIL(UNIX_TIMESTAMP(timestamp)/900.0) span, COUNT(timestamp) times FROM mouse GROUP BY span) x";
$result = mysql_query($query, $con);
 
while ($tmp = mysql_fetch_array($result, MYSQL_NUM)) {
    $final[] = $tmp;
}


/**
 * merge data to fit into certain time span
 */

/* $tmp  = mysql_fetch_row($result); /\* fetch first record *\/ */
/* $time[strtotime($tmp[1])] = 1; */
/* $last = strtotime($tmp[1]) * 1000; */
/* $i = 1; */
/* $final = array(); /\* array for generate json object *\/ */

/* while ($row = mysql_fetch_row($result)) { */
/*     $timestamp = strtotime($row[1]) * 1000; */
/*     if ($timestamp <= $last + 500000) { */
/*         $time[$last/1000]++; */
/*     } else { */
/*         array_push($final, array($last, $time[$last/1000])); */
/*         $i++; */
/*         $time[$timestamp/1000] = 0; */
/*         $time[$timestamp/1000]++; */
/*         $last = $timestamp; */
/*     } */
/* } */
//echo count($time);
//print_r($time);

/* $file = "cache.txt"; */
/* $fp = fopen($file, "w"); */
/* fwrite($fp, serialize($final)); */
/* fclose($fp); */

/**
 * Data Completion for JSON object
 * ===============================
 */
$obj->setData($final);
echo json_encode($obj);
mysql_close($con);
?>