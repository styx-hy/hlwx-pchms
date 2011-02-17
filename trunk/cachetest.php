<?php
require("cache.php");

$obj = new cache;
$obj->__construct("/cache");
$obj->cache_page("cache.txt", "asdabsdfsa");
echo $obj->display_cache("cache.txt");
$obj->__destroy();
?>