<?php
define('INCLUDE_CHECK',true);
require 'connect.php';
ini_set('display_errors','1'); 
error_reporting(E_ALL);

$sql = "SELECT b.first_name, b.email FROM tbl_masterusers a JOIN tbl_account b ON a.userid = b.userid WHERE a.gender = 1";
$result = mysqli_query($GLOBALS['sqllink'], $sql);
while ($row = mysqli_fetch_assoc($result)) {
	echo $row['first_name'] . ", " . $row['email'] . "<br>";
}
?>