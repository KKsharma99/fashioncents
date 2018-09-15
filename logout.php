<?php
session_start();
session_destroy();
define('INCLUDE_CHECK',true);
include 'connect.php';
$cookies = array();
$cookies = json_decode($_COOKIE['fashioncents'], true);
$cookies['lastvisit'] = time();
$cookies['id'] = 0;
$cookies['rememberme'] = 0;
$cookies['visitnum']++;
setcookie($cookie_name, json_encode($cookie_value), time()+60*60*24*30);
$sql = "INSERT INTO tbl_visit (uniqueidentifier, userid, ip, language, useragent, fctime) VALUES ('" . $cookies['identifier'] . "', " . $cookies['id'] . ", '" . $_SERVER['REMOTE_ADDR'] . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_ACCEPT_LANGUAGE']) . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_USER_AGENT']) . "', " . time() . ")";
mysqli_query($GLOBALS['sqllink'], $sql);
$visitsql = "SELECT MAX(visitid) FROM tbl_visit";
$row = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'], $visitsql));
$_SESSION['visitid'] = $row['MAX(visitid)'];
header("Location: index.php");

?>