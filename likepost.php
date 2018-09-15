<?php
define('INCLUDE_CHECK',true);
include('connect.php');
//ini_set('display_errors','1'); 
//error_reporting(E_ALL);

if ($_POST['postid'] && $_POST['status'] && $_POST['uid'] && $_POST['posterid'] && $_POST['username']) {
	if ($_POST['status'] == 1) {
		$sql = "INSERT INTO tbl_likes (postid, userid, fctime) VALUES (" . $_POST['postid'] . ", " . $_POST['uid'] . ", " . time() . ")";
		mysqli_query($GLOBALS['sqllink'], $sql);
		$noti = "INSERT INTO tbl_notifications (userid,fctime,type,username) VALUES (" . $_POST['posterid'] . ", " . time() . ", 3, '" . $_POST['username'] . "')";
		mysqli_query($GLOBALS['sqllink'], $noti);
		echo "1";
	} else 
	if ($_POST['status'] == 2) {
		$sql = "DELETE FROM tbl_likes WHERE userid = " . $_POST['uid'] . " AND postid = " . $_POST['postid'];
		mysqli_query($GLOBALS['sqllink'], $sql);
		echo "2";
	}
}

?>