<?php

session_start();

require '../config/database.php';
require '../helper/ConnectionHelper.php';
require '../helper/FilterBeanHelper.php';
require '../helper/SqlHelper.php';
require '../dao/DaoTableInterface.php';
require '../dao/DaoViewInterface.php';
require '../dao/UserDao.php';
require '../service/ServiceTableInterface.php';
require '../service/ServiceViewInterface.php';
require '../service/UserService.php';
require '../helper/MappingHelper.php';

function jsonHeader($code = 200) {
    header('Content-Type: application/json; charset=utf-8', true, $code);
    header("HTTP/1.1 $code");
    header("Expires: on, 01 Jan 1970 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    if (isset($_SERVER['HTTP_ORIGIN'])) { //no valdría el *
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400'); // 24h cache
    }
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        exit(0);
    }
}

jsonHeader();

$json = json_decode($_POST['json'], true);
$ob = $_POST['ob'];
$op = $_POST['op'];

$mapping = new MappingHelper();

$response = $mapping->mapping($ob, $op, $json);

echo json_encode(array("status" => $response['status'], "json" => $response['json']));
    

