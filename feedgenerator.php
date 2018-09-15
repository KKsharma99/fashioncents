<?php
define('INCLUDE_CHECK',true);
require 'connect.php';
require 'functions.php';
session_start();
//ini_set('display_errors','1'); 
//error_reporting(E_ALL);
if (isset($_POST['gender']) && isset($_POST['utype']) && isset($_POST['feedtype']) && isset($_POST['number']) && isset($_POST['offset'])) {
	if (isset($_POST['category'])) {
		$category = $_POST['category'];
	} else {
		$category = null;
	}
	$scrollnum = intval($_POST['offset'] / $_POST['number']);
    $sql = "INSERT INTO tbl_scroll (visitid, scrollnum, query, fctime) VALUES (" . $_SESSION['visitid'] . ", " . $scrollnum . ", '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['QUERY_STRING']) . "', " . time() . ")";
    mysqli_query($GLOBALS['sqllink'], $sql);


	generalfeed($_POST['gender'], $_POST['utype'], $category, $_POST['feedtype'], $_POST['number'], $_POST['offset']);
}
?>