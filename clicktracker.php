<?php
define('INCLUDE_CHECK',true);
require 'connect.php';
ini_set('display_errors','1'); 
error_reporting(E_ALL);
if (isset($_POST['visitid']) && isset($_POST['location']) && isset($_POST['itemid'])) {
	$sql = "INSERT INTO tbl_itemclicks (visitid, itemid, fctime, clickloc) VALUES (" . $_POST['visitid'] . ", " . $_POST['itemid'] . ", " . time() . ", '" . $_POST['location'] . "')";
	mysqli_query($GLOBALS['sqllink'], $sql);
}
?>