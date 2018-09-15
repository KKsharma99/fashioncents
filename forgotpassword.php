<?php

define('INCLUDE_CHECK',true);

require 'connect.php';
require 'functions.php';

ini_set('display errors', 'On');
error_reporting(E_ALL | E_STRICT);

session_name('tzLogin');
// Starting the session

session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks

session_start();

if($_POST['submit']=='submit'){
  $err = '';
  $row = mysql_fetch_assoc(mysql_query("SELECT id, email FROM tz_members WHERE email='{$_POST['emailInput']}'"));
  if($row['email']){
    $passarray=str_split('abcdefghijklmnopqrstuvwxyz0123456789');
    shuffle($passarray);
    $newpass='';
    for( $i = 0; $i<8; $i++) {
      $newpass.=$passarray[i];
    }
    //mysql_fetch_assoc(mysql_query("SET password = '{$_POST['$newpass']}' FROM tz_members WHERE email = '{$_POST['emailInput']}'"));
    //mail('{$_POST['emailInput']}', 'Fashion Cents Password Reset Confirmation', 'Your new password is: $_POST['$emailInput'].\r\nPlease log in and change your password');
    session_destroy();
    header("Location: forgotpasswordconfirm.html");
  }
  else {
    $err="Email not valid";
    $_SESSION['err'] = $err;
    header("Location: forgotpassword.php");
  }

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


    <title>Fashion Cents</title>

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
    <link href="css/new-age.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

 <hr> 
 <div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                          <h3><i class="fa fa-lock fa-4x"></i></h3>
                          <h2 class="text-center">Forgot Password?</h2>
                          <p>We Will Send You a Temporary Password.</p>
                            <div class="panel-body">
                              
                              <form class="form" id="forgottenpasswordform" action="forgotpassword.php" method="post" role="form">
                                <fieldset>
                                  <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <?php
                                                
                                                if($_SESSION['err']) {
                                                    //echo '<div class="err">'.$_SESSION['err'].'</div>';
                                                    echo $_SESSION['err'];
                                                    unset($_SESSION['err']);
                                                }
                                                ?>
                                      <input id="emailInput" placeholder="email address" class="form-control" type="email" oninvalid="setCustomValidity('Please enter a valid email address!')" onchange="try{setCustomValidity('')}catch(e){}" required="">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <input class="btn btn-lg btn-primary btn-block" value="submit" name="submit" type="submit">
                                  </div>
                                </fieldset>
                              </form>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<footer class="bottom">
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




<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Theme JavaScript -->
<script src="js/new-age.min.js"></script> 
<script src="js/navbar.js"></script> 



</body>

</html>
