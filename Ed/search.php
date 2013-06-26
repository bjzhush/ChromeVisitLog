<?php
include 'search_config.php';
$urlBase = "https://www.google.com.hk/search?q=%s&qscrl=1";
$key = urlencode(str_replace(' ',' ',$_GET['key']));
$urlToLocation = sprintf($urlBase,$key);

//log to my db
$conn = mysql_connect($mysqlHost, $mysqlUser, $mysqlPwd);
if (!$conn) {
    exit('Cannot connect to mysql '.mysql_errno());
}
mysql_select_db('google');
mysql_query("set names 'utf8'");
$sql = sprintf("insert into searchlog (keyword, machineid) values ('%s','%s')", $_GET['key'], $machineid);
mysql_query($sql);
mysql_close($conn);


//Location to google
header("location:$urlToLocation");
