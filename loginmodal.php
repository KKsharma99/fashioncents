<?php
if(!defined('INCLUDE_CHECK')) {
    header("Location: 404.php");
    exit();
}

//include 'fbfunctions.php';
if(isset($_POST['login'])) {
    //unset($_SESSION['loginerr']);
    $email = mysqli_real_escape_string($GLOBALS['sqllink'], trim($_POST['email']));
    //$_POST['rememberMe'] = (int)$_POST['rememberMe'];

    // Escaping all input data
    //removed profile pic from select didnt find it necessary and check email in php which we're going to have to check in php when we integrate hashing passwords
    //$row = mysqli_fetch_assoc(mysqli_query($link, "SELECT userid,email,profilepic FROM tbl_users WHERE email='{$_POST['email']}' AND pass='{$_POST['password']}'"));
    $row = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'], "SELECT userid, email, userpass, facebook, lastlogin FROM tbl_account WHERE email='" . $email . "'"));
    $err = '';
    if(!empty($row))
    {
        // If everything is OK login
        //changed session to userid for consistency will have to change to userid in all corresponding filesize(filename)

        //$_SESSION['email'] = $row['email'];
        //$_SESSION['image'] = $row['profilepic'];
        //integrate remember me
        //$_SESSION['rememberMe'] = $_POST['rememberMe'];

        // Store some data in the session
        //setcookie('tzRemember',$_POST['rememberMe']);
        if(hash_equals($row['userpass'], crypt($_POST['pass'], $row['userpass']))) {
            mysqli_query($GLOBALS['sqllink'], "UPDATE tbl_account SET lastlogin = ".time()." WHERE email = '" . $email . "'");
            $_SESSION['id'] = $row['userid'];//$row['id'];
            $row = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'], "SELECT username,utype FROM tbl_masterusers WHERE userid = " . $row['userid']));
            $_SESSION['username'] = $row['username'];
            unset($_SESSION['facebook']);
            $cookies = array();
            $cookies = json_decode($_COOKIE['fashioncents'], true);
            $cookies['lastvisit'] = time();
            $cookies['id'] = $_SESSION['id'];
            $cookies['rememberme'] = !empty($_POST['squaredFour']);
            $cookies['visitnum']++;
            setcookie($cookie_name, json_encode($cookie_value), time()+60*60*24*30);
            $sql = "INSERT INTO tbl_visit (uniqueidentifier, userid, ip, language, useragent, fctime) VALUES ('" . $cookies['identifier'] . "', " . $cookies['id'] . ", '" . $_SERVER['REMOTE_ADDR'] . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_ACCEPT_LANGUAGE']) . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_SERVER['HTTP_USER_AGENT']) . "', " . time() . ")";
                    mysqli_query($GLOBALS['sqllink'], $sql);
            $visitsql = "SELECT MAX(visitid) FROM tbl_visit";
            $row = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'], $visitsql));
            $_SESSION['visitid'] = $row['MAX(visitid)'];
            header("Location: index.php");
            exit();
            //exit;
        } else {
            $err='Incorrect password.';
        }
    } else {
        $err='There is no account with this email.';
    }
    if($err != '') {
        $loginerror = $err;
    }
}
?>

 
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="loginmodal-container">
      <div class="text-center"> 
        <img class="login-logo" src="img/Fashioncents.png" alt="Fashioncents Logo">
      </div>
      <?php if(isset($loginerror)) { echo $loginerror; } ?>
      <form method = "post">
        <input type="text" name="email" placeholder="Email" required = "">
        <input type="password" name="pass" placeholder="Password" required = "">
        <input type="submit" name="login" class="login loginmodal-submit smooth-button" value="LOGIN">
        <label>
            <p class="register-agree-terms">By signing in you agree to Fashioncents' 
                <a href="privacy.php">Privacy Policy</a> and 
                <a href="terms.php">Terms and Conditions</a>.
            </p> 
        </label> 
      </form>

      <div class="login-help text-center">

        <input class="squaredFour" type="checkbox" value="None" id="squaredFour" name="check" checked />
        <a href="#">Remember Me &nbsp &nbsp</a> 
        <a href="#">   Forgot Password</a> <br> 
        Don't have an account?
        <a href="#"><u data-dismiss="modal" data-toggle="modal" data-target="#register-modal">Join</u></a>
      </div> <br> <br> 
      
      <button style="background: transparent; border: 0px;" onclick="fb_login();"><img src="img/fblogin.png" width="140px" alt=""></button>
      <button type="button" class="registertologinbtn smooth-button" data-dismiss="modal">Close</button>

    </div>
  </div>
</div>

<?php 
 if (!empty($loginerror)) {
    echo "<script type='text/javascript'>
    $(window).on('load',function(){
        $('#login-modal').modal('show');
    });
    </script>";
 }
?>