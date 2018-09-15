<?php 
define("INCLUDE_CHECK", true);
include 'sessionsguest.php';
include 'functions.php';

$posthash = $_SERVER['PHP_SELF'];
$posthash = substr($posthash, strpos($posthash, "_") + 1);
$posthash = substr($posthash, 0, strpos($posthash, ".php"));

$query = mysqli_query($GLOBALS['sqllink'],"SELECT a.postid,description,image_small,posttime,hash,b.userid,username,utype,profilepic FROM tbl_posts a INNER JOIN tbl_masterusers b ON a.userid = b.userid WHERE A.hash = '" . $posthash . "'");
if($query) {
    parsefeed($query);
} else {
    header("Location: 404.php");
}
?>