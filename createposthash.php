<?php 
define('INCLUDE_CHECK',true);
include 'connect.php';

$posts = mysqli_query($GLOBALS['sqllink'], "SELECT postid,hash FROM tbl_posts WHERE hash = ''");
$existing = array();
$query = mysqli_query($GLOBALS['sqllink'], "SELECT hash FROM tbl_posts WHERE 1");
if($query) {
    while($row = mysqli_fetch_assoc($query)) {
        $existing[] = $row['hash'];
    }
}
while($post = mysqli_fetch_assoc($posts)) {
    $newhash = generateRandomString(10);
    while(in_array($newhash,$existing)) {
        $newhash = generateRandomString(10);
    }
    mysqli_query($GLOBALS['sqllink'], "UPDATE tbl_posts SET hash = '" . $newhash . "' WHERE postid = " . $post['postid']);
    copy("asinglepost_template.php", "singlepost_" . $newhash . ".php");
    echo $post['postid'] . ": " . $newhash;
}


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>