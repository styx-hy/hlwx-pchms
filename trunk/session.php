<?php
session_start();
$_SESSION['views'] = 1;
?>

<html>
<body>
<?php
// retrive session data
echo "Pageviews=".$_SESSION['views'];
session_destroy();
?>

<?php
print_r($_SESSION);
?>
</body>
</html>