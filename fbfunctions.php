<!DOCTYPE html>
<?php
if(!defined('INCLUDE_CHECK')) header("Location: 404.php");
if(!isset($_SESSION)) {}
    session_start();
}

if(isset($_POST['fn'])) {
    if($_POST['fn'] == "login") {
        fbLogin();
    } else if($_POST['fn'] == "logout") {
        checkLogout();
    } else {
        header("Location: 404.php");
    }
} else {
    header("Location: 404.php");
}

function fbLogin() {
    $query = mysqli_query($link,"SELECT a.userid,username,first_name,last_name,facebook FROM tbl_account a JOIN tbl_masterusers b ON a.userid = b.userid WHERE facebook = '" . $_POST['info']['id']."' AND first_name = '" . $_POST['info']['first_name'] . "' AND last_name = '" . $_POST['info']['last_name'] . "'");
    $result = mysqli_fetch_assoc($query);
    if($result) {
        if($result['facebook'] == null) {
            mysqli_query($GLOBALS['sqllink'], "UPDATE tbl_account SET facebook = ".$_POST['info']['id']." WHERE userid = " . $result['userid']);
        }
        mysqli_query($GLOBALS['sqllink'], "UPDATE tbl_account SET lastlogin = " . time());

        $_SESSION['userid'] = $result['userid'];
        $_SESSION['username'] = $result['userid'];
        $_SESSION['facebook'] = true;
        echo json_encode(true);
        exit();
    } else {
        $gender = 1;
        if(strcasecmp($_POST['info']['gender'], "female")) {
            $gender = 2;
        }
        $query = "INSERT INTO tbl_masterusers(username,gender) VALUES(
        '".str_replace(" ", "_", $_POST['info']['name'])."',
        '".$gender."')";
        if(mysqli_error($GLOBALS['sqllink']) == "") { 
            $result = mysqli_insert_id($GLOBALS['link']);
            saveImg($_POST['info']['picture']['data']['url'], "img/users/".$result.".png", 100, $result);

            $query = "INSERT INTO tbl_account(userid,email,first_name,last_name,facebook,lastlogin)
            VALUES(
            '".$result."',
            '".$_POST['info']['email']."',
            '".$_POST['info']['first_name']."',
            '".$_POST['info']['last_name']."',
            '".$_POST['info']['id']."',
            '".time()."'
            )";
            mysqli_query($GLOBALS['sqllink'], $query);
                $_SESSION['id'] = $result;//$row['id'];
                $username = mysqli_fetch_assoc(mysqli_query("SELECT username FROM tbl_masterusers WHERE userid = " . $result));
                $_SESSION['username'] = $username['username']
                echo json_encode(false);
                exit();
            }
        }
    }

    function saveImg($source_url, $destination_url, $quality, $id) {
        $info = getimagesize($source_url);

        if ($info['mime'] == 'image/jpeg')
          $image = imagecreatefromjpeg($source_url);

      elseif ($info['mime'] == 'image/gif')
          $image = imagecreatefromgif($source_url);

      elseif ($info['mime'] == 'image/png')
          $image = imagecreatefrompng($source_url);

      imagejpeg($image, $destination_url, $quality);
      mysqli_query("UPDATE tbl_masterusers SET profilepic = '" . $destination_url . "' WHERE userid = " . $id);
  }

  function checkLogout() {
    if(!empty($_SESSION['facebook'])) {
        session_destroy();
        return true;
    } else {
        return false;
    }
  }
  ?>