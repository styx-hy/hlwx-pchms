<?php
// PHP-Cache-Kit is an example of how to add modular caching to your PHP projects
// It is free for all use, but please do not re-distribute without this header.
// Most recent version available from http://acme-web-design.info/php-cache-kit.html
// Send suggestions to info@acme-web-design.info 


/*  
// uses two global configuration variables: cache_active, cache_folder 
  
// To use: set cache_active = true, assign cache_folder 
// Next, call acmeCache::fetch instead of generating a page or module.
// Only if it returns false, build the section then call acmeCache::save.
  
// You only need these two functions and you do not need to 
// create an object -- the class wrapping is just to avoid namespace
// conflicts with your existing code. 

// Usage example:
 
// Do this stuff in your config file
include_once('cache-kit.php');
$cache_active = true; 
$cache_folder = 'cache/';  
 
// Now you can convert any time-consuming but rarely-changing data module into 
// a fast cached module. This example rebuilds the calendar only every 5 minutes. 
function helloWorld(){
$result = acmeCache::fetch('helloWorld', 10); // 10 seconds
if(!$result){
$result = '<h2> Hello world</h2> <p>Build time: '.date("F j, Y, g:i a").'</p>';
acmeCache::save('helloWorld', $result);
} else echo('Cached result<br/>'); 
return $result;
}

// now use the content module function just like you normally would -- caching is automatic!
echo(helloWorld());

*/


class acmeCache{ 

    // public functionality, acmeCache::fetch() and acmeCache::save()
    // =========================

    function fetch($name, $refreshSeconds = 0){
        if(!$GLOBALS['cache_active']) return false; 
        if(!$refreshSeconds) $refreshSeconds = 60; 
        $cacheFile = acmeCache::cachePath($name); 
        if(file_exists($cacheFile) and
           ((time()-filemtime($cacheFile))< $refreshSeconds)) 
            $cacheContent = file_get_contents($cacheFile);
        return $cacheContent;
    } 
 
    function save($name, $cacheContent){
        if(!$GLOBALS['cache_active']) return; 
        $cacheFile = acmeCache::cachePath($name);
        acmeCache::savetofile($cacheFile, $cacheContent);
    } 

    // for internal use 
    // ====================
    function cachePath($name){
        $cacheFolder = $GLOBALS['cache_folder'];
        if(!$cacheFolder) $cacheFolder = trim($_SERVER['DOCUMENT_ROOT'],'/').'/cache/';
        return $cacheFolder . md5(strtolower(trim($name))) . '.cache';
    }
 
    function savetofile($filename, $data){
        $dir = trim(dirname($filename),'/').'/'; 
        acmeCache::forceDirectory($dir);  
        $file = fopen($filename, 'w');
        fwrite($file, $data); fclose($file);
    } 
  
    function forceDirectory($dir){ // force directory structure 
        return is_dir($dir) or (acmeCache::forceDirectory(dirname($dir)) and mkdir($dir, 0777));
    }

}
?>