<?php
define('INCLUDE_CHECK',true);
include('connect.php');
//ini_set('display_errors','1'); 
//error_reporting(E_ALL);

if ($_POST['commentid'] && $_POST['status'] && $_POST['uid']) {
	if ($_POST['status'] == 1) {
		$sql = "INSERT INTO tbl_commentlikes (commentid, userid, fctime) VALUES (" . $_POST['commentid'] . ", " . $_POST['uid'] . ", " . time() . ")";
		mysqli_query($GLOBALS['sqllink'], $sql);
		$noti = "INSERT INTO tbl_notifications (userid,fctime,locationid,type,username) VALUES (" . $_POST['posterid'] . ", " . time(). "," . $_POST['commentid'] . ", 4, '" . $_POST['username'] . "')";
		mysqli_query($GLOBALS['sqllink'], $noti);
		echo "1";
	} else 
	if ($_POST['status'] == 2) {
		$sql = "DELETE FROM tbl_commentlikes WHERE commentid = " . $_POST['commentid'] . " AND userid = " . $_POST['uid'];
		mysqli_query($GLOBALS['sqllink'], $sql);
		echo "2";
	}
}

?>