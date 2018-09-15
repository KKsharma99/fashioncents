<?php
define('INCLUDE_CHECK',true);
include 'fbfunctions.php';
//require 'functions.php';
// Those two files can be included only if INCLUDE_CHECK is defined
//session_name('tzLogin');
// Starting the session
ini_set('display_errors','1'); error_reporting(E_ALL);
session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks
//session_start();
//session.save_path = "";

if(isset($_GET['tracker'])) {
    mysqli_query($link, "INSERT INTO tbl_tracker(ip, tracker) VALUES ('".$_SERVER['REMOTE_ADDR']."','".$_GET['tracker']."')");
}

if(isset($_SESSION['id']) && isset($_COOKIE['tzRemember']))
{
    // If you are logged in, but you don't have the tzRemember cookie (browser restart)
    // and you have not checked the rememberMe checkbox:
    //$_SESSION = array();
    //session_destroy();
    //header("Location: home.php");
    // Destroy the session
}
if(isset($_GET['logoff']))
{
    $_SESSION = array();
    session_destroy();
    
    header("Location: index.php");
    exit;
}
if(isset($_POST['Register']) && $_POST['Register']=='Register') {
    $_SESSION = array();
    header("Location: register.php");
    exit;
}
if(isset($_POST['submit']) && $_POST['submit']=='Login')
{
    // Checking whether the Login form has been submitted

    $err = array();
    // Will hold our errors
    $_SESSION['email']=$_POST['email'];
    
    if(!$_POST['email'] || !$_POST['password']){
        $err[] = 'All the fields must be filled in!';
    }
    if(!count($err))
    {
        $_POST['email'] = mysqli_real_escape_string($link, $_POST['email']);
        $_POST['email'] = trim($_POST['email']);
        $_POST['password'] = mysqli_real_escape_string($link, $_POST['password']);
        //$_POST['rememberMe'] = (int)$_POST['rememberMe'];
        
        // Escaping all input data
        //removed profile pic from select didnt find it necessary and check email in php which we're going to have to check in php when we integrate hashing passwords
        //$row = mysqli_fetch_assoc(mysqli_query($link, "SELECT userid,email,profilepic FROM tbl_users WHERE email='{$_POST['email']}' AND pass='{$_POST['password']}'"));
        $row = mysqli_fetch_assoc(mysqli_query($link, "SELECT userid,first_name,last_name,email, pass FROM tbl_users WHERE email='{$_POST['email']}'"));
        if($row['email'])
        {
            // If everything is OK login



            //chanegd session to userid for consistency will have to change to userid in all corresponding files

            //$_SESSION['email'] = $row['email'];
            //$_SESSION['image'] = $row['profilepic'];
            //integrate remember me
            //$_SESSION['rememberMe'] = $_POST['rememberMe'];

            // Store some data in the session
            //setcookie('tzRemember',$_POST['rememberMe']);
            if(hash_equals($row['pass'], crypt($_POST['password'], $row['pass']))){
                mysqli_query($link, "INSERT INTO tbl_loginlog(userid,ip)
                    VALUES(
                        '".$row['userid']."',
                        '".$_SERVER['REMOTE_ADDR']."'
                        )");
                mysqli_query($link, "UPDATE tbl_users SET fb = 1 WHERE userid =" . $row['userid']);
                $_SESSION['link'] = $link;
                $_SESSION['id'] = $row['userid'];//$row['id'];
                $_SESSION['fullname'] = $row['first_name'] . " " . $row['last_name'];
                header("Location: dressforless.php");
                exit;
            }
            else{
                $err[]='Incorrect password.';
            }
        }
        //changed message to say no email rather than wrong email/pass
        else $err[]='There is no account with this email.';
    }
    
    if($err) {
        $_SESSION['msg']['login-err'] = implode('<br />',$err);
    }
    // Save the error messages in the session
    header("Location: index.php");
    exit;
}
if(isset($_POST['guest']) && $_POST['guest']=='Continue as Guest')
{
    mysqli_query($link, "INSERT INTO tbl_loginlog(userid,ip)
        VALUES(
            '-1',
            '".$_SERVER['REMOTE_ADDR']."'
            )");
    $_SESSION['link'] = $link;
        $_SESSION['id'] = -1;//$row['id'];
        header("Location: dressforless.php");
        exit;
    }
//else if($_POST['submit']=='Forgot Password'){
//}

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
        <script>
        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
                console.log("connected");
                // Logged into your app and Facebook.
                testAPI();
            } else if (response.status === 'not_authorized') {
                console.log("not_authorized");
                // The person is logged into Facebook, but not your app.
                //document.getElementById('status').innerHTML = 'Please log ' +
                //    'into this app.';
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
                //document.getElementById('status').innerHTML = 'Please log ' +
                //    'into Facebook.';
            }
        }

        // This function is called when someone finishes with the Login
        // Button.  See the onlogin handler attached to it in the sample
        // code below.
        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }

        function fb_login() {
            FB.login(function(response) {

                checkLoginState();

            });
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId      : '258249911282302',
                cookie     : true,  // enable cookies to allow the server to access 
                                // the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v2.8' // use graph api version 2.8
            });

            // Now that we've initialized the JavaScript SDK, we call 
            // FB.getLoginStatus().  This function gets the state of the
            // person visiting this page and can return one of three states to
            // the callback you provide.  They can be:
            //
            // 1. Logged into your app ('connected')
            // 2. Logged into Facebook, but not your app ('not_authorized')
            // 3. Not logged into Facebook and can't tell if they are logged into
            //    your app or not.
            //
            // These three cases are handled in the callback function.

            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });

        };

    // Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    
        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
        function testAPI() {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me?fields=id,name,first_name,last_name,email,picture,gender,birthday', function(response) {
                $.ajax({
                    url: 'fbfunctions.php',
                    type: 'post',
                    data: { fn: "login", info: response},
                    success: function(data) {
                        console.log(JSON.stringify(response));
                        console.log(JSON.stringify(data));
                        if(data == "true") {
                            window.location.href = "dressforless.php";
                        } else {
                            window.location.href = "dressforless.php";
                        }
                        
                    }
                })
                //console.log('Successful login for: ' + response.name);
                //document.getElementById('status').innerHTML =
                //  'Thanks for logging in, ' + response.name + '!';
            });
        }
    </script>


    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">

        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>

                </button>

                <a class="navbar-brand page-scroll" href="#page-top"><b>Fashioncents</b></a>

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

                                            <form id="login-form" action="#" method="post" role="form" style="1 display: block;">

                                                <h3>LOGIN</h3><?php
                                                

                                                if(isset($_SESSION['msg']['login-err'])) {
                                                    echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
                                                }
                                                if(isset($_SESSION['msg']['reg-success'])) {
                                                    echo '<div class="err">'.$_SESSION['msg']['reg-success'].'</div>';
                                                    unset($_SESSION['msg']['reg-success']);
                                                }?>





                                                <div class="form-group">

                                                    <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">

                                                </div>

                                                <div class="form-group">

                                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">

                                                </div>

                                                <div class="col-xs-6 form-group pull-left checkbox">

                                                    <input id="rememberMe" type="checkbox" name="rememberMe">

                                                    <label for="rememberMe">Remember Me</label>   

                                                </div>

                                                <div class="col-xs-6 form-group pull-right label">

                                                    <label><a style="color:white;" href="forgotpassword.php">Forgot Password</a></label>

                                                </div>

                                                <br> 
                                                <br> 
                                                <br> 


                                                <!-- <div class="panel-heading"> --> 



                                                <div class="col-md-3 col-xs-6">

                                                    <input type="submit" name="submit" value="Login" class=" logingbtns btn btn-outline makeclears btn-lg" />


                                                </div>

                                                <div class="col-md-3 col-xs-6">

                                                    <input type = "submit" name = "Register"  value="Register" class=" logingbtns btn btn-outline makeclears btn-lg"></input>

                                                </div>
                                                <div class="col-md-3 col-xs-12">
                                                    <input type="submit" name="guest" value="Continue as Guest" class=" logingbtns btn btn-outline makeclears btn-lg" />


                                                </div>

                                                

                                                <!-- </div> --> 

                                            </form>
                                            <br><br><br><br>

                                            <div class="text-center"> 
                                            <div id='fb-root'></div>

                                            <a onclick="fb_login();"><img src="https://www.codenameone.com/img/blog/facebook-login-blue.png" width="170px" alt=""></a>


                                              
                                            <!--<fb:login-button scope="public_profile,email,user_friends" data-size="large" data-auto-logout-link="true" onlogin="checkLoginState();" class="logingbtns">
                                            </fb:login-button>-->

                                        </div> 




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

                    <a href="register.php" class="btn btn-outline btn-xl page-scroll">Get Started!</a>

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

                <p>&copy; 2016 Fashioncents. All Rights Reserved.</p>

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
        if(isset($_SESSION['msg']['login-err'])){
            echo '<script type="text/javascript">
            
            document.getElementById("email").value = "' . $_SESSION["email"] . '";

        </script>';
        unset($_SESSION['msg']['login-err']);
        unset($_SESSION['email']);
    }
    ?>






</body>



</html>

<?php 
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-91261806-1', 'auto');
  ga('send', 'pageview');

</script>

<?php //include_once("analyticstracking.php") ?>