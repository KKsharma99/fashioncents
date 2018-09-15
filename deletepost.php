<?php
define('INCLUDE_CHECK',true);
include('connect.php');
session_start();
ini_set('display_errors','1'); 
error_reporting(E_ALL);

if ($_POST['postid']) {
	$sql = "SELECT userid FROM tbl_posts WHERE postid = " . $_POST['postid'];
	$row = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'], $sql));
	if ($_SESSION['id'] == $row['userid']) {
		$deletesql = "DELETE FROM tbl_posts WHERE postid = " . $_POST['postid'];
		mysqli_query($GLOBALS['sqllink'], $deletesql);
	}
	echo 1;
}

?>