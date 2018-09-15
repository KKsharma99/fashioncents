
<?php

if(!defined('INCLUDE_CHECK')) {
	header("Location: 404.php");
	exit();
}



include('connect.php');
//include logstuff

//cookies must be defined before session

if (!isset($_COOKIE['fashioncents'])) {
	$cookie_name = 'fashioncents';
	$cookie_value = array();
	$cookie_value['lastvisit'] = time();
	$cookie_value['id'] = 0;
	$cookie_value['rememberme'] = 0;
	$cookie_value['identifier'] = uniqid();
	$cookie_value['visitnum'] = 0;
	setcookie($cookie_name, json_encode($cookie_value), time()+60*60*24*30);
	//setcookie($cookie_name, json_encode($cookie_value), time()+60*60*24*30, '/', 'fashioncents.me', TRUE, TRUE);

	$justset = true;
}
//define something in session for if returning or not
session_start();

//newsession
if (!isset($_SESSION['id'])) {
	if (!empty($justset)) {
		//new cookie new session
		$sql = "INSERT INTO tbl_visit (uniqueidentifier, userid, ip, language, useragent, fctime) VALUES ('" . $cookie_value['identifier'] . "', " . $cookie_value['id'] . ", '" . $_SERVER['REMOTE_ADDR'] . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_ACCEPT_LANGUAGE']) . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_USER_AGENT']) . "', " . time() . ")";
		//insert into tbl_visit
		mysqli_query($GLOBALS['sqllink'], $sql);
		$_SESSION['id'] = 0;
	} else {
		if (isset($_COOKIE['fashioncents'])) {
			//cookies enabled new session
			$cookies = array();
			$cookies = json_decode($_COOKIE['fashioncents'], true);
			if (!empty($cookies['rememberme'])) {
				$usernamesql = "SELECT username FROM tbl_masterusers WHERE userid = " . $cookies['id'];
				$result = mysqli_query($GLOBALS['sqllink'], $usernamesql);
				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$_SESSION['username'] = $row['username'];
					$_SESSION['id'] = $cookies['id'];
					$sql = "INSERT INTO tbl_visit (uniqueidentifier, userid, ip, language, useragent, fctime) VALUES ('" . $cookies['identifier'] . "', " . $cookies['id'] . ", '" . $_SERVER['REMOTE_ADDR'] . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_ACCEPT_LANGUAGE']) . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_USER_AGENT']) . "', " . time() . ")";
					mysqli_query($GLOBALS['sqllink'], $sql);
				} else {
					//come back to
					$sql = "INSERT INTO tbl_visit (uniqueidentifier, userid, ip, language, useragent, fctime) VALUES ('" . $cookies['identifier'] . "', 0, '" . $_SERVER['REMOTE_ADDR'] . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_ACCEPT_LANGUAGE']) . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_USER_AGENT']) . "'" . time() . ")";
					mysqli_query($GLOBALS['sqllink'], $sql);
					$_SESSION['id'] = 0;
				}
			} else {
				$sql = "INSERT INTO tbl_visit (uniqueidentifier, userid, ip, language, useragent, fctime) VALUES ('" . $cookies['identifier'] . "', 0, '" . $_SERVER['REMOTE_ADDR'] . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_ACCEPT_LANGUAGE']) . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_USER_AGENT']) . "'" . time() . ")";
				mysqli_query($GLOBALS['sqllink'], $sql);
				$_SESSION['id'] = 0;
			}
			$cookies['lastvisit'] = time();
			$cookies['visitnum']++;
			setcookie('fashioncents', json_encode($cookies), time()+60*60*24*30);
			//setcookie($cookie_name, json_encode($cookies), time()+60*60*24*30, '/', 'fashioncents.me', TRUE, TRUE);
		} else {
			//cookies disabled new session
			$sql = "INSERT INTO tbl_visit (uniqueidentifier, userid, ip, language, useragent, fctime) VALUES ('0', 0, '" . $_SERVER['REMOTE_ADDR'] . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_ACCEPT_LANGUAGE']) . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_USER_AGENT']) . "'" . time() . ")";
			mysqli_query();
		}
	}
	$visitsql = "SELECT MAX(visitid) FROM tbl_visit";
	$row = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'], $visitsql));
	$_SESSION['visitid'] = $row['MAX(visitid)'];
	//set visitid
}

$sql = "INSERT INTO tbl_pages (visitid, page, query, method, fctime) VALUES (" . $_SESSION['visitid'] . ", '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['PHP_SELF']) . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['QUERY_STRING']) . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['REQUEST_METHOD']) . "', " . time() . ")";
	mysqli_query($GLOBALS['sqllink'], $sql);
if (empty($_SESSION['id']) && !empty($disallowguest)) {
	header("Location: 404.php");
	exit();
}
//cookies must be before <html> tag
include('header.php');

if (empty($_SESSION['id'])) {
	include('guestnav.php');
	include('guestprompt.php');
} else {
	include('nav.php');
}
