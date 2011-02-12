<html>
  <head>
    <title>Redirecting</title>
    <?php
       $url = "/index.php";
       echo "you have not loggin yet, will return to login page in 3s";
       echo "<script type=\"text/javascript\">window.setTimeout(function() {location.href=\"/index.php\";}, 3000);</script>";
       ?>
  </head>
  <body>
  </body>
</html>
