<?php
// config here
$mysqlHost = '127.0.0.1';
$mysqlUser = 'root';
$mysqlPwd  = '494897';


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
  
//log to my db
$conn = mysql_connect($mysqlHost, $mysqlUser, $mysqlPwd);
if (!$conn) {
    exit('Cannot connect to mysql '.mysql_errno());
}
mysql_select_db('google');
mysql_query("set names 'utf8'");
$sql = sprintf("insert into chromeurllog (url, time, ip, querystring, isok) values ('%s' , '%s', '%s', '%s', '%s')", $url, $time, $ip, $queryString, $isok);
mysql_query($sql);
mysql_close($conn);
