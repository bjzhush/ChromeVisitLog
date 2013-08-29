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

$conn = mysql_connect($mysqlHost, $mysqlUser, $mysqlPwd);
if (!$conn) {
    exit('Cannot connect to mysql '.mysql_errno());
}
mysql_select_db('google');
mysql_query("set names 'utf8'");

//exclude url
$sqlExclude = "select count(*) as num from excludeurl where url = '$url'";
$resExclude = mysql_query($sqlExclude);
while ($row = mysql_fetch_assoc($resHistory)) {
    if ($row['num'] > 0) {
        ajaxResponse(0, array('info' => 'error'));
    }
}

//exclude domain
$res = parse_url($url);
if (!isset($res['host'])) {
        ajaxResponse(0, array('info' => 'bad request ! url is '.$url));
}
$domain = $res['host'];
$sqlExclude = "select count(*) as num from excludedomain where domain = '$domain'";
$resExclude = mysql_query($sqlExclude);
while ($row = mysql_fetch_assoc($resHistory)) {
    if ($row['num'] > 0) {
        ajaxResponse(2, array('info' => 'exclude url'));
    }
}

$timeFile = date("Y-m-d H:i:s", time()-300);
$sqlHistory = "select time from chromeurllog where url ='$url' and time < '$timeFile'";
$resHistory = mysql_query($sqlHistory);
$res = array();
while ($row = mysql_fetch_assoc($resHistory)) {
    $res[] = $row['time'];
}
$count = count($res);
$showRes = array(
        'first' => $res[0],
        'last'  => array_pop($res)
        );

ajaxResponse(1, array(
            'count' => $count,
            'time'  => $showRes,
            ));
