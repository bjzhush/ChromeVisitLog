<?php
require ('config.php');

/**
 * ajaxResponse 
 * status 0 for error ,1 for query success
 * @param mixed $status 
 * @param array $info 
 * @access public
 * @return json
 */
function ajaxResponse($status, array $info) 
{
    $arr = array(
            'status' => $status,
            'info'   => array(
                'count' => $info['count'],
                'time'  => $info['time']
                )
            );
    echo json_encode($arr);
    exit;
}

// validate autoKey
if (!isset($_POST['key']) || $_POST['key'] != $authKey) {
    ajaxResponse(0, array('info' => 'error'));
}

if (!isset($_POST['url'])) {
    ajaxResponse(0, array('info' => 'error'));
}
$url = $_POST['url'];

//log to my db
$conn = mysql_connect($mysqlHost, $mysqlUser, $mysqlPwd);
if (!$conn) {
    exit('Cannot connect to mysql '.mysql_errno());
}
mysql_select_db('google');
mysql_query("set names 'utf8'");
$sqlHistory = "select time from chromeurllog where url ='$url'";
$resHistory = mysql_query($sqlHistory);
$res = array();
while ($row = mysql_fetch_assoc($resHistory)) {
    $res[] = $row['time'];
}
$count = count($res);
if ($count > 5) {
    $res = array_slice($res,$count-5,5);
}

ajaxResponse(1, array(
            'count' => $count,
            'time'  => $res,
            ));
