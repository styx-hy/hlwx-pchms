<?php
include_once('cache-kit.php');
?>
<html>
<head>
<title>Introduction to the DOM</title>
</head>
<body>
<?php
$cache_active = true;
$cache_folder = 'cache/';

function helloworld() {
    $result = acmeCache::fetch('helloWorld', 10); // 10 seconds
    if(!$result) {
        $result = "Hello world Build time: ".date("F j, Y, g:i a");
        acmeCache::save('helloWorld', $result);
    } else {
        echo "Cached result\n";
    }
    return $result;
}

echo(helloworld());
?>
</body>
</html>
