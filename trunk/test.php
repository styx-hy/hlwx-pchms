<?php
function authenticate_user() {
  header('WWW-Authenticate: Basic Realm="Secret"');
  header("HTTP/1.0 401 Unauthorized");
  exit;
}

if (!isset($_SERVER['PHP_AUTH_USER'])) {
  authenticate_user();
} else {
  $link = mysql_connect('localhost', 'root', 'styx_hy');
  if (!isset($link)) {
    die('Could not connect: '.mysql_error());
  } else {
    echo 'connected';
  }

  mysql_select_db('user_info', $link)
      or die("Can't select database!");

  $query = "SELECT username, pswd FROM logins "
        ."WHERE username=('$_SERVER[PHP_AUTH_USER]') AND "
        ."pswd=MD5('$_SERVER[PHP_AUTH_PW]')";

  $result = mysql_query($query, $link);

  if (mysql_num_rows($result) == 0) {
    authenticate_user();
  } else {
    echo "Welcome to the secret archieve!";
  }
  mysql_close($link);
}





/* $realm = 'Restricted area'; */

/* //user => password */
/* $users = array('admin' => 'mypass', 'guest' => 'guest'); */


/* if (empty($_SERVER['PHP_AUTH_DIGEST'])) { */
/*     header('HTTP/1.1 401 Unauthorized'); */
/*     header('WWW-Authenticate: Digest realm="'.$realm. */
/*            '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"'); */

/*     die('Text to send if user hits Cancel button'); */
/* } */


/* // analyze the PHP_AUTH_DIGEST variable */
/* if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) || */
/*     !isset($users[$data['username']])) */
/*     die('Wrong Credentials!'); */


/* // generate the valid response */
/* $A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]); */
/* $A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']); */
/* $valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2); */

/* if ($data['response'] != $valid_response) */
/*     die('Wrong Credentials!'); */

/* // ok, valid username & password */
/* echo 'Your are logged in as: ' . $data['username']; */


/* // function to parse the http auth header */
/* function http_digest_parse($txt) */
/* { */
/*     // protect against missing data */
/*     $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1); */
/*     $data = array(); */
/*     $keys = implode('|', array_keys($needed_parts)); */

/*     preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER); */

/*     foreach ($matches as $m) { */
/*         $data[$m[1]] = $m[3] ? $m[3] : $m[4]; */
/*         unset($needed_parts[$m[1]]); */
/*     } */

/*     return $needed_parts ? false : $data; */
/* } */
?>
