<?php 
require_once "DB_Functions.php";
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['uid'])) {

    // receiving the post params
    $uid = $_POST['uid'];
 
    // get the user by email and password
    if(isset($_POST['lastpostid'])) {
        $lastpostid = $_POST['lastpostid'];
        $post = $db->getNextPost($uid, $lastpostid);
    } else {
        $post = $db->getNextPost($uid, null);
    }
 
    if ($post != false) {
        
        $details = $db->getPostDetails($uid,$post);
        $response["error"] = FALSE;
        $response["post"] = $post;
        $response["details"] = $details;
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Posts call failed!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters uid or number of posts is missing!";
    echo json_encode($response);
}
?> 