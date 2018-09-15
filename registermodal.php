<?php
if(isset($_POST['register'])) {
	//unset($_SESSION['regerr']);
	$err = "";

    if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['firstname']) || empty($_POST['pass']) || empty($_POST['confirmpass']) || empty($_POST['gender'])) {
        $err = "Must fill in all fields!";
    } else {
        if ($_POST['pass'] != $_POST['confirmpass']) {
            $err = 'Password and Confirm Password must match.';
        } else {
            if($_POST['pass'] && (strlen($_POST['pass']) < 8  || strlen($_POST['pass'] > 26)) ) {
                $err='Your password must be between 8 and 26 characters!';
            } else {
                $text = "SELECT email FROM tbl_account WHERE email = '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['email']) . "'";
                $query = mysqli_query($GLOBALS['sqllink'], $text);
                $row = mysqli_fetch_assoc($query);
                if($row) {
                    $err = 'There is already an account with that email!';
                } else {
                    $sql = "SELECT username FROM tbl_masterusers WHERE username = '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['username']) . "'";
                    $row = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'], $sql));
                    if ($row) {
                        $err = 'There is already an account with that username';
                    } else {
                        $cost = 10;
                        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
                        $salt = sprintf("$2a$%02d$", $cost) . $salt;
                        $hash = crypt($_POST['pass'], $salt);
                        //$err[]=$hash;
                        $sql = "INSERT INTO tbl_masterusers(username, gender,utype)
                        VALUES(
                        '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['username']) . "',
                        '" . $_POST['gender'] . "',
                        '3'
                        )";
                        echo $sql;
                        $query = mysqli_query($GLOBALS['sqllink'], $sql);
                        if (mysqli_error($GLOBALS['sqllink']) == "") {
                            $userid = mysqli_insert_id($GLOBALS['sqllink']);
                            $sql = "INSERT INTO tbl_account (userid, first_name, last_name, email, userpass,lastlogin) VALUES (" . $userid . ", '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['firstname']) . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['lastname']) . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['email']) . "', '" . $hash . "', '".time()."')";
                            mysqli_query($GLOBALS['sqllink'], $sql);
                            if (mysqli_error($GLOBALS['sqllink']) == "") {
                                $_SESSION['id'] = $userid;
                                $_SESSION['username'] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['username']);
                                $_SESSION['utype'] = 3;
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
                            } else {
                                $err = "Unexpected error";
                            }
                        } else {
                            $err = "Unknown error";
                        }
                    }
                    
                }
            }
        }
    }
    if($err != "") {
        $registerror = $err;
    }
    //echo $err;
}
?>

<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="registermodal-container">
      <div class="text-center"> 
        <img class="register-logo" src="img/Fashioncents.png" alt="Fashioncents Logo">
    </div>
    <?php if(isset($registererror)) { echo $registererror; }?>
    <form method = "post">
        <span class="register-label">Create an Account</span>
        <input type="text" name="email" placeholder="Email" required = "">
        <input type="text" name="username" placeholder="Username" required = "" maxlength="30">
        <input type="text" name="firstname" placeholder="First Name" required = "" maxlength="18">
        <input type="text" name="lastname" placeholder="Last Name (Optional)" maxlength="18"> 
        <input type="password" name="pass" placeholder="Password" required = "" maxlength="26">
        <input type="password" name="confirmpass" placeholder="Confirm Password" required = "" maxlength="26">
      <!--   <label>Date of Birth</label>
        <input type="date" class="form-control" id="exampleInputDOB1" placeholder="Date of Birth"> -->


        <div class="control-group">
          <label class="control control--radio">Male
            <input type="radio" id = "gender-0" name="gender" value = "1" required=""/>
            <div class="control__indicator"></div>
        </label>
        <label class="control control--radio">Female
            <input type="radio" name="gender" id = "gender-1" value = "2" required=""/>
            <div class="control__indicator"></div>
        </label>
    </div> 
    <input type="submit" name="register" class="register registermodal-submit smooth-button" value="JOIN">


    <label>
        <p class="register-agree-terms">By signing up you agree to Fashioncents' 
            <a href="privacy.php">Privacy Policy</a> and 
            <a href="terms.php">Terms and Conditions</a>.
        </p> 
    </label> 


</form>


<div class="register-help text-center">

    <input class="squaredFour" type="checkbox" value="None" id="squaredFour" name="check" unchecked />
    <a href="#">Remember Me &nbsp &nbsp</a> 
    <a href="#">   Forgot Password</a> <br> 
    <a href="#">Have an account? <u><b data-dismiss="modal" data-toggle="modal" data-target="#login-modal">Sign In</b></u></a>

</div> <br>

<button style="background: transparent; border: 0px;"  onclick="fb_login();"><img src="img/fblogin.png" width="140px" alt=""></button> 

<button type="button" class="registertologinbtn smooth-button" data-dismiss="modal">Close</button>

</div>
</div>
</div>

<?php
if (!empty($registererror)) {
    echo "<script type='text/javascript'>
    $(window).on('load',function(){
        $('#register-modal').modal('show');
    });
</script>";
}



?>
