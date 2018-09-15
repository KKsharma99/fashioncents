<?php
define('INCLUDE_CHECK',true);
include('connect.php');
//ini_set('display_errors','1'); 
//error_reporting(E_ALL);

if ($_POST['postid'] && $_POST['status'] && $_POST['uid']) {
	if ($_POST['status'] == 1) {
		$sql = "INSERT INTO tbl_saved_posts (userid, postid, fctime) VALUES (" . $_POST['uid'] . ", " . $_POST['postid'] . ", " . time() . ")";
		mysqli_query($GLOBALS['sqllink'], $sql);
		echo "1";
	} else 
	if ($_POST['status'] == 2) {
		$sql = "DELETE FROM tbl_saved_posts WHERE userid = " . $_POST['uid'] . " AND postid = " . $_POST['postid'];
		mysqli_query($GLOBALS['sqllink'], $sql);
		echo "2";
	}
}

?>