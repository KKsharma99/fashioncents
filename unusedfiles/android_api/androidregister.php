<?php
require_once "DB_Functions.php";
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['gender']) && isset($_POST['password']) && isset($_POST['dateofbirth']) && isset($_POST['privacy'])) {
 
    // receiving the post params
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $dob = $_POST['dateofbirth'];
    $privacy = $_POST['privacy'];
 
    // check if user is already existed with the same email
    if ($db->doesUserExist($email)) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User already existed with " . $email;
        $response["error_num"] = 0;
        //Spero added this^^ to make IOS code easier
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->register($firstname, $lastname, $email, $gender, $password, $dob, $privacy);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            //$response["uid"] = $user["userid"];
            //$response["user"]["firstname"] = $user["first_name"];
            //$response["user"]["lastname"] = $user["last_name"];
            //$response["user"]["email"] = $user["email"];
            //$response["user"]["gender"] = $user["gender"];
            //$response["user"]["privacy"] = $user["privacy"];
            //$response["user"]["dateofbirth"] = $user["date_of_birth"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            $response["error_num"] = 1;
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    $response["error_num"] = 2;
    echo json_encode($response);
}
?>