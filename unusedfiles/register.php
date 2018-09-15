<?php
define('INCLUDE_CHECK',true);
require 'connect.php';
require 'functions.php';
// Those two files can be included only if INCLUDE_CHECK is defined
//session_name('tzLogin');
// Starting the session
ini_set('display_errors','1'); error_reporting(E_ALL);
//session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks


//session.save_path = "";
if(isset($_POST['submit']) && $_POST['submit']=='Register')
{
    // If the Register form has been submitted

    $err = array();
    $_POST['rfirst_name'] = mysqli_real_escape_string($link, $_POST['rfirst_name']);
    $_POST['rlast_name'] = mysqli_real_escape_string($link, $_POST['rlast_name']);
    $_POST['remail'] = mysqli_real_escape_string($link, $_POST['remail']);
    $_POST['rpassword'] = mysqli_real_escape_string($link, $_POST['rpassword']);
    $_POST['rconfirm-password'] = mysqli_real_escape_string($link, $_POST['rconfirm-password']);
    $_POST['rfirst_name'] = trim($_POST['rfirst_name']);
    $_POST['rlast_name'] = trim($_POST['rlast_name']);
    $_POST['remail'] = trim($_POST['remail']);
    $_SESSION['rfirst_name'] = $_POST['rfirst_name'];
    $_SESSION['rlast_name'] = $_POST['rlast_name'];
    $_SESSION['remail'] = $_POST['remail'];
    //if(isset($_POST['rgender'])) {
    $test = $_POST['rgender'];
    $_SESSION['rgender'] = $_POST['rgender'];
    //}
    $_SESSION['rradio'] = $_POST['privacytype'];
    $ryear=$_POST['ryear'];
    if((int)$_POST['rmonth'] < 10) {
        $rmonth = "0" . $_POST['rmonth'];
    } else {
        $rmonth=$_POST['rmonth'];
    }
    if((int)$_POST['rday'] < 10) {
        $rday = "0" . $_POST['rday'];
    } else {
        $rday=$_POST['rday'];
    }
    $_SESSION['rmonth'] = (int)$_POST['rmonth'];
    $_SESSION['rday'] = (int)$_POST['rday'];
    $_SESSION['ryear'] = (int)$_POST['ryear'];
    if(!$_POST['rfirst_name'] || !$_POST['rlast_name'] || !$_POST['remail'] || $_POST['rmonth']==00 || $_POST['rday']==00 || $_POST['ryear']==00 || !$_POST['rpassword'] || !$_POST['rconfirm-password'] || $_POST['rgender']=="null") {
        $err[] = 'You must fill in all fields!';
    }
    

    if(!count($err)) {
        if(($_SESSION['rday']==31 && ($_SESSION['rmonth']==2 || $_SESSION['rmonth']==4 || $_SESSION['rmonth']==6 || $_SESSION['rmonth']==9 || $_SESSION['rmonth']==11)) || ($_SESSION['rmonth']==2 && $_SESSION['rday']==30) || ($_SESSION['rmonth']==2 && $_SESSION['rday']==29 && $_SESSION['ryear'] % 4 !=0) || ($_SESSION['rmonth']==2 && $_SESSION['rday']==29 && $_SESSION['ryear'] % 4 ==0 && $_SESSION['ryear']%100==0)){
            $err[]='Your date is incorrect!';
        } else {
            $date = new DateTime($ryear . "-" . $rmonth . "-" . $rday);
            $today = new DateTime('today');
            $age = $date->diff($today)->y;
            if($age<13) {
                $err[] = "You must be at least 13 years old";
            }
        }
    }
    
    if($_POST['rpassword'] && (strlen($_POST['rpassword']) < 8  || strlen($_POST['rpassword'] > 26)) ) {
        $err[]='Your password must be between 8 and 26 characters!';
    }
    //if(!checkEmail($_POST['email']))
    //{
    //    $err[]='Your email is not valid!';
    //}
    if ($_POST['rpassword']!= $_POST['rconfirm-password']) {
        $err[]='Passwords do not match!';
    }
    if(!count($err))
    {
        // If there are no errors

        //$password = substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
        // Generate a random password

        $_POST['rfirst_name'] = mysqli_real_escape_string($link, $_POST['rfirst_name']);
        $_POST['rlast_name'] = mysqli_real_escape_string($link, $_POST['rlast_name']);
        $_POST['rpassword'] = mysqli_real_escape_string($link, $_POST['rpassword']);
        $_POST['remail'] = mysqli_real_escape_string($link, $_POST['remail']);
        // Escape the input data
        //md5($pass)
        $row = mysql_fetch_assoc(mysqli_query($link, "SELECT email FROM tbl_users WHERE email='".$_POST['remail']."'"));
        if(isset($row['email'][0])){
            $err[]='An account with this email already exists';
        }
        else{

            $cost = 10;
            $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
            $salt = sprintf("$2a$%02d$", $cost) . $salt;
            $hash = crypt($_POST['rpassword'], $salt);
            //$err[]=$hash;

            mysqli_query($link, "INSERT INTO tbl_users(first_name,last_name,gender,email,profilepic,pass, date_of_birth, regip, privacy)
                VALUES(
                    '".$_POST['rfirst_name']."',
                    '".$_POST['rlast_name']."',
                    '".$_POST['rgender']."',
                    '".$_POST['remail']."',
                    'img/users/defaultuser.png',
                    '".$hash."', 
                    '".$ryear . "-" . $rmonth . "-" . $rday."',
                    '".$_SERVER['REMOTE_ADDR']."',
                    '".$_POST['privacytype']."'
                    )");

        /*if(mysql_affected_rows($link)==1)
        {
            $headers = array("From: from@example.com",
                "Reply-To: replyto@example.com",
                "X-Mailer: PHP/" . PHP_VERSION
            );
            $headers = implode("\r\n", $headers);
            mail(   $_POST['email'],
                        'Registration System Demo - Your New Password',
                        'Your password is: '.$pass, $headers);
            $_SESSION['msg']['reg-success']='Account created successfully! Please log in.';
        }
        else $err[]='This email is already in use!';*/
        $_SESSION['msg']['reg-success']='Account created successfully! Please log in.';
        header("Location: index.php");
    }
}
if(count($err))
{
    $_SESSION['msg']['reg-err'] = implode('<br />',$err);
    header("Location: register.php");
}   


exit;
}
?>


<!DOCTYPE html>

<html lang="en">



<head>



    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="shortcut icon" href="img/logo2.jpg" />

    <link rel="apple-touch-icon" href="img/logo2.jpg"/>



    <title>Fashioncents</title>



    <!-- Bootstrap Core CSS -->

    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">



    <!-- Custom Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">



    <!-- Plugin CSS -->

    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.css">

    <link rel="stylesheet" href="vendor/device-mockups/device-mockups.min.css">



    <!-- Theme CSS -->

    <link href="css/new-age13.css" rel="stylesheet">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->



    </head>



    <body id="page-top">

        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">

            <div class="container">

                <!-- Brand and toggle get grouped for better mobile display -->

                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>

                    </button>

                    <a class="navbar-brand page-scroll" href="index.php"><b>Fashioncents</b></a>

                </div>



                <!-- Collect the nav links, forms, and other content for toggling -->

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">

                        <li>

                            <a class="page-scroll" href="#features">Features</a>

                        </li>

                    </ul>

                </div>

                <!-- /.navbar-collapse -->

            </div>

            <!-- /.container-fluid -->

        </nav>



        <header>

            <div class="container">

                <div class="row">

                    <div class="col-sm-7">

                        <div class="header-content">

                            <div class="header-content-inner">

                                <h1>Join the best social fashion marketplace.</h1>

                                <div class="panel panel-login">

                                    <div class="panel-body">

                                        <div class="row">

                                            <div class="col-lg-12">

                                                <!--<form id="login-form" action="#" method="post" role="form" style="1 display: block;">-->
                                                <form id="register-form" action="#" method="post" role="form" style="display: block;">


                                                    <h3>REGISTER</h3>

                                                    <?php
                                                    if(isset($_SESSION['msg']['reg-err']) && $_SESSION['msg']['reg-err']) {
                                                        echo '<div class="err">'.$_SESSION['msg']['reg-err'].'</div>';

                                                    }
                                                    ?>

                                                    <div class="form-group">

                                                        <input type="text" name="rfirst_name" id="rfirst_name" tabindex="1" class="form-control" placeholder="First Name" value="" maxlength="16">

                                                    </div>

                                                    <div class="form-group">

                                                        <input type="text" name="rlast_name" id="rlast_name" tabindex="1" class="form-control" placeholder="Last Name" value="" maxlength="16">

                                                    </div>

                                                    <div class="form-group text-left">

                                                        <strong>Date of Birth: </strong>    <select name="rmonth" id="rmonth" style="color: black; background-color: white">
                                                        <option value="0" <?php if(!isset($_SESSION['rmonth']) || $_SESSION['rmonth']==0) echo ' selected';?>>Month</option><option value="1"<?php if(isset($_SESSION['rmonth']) && $_SESSION['rmonth']==1) echo ' selected';?>>January</option><option value="2"<?php if(isset($_SESSION['rmonth']) && $_SESSION['rmonth']==2) echo ' selected';?>>February</option><option value="3"<?php if(isset($_SESSION['rmonth']) && $_SESSION['rmonth']==3) echo ' selected';?>>March</option><option value="4"<?php if(isset($_SESSION['rmonth']) && $_SESSION['rmonth']==4) echo ' selected';?>>April</option><option value="5"<?php if(isset($_SESSION['rmonth']) && $_SESSION['rmonth']==5) echo ' selected';?>>May</option><option value="6"<?php if(isset($_SESSION['rmonth']) && $_SESSION['rmonth']==6) echo ' selected';?>>June</option><option value="7"<?php if(isset($_SESSION['rmonth']) && $_SESSION['rmonth']==7) echo ' selected';?>>July</option><option value="8"<?php if(isset($_SESSION['rmonth']) && $_SESSION['rmonth']==8) echo ' selected';?>>August</option><option value="9"<?php if(isset($_SESSION['rmonth']) && $_SESSION['rmonth']==9) echo ' selected';?>>September</option><option value="10"<?php if(isset($_SESSION['rmonth']) && $_SESSION['rmonth']==10) echo ' selected';?>>October</option><option value="11"<?php if(isset($_SESSION['rmonth']) && $_SESSION['rmonth']==11) echo ' selected';?>>November</option><option value="12"<?php if(isset($_SESSION['rmonth']) && $_SESSION['rmonth']==12) echo ' selected';?>>December</option></select>
                                                        <select name="rday" id="rday" style="color: black; background-color: white"><?php
                                                            if(!isset($_SESSION['ryear']) || $_SESSION['rday']==00) {
                                                                echo '<option value="00"selected>Day</option>';
                                                            } else {
                                                                echo '<option value="00">Day</option>';
                                                            }   
                                                            for($i=1;$i<=31;$i++){
                                                                if(isset($_SESSION['rday']) && $i==$_SESSION['rday']){
                                                                    echo '<option value='.$i.' selected>'.$i.'</option>';
                                                                } else {
                                                                    echo '<option value='.$i.'>'.$i.'</option>';
                                                                }
                                                            }
                                                            ?></select>
                                                            <select name="ryear" id="ryear" style="color: black; background-color: white"><?php 
                                                                if(!isset($_SESSION['ryear']) || $_SESSION['ryear']==00) {
                                                                    echo '<option value="00" selected>Year</option>';
                                                                } else {
                                                                    echo '<option value="00">Year</option>';
                                                                }
                                                                for($i=2017;$i>=1900;$i--){
                                                                    if(isset($_SESSION['ryear']) && $i==$_SESSION['ryear']){
                                                                        echo '<option value='.$i.' selected>'.$i.'</option>';
                                                                    } else {
                                                                        echo '<option value='.$i.'>'.$i.'</option>';            
                                                                    }

                                                                }
                                                                ?></select>

                                                            </div>

                                                            <div class="form-group text-left">

                                                               <strong>Gender: </strong>  <select name='rgender' id='rgender' style="color: black; background-color: white"><option value="null" <?php if(!isset($_SESSION['rgender']) || $_SESSION['rgender']=="null") echo ' selected';?>>Gender</option><option value="Male"<?php if(isset($_SESSION['rgender']) && $_SESSION['rgender']=='Male') echo ' selected';?>>Male</option><option value="Female"<?php if(isset($_SESSION['rgender']) && $_SESSION['rgender']=='Female') echo ' selected';?>>Female</option><option value="Other"<?php if(isset($_SESSION['rgender']) && $_SESSION['rgender']=='Other') echo ' selected';?>>Other</option></select>
                                                           </div>

                                                           <div class="form-group">

                                                            <input type="email" name="remail" id="remail" tabindex="1" class="form-control" placeholder="Email Address" value="" maxlength="320">

                                                        </div>

                                                        <div class="form-group">

                                                            <input type="password" name="rpassword" id="rpassword" tabindex="2" class="form-control" placeholder="Password" maxlength="26">

                                                        </div>

                                                        <div class="form-group">

                                                            <input type="password" name="rconfirm-password" id="rconfirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" maxlength="26">

                                                        </div>                                                                                                  <!-- Privacy Type (NEW CODE - DEC 30 2016) -->

                                                        <div class="form-group text-left">

                                                            <strong>Privacy Type: </strong> 
                                                            <label class="radio-inline" for="privacytype-public">
                                                              <input type="radio" name="privacytype" value="1" <?php if(!(isset($_SESSION['rradio'])) || $_SESSION['rradio']=="1"){echo 'checked="checked"';}?>>
                                                              Public
                                                          </label> 
                                                          <label class="radio-inline" for="privacytype-private">
                                                              <input type="radio" name="privacytype" value="0" <?php if((isset($_SESSION['rradio']) && $_SESSION['rradio']=="0")){echo 'checked="checked"';}?>>
                                                              Private
                                                          </label>

                                                      </div>

                                                      <div class="form-group">
                                                          <strong>Privacy Type: </strong>                                
                                                         <div class="checkbox"> 
                                                              &nbsp &nbsp &nbsp <input type="checkbox" name="agreement" id="agreement-0" value="1">
                                                              I agree to Fashioncents' <a style="color:white;" href="privacy.html"><u>Privacy Policy</u></a> and <a style="color:white" href="terms.html"><u>Terms and Conditions.</u></a>     
                                                          </div>     
                                                      </div>



                                                      <div class="panel-heading">

                                                        <div class="row">

                                                            <div class="col-xs-4 text-left">

                                                                <a href="index.php" class="active" id="login-form-link"><div class="btn btn-md btn-outline">BACK</div></a>

                                                            </div>

                                                            <div class="col-xs-8 text-right ">

                                                                <input type="submit" name="submit" id="register-submit" tabindex="4" class="btn btn-outline makeclears" value="Register">
                                                                <!--<a href="#" id="register-form-link"><div class="register btn btn-outline btn-xl page-scroll">REGISTER</div></a>-->

                                                            </div>

                                                        </div>

                                                    </div>                                    

                                                </form>

                                            </div>

                                        </div>

                                    </div>



                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-sm-5">

                        <div class="device-container">

                            <div class="device-mockup iphone6_plus portrait white">

                                <div class="device">

                                    <div class="screen">

                                        <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->

                                        <img src="img/demo-screen-2.jpg" class="img-responsive" alt="">

                                    </div>

                                    <div class="button">

                                        <!-- You can hook the "home button" to some JavaScript events or just remove it -->

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </header>


        <section id="features" class="features">

            <div class="container">

                <div class="row">

                    <div class="col-lg-12 text-center">

                        <div class="section-heading">

                            <h2>Unlimited Outfits, Unlimited Possibilities</h2>

                            <p class="text-muted">Check out what's trending! Build your style!</p>

                            <hr>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="device-container">

                            <div class="device-mockup iphone6_plus portrait white">

                                <div class="device">

                                    <div class="screen">

                                        <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->

                                        <img src="img/demo-screen-1.jpg" class="img-responsive" alt=""> </div>

                                        <div class="button">

                                            <!-- You can hook the "home button" to some JavaScript events or just remove it -->

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="feature-item">

                                            <i class="icon-note text-primary"></i>

                                            <h3>Build a Fashion Sense</h3>

                                            <p class="text-muted">Learn from the style of others.</p>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="feature-item">

                                            <i class="icon-camera text-primary"></i>

                                            <h3>Share your Style</h3>

                                            <p class="text-muted">Put up an image of your outfit to share with the online community.</p>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="feature-item">

                                            <i class="icon-wallet text-primary"></i>

                                            <h3>Earn Money</h3>

                                            <p class="text-muted">By attaching the amazon link of each of the items in your outfit you can make money with affiliate marketing!</p>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="feature-item">

                                            <i class="icon-heart text-primary"></i>

                                            <h3>Join a Community</h3>

                                            <p class="text-muted">Become part of an enthusiastic fashion community.</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>



<section id="download" class="hidden-xs download bg-primary text-center">

    <div class="container">

        <div class="row">

            <div class="col-md-10 col-md-offset-1">

                <h2 class="section-heading">Post Outfits and Earn!</h2>

                <br> <br> <br> 

                    <img class="img-responsive" src="img/earn.jpg" alt="Earn_on_Fashioncents">

            </div>

        </div>

    </div>

</section>

                <section class="cta">

                    <div class="cta-content">

                        <div class="container">

                            <h2>Stop Waiting.<br>Start Posting.</h2>

                            <a href="#" class="btn btn-outline btn-xl page-scroll">Get Started!</a>

                        </div>

                    </div>

                    <div class="overlay"></div>

                </section>



                <section id="contact" class="contact bg-primary">

                    <div class="container">

                        <h2>We <i class="fa fa-heart"></i> new friends!</h2>

                        <ul class="list-inline list-social">

                            <li class="social-twitter">

                                <a href="#"><i class="fa fa-twitter"></i></a>

                            </li>

                            <li class="social-facebook">

                                <a href="#"><i class="fa fa-facebook"></i></a>

                            </li>

                            <li class="social-google-plus">

                                <a href="#"><i class="fa fa-google-plus"></i></a>

                            </li>

                        </ul>

                    </div>

                </section>



                <footer>

                    <div class="container">

                        <p>&copy; 2016 Fashion Cents. All Rights Reserved.</p>

                        <ul class="list-inline">

                            <li>

                                <a href="#">Privacy</a>

                            </li>

                            <li>

                                <a href="#">Terms</a>

                            </li>

                            <li>

                                <a href="#">FAQ</a>

                            </li>

                        </ul>

                    </div>

                </footer>



                <!-- jQuery -->

                <script src="vendor/jquery/jquery.min.js"></script>



                <!-- Bootstrap Core JavaScript -->

                <script src="vendor/bootstrap/js/bootstrap.min.js"></script>



                <!-- Plugin JavaScript -->

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>



                <!-- Theme JavaScript -->

                <script src="js/new-age.min.js"></script>
                <?php
                if(isset($_SESSION['msg']['reg-err'])){
                    echo '<script type="text/javascript">
                    $("#register-form").show();
                    $("#login-form").hide();
                    document.getElementById("rfirst_name").value = "' . $_SESSION["rfirst_name"] . '";
                    document.getElementById("rlast_name").value = "' . $_SESSION["rlast_name"] . '";
                    document.getElementById("remail").value = "' . $_SESSION["remail"] . '";

                </script>';
            }
            unset($_SESSION['msg']['reg-err']);
            unset($_SESSION['rfirst_name']);
            unset($_SESSION['rlast_name']);
            unset($_SESSION['remail']);
            unset($_SESSION['rday']);
            unset($_SESSION['rmonth']);
            unset($_SESSION['ryear']);
            unset($_SESSION['rgender']);
            ?>


            <script> 
                  /*  $(function() {
                        $('#login-form-link').click(function(e) {
                            $("#login-form").delay(100).fadeIn(100);
                            $("#register-form").fadeOut(100);
                            $('#register-form-link').removeClass('active');
                            $(this).addClass('active');
                            e.preventDefault();
                        });
                        $('#register-form-link').click(function(e) {
                            $("#register-form").delay(100).fadeIn(100);
                            $("#login-form").fadeOut(100);
                            $('#login-form-link').removeClass('active');
                            $(this).addClass('active');
                            e.preventDefault();
                        });
});*/
</script>  



</body>



</html>