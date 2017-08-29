<?php
include('/home/sys/web/lib/cache_header_helper.php');
$cacheHeader = new CacheHeaderHelper();
$cacheHeader->publicCache(86400*365*10,1);

$folder = "/home/sys/web/static/";
$files = array_map(function($v){
    $v = explode('=', $v);
    return urldecode($v[0]);
}, explode('&',$_SERVER['QUERY_STRING']));

$is_exists = array();
foreach($files as $f){
    $path = $folder.$f;
    if(is_file($path)){ 
        $is_exists[]=$path;
    }
}


$tmp = tempnam("/tmp", "merge");
$file_name = join(' ',$is_exists);
putenv("PATH=/home/sys/bin");
$run = shell_exec("/home/sys/bin/yuglify $file_name -c $tmp");
$min_file = $tmp.".min.js";
header("Content-type: application/javascript");
echo file_get_contents($min_file);
unlink($min_file);
unlink($tmp);
