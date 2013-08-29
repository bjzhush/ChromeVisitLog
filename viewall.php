<?php
include 'config.php';

if (!isset($_GET['s']) || empty($_GET['s'])) {
    exit("Bad request");
}
$url = $_GET['s'];
//log to my db
$conn = mysql_connect($mysqlHost, $mysqlUser, $mysqlPwd);
if (!$conn) {
    exit('Cannot connect to mysql '.mysql_errno());
}
mysql_select_db('google');
mysql_query("set names 'utf8'");

$sqlQuery = "select * from chromeurllog where url = '$url'";
$resQuery = mysql_query($sqlQuery);

$res = array();
while ($row = mysql_fetch_assoc($resQuery)) {
    $res[] = $row['time'];
}
$count = count($res);
echo 'Total ' . $count . ' times visited<br><br>';
foreach($res as $v) {
    echo $v . '<br>';
}

