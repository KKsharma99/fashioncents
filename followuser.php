<?php
define('INCLUDE_CHECK',true);
include('connect.php');
//ini_set('display_errors','1'); 
//error_reporting(E_ALL);
//Errors in generators pass them back and break them
if ($_POST['id'] && $_POST['status'] && $_POST['uid'] && $_POST['username']) {
	if ($_POST['status'] == 1) {
		$sql = "INSERT INTO tbl_following (followerid, userid, fctime) VALUES (" . $_POST['id'] . ", " . $_POST['uid'] . ", " . time() . ")";
		mysqli_query($GLOBALS['sqllink'], $sql);
		$noti = "INSERT INTO tbl_notifications (userid,fctime,type,username) VALUES (" . $_POST['uid'] . ", " . time() . ", 1, '" . $_POST['username'] . "')";
		mysqli_query($GLOBALS['sqllink'], $noti);
		echo "1";
	} else
	if ($_POST['status'] == 2) {
		$sql = "DELETE FROM tbl_following WHERE followerid = " . $_POST['id'] . " AND userid = " . $_POST['uid'];
		mysqli_query($GLOBALS['sqllink'], $sql);
		//$noti = "INSERT INTO tbl_notifications (userid,fctime,type,username) VALUES (" . $_POST['uid'] . ", " . time() . ", 2, '" . $_POST['username'] . "')";
		//mysqli_query($GLOBALS['sqllink'], $noti);
		echo "2";
	}
}
?>