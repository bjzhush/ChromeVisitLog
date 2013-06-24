<?php

## config here
$machineid = '74:27:ea:2e:a1:1a'.'linux';
$mysqlHost = 'localhost';
$mysqlUser = 'root';
$mysqlPwd  = '123456';



$urlBase = "https://www.google.com.hk/search?q=%s";
$key = urlencode(str_replace(' ',' ',$_GET['key']));
$urlToLocation = sprintf($urlBase,$key);

//log to my db
$con = mysql_connect($mysqlHost, $mysqlUser, $mysqlPwd);
if (!$con) {
    exit('Cannot connect to mysql '.mysql_errno());
}
mysql_select_db('google');
mysql_query("set names 'utf8'");
$sql = sprintf("insert into searchlog (keyword, machineid) values ('%s','%s')", $_GET['key'], $machineid);
mysql_query($sql);
mysql_close($conn);


//Location to google
header("location:$urlToLocation");
