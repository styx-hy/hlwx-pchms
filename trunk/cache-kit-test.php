<?php
 
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
 
?>