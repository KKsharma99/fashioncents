<?php
define('INCLUDE_CHECK',true);
require '../connect.php';
ini_set('display_errors','1'); 
error_reporting(E_ALL);

$query = "SELECT first_name,last_name,email FROM tbl_account a JOIN tbl_masterusers b WHERE a.userid = b.userid AND b.gender =  1";
$result = mysqli_query($GLOBALS['sqllink'], $query);
$emails = array();
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
	$emails[$i] = $row;
	$i++;
}
for ($ii = 0; $ii < $i; $ii++) {
	echo $emails[$ii]['first_name'] . ", " . $emails[$ii]['email'] . ", <br>";
}


?>