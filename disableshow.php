<?php
/**
 *  本脚本接收url和type两个参数，type为url/domain之一，接收后，将不在展示历史记录的
 *  url/domain 添加到对应的 excludeurl/excludedomain表里 
 */

include 'config.php';

if (!isset($_GET['url']) || empty($_GET['url'])) {
    exit("Bad request");
}
if (!isset($_GET['type'] )) {
    exit("empty type");
}
if (!in_array($_GET['type'], array('url', 'domain'))) {
    exit("Bad type");
}


$url  = $_GET['url'];
$type = $_GET['type'];

//log to my db
$conn = mysql_connect($mysqlHost, $mysqlUser, $mysqlPwd);
if (!$conn) {
    exit('Cannot connect to mysql '.mysql_errno());
}
mysql_select_db('google');
mysql_query("set names 'utf8'");

if ($type = 'url') {
    $sql = "insert into excludeurl (`url`) values ('$url')";
} else {
    $res = parse_url($url);
    if (!isset($res['host'])) {
        $info =  'null domain got from parse url '.$url;
        echo $info;
        $sql = "insert into errorlog (`info`) values ('$info')";
    } else {
        $domain = $res['host'];
        $sql = "insert into  excludedomain (`domain`) values '$domain'";
    }
}
mysql_query($sql);
echo '<br>Done';

