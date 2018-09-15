<?php
define('INCLUDE_CHECK',true);
require 'functions.php';
ini_set('display_errors','1'); 
error_reporting(E_ALL);
//ini_set('display_errors', 'On');
//error_reporting(E_ALL | E_STRICT);
//session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
$_SESSION['postid']=0;
$_SESSION['moreposts']=true;
unset($_SESSION['lastpostid']);
//session_start();
if(!isset($_SESSION['id']))
{
    // If you are logged in, but you don't have the tzRemember cookie (browser restart)
    // and you have not checked the rememberMe checkbox:
  $_SESSION = array();
  session_destroy();
  header("Location: index.php");
    // Destroy the session
}
if(isset($_GET['logoff']))
{
  $_SESSION = array();
  session_destroy();
  header("Location: index.php");
  exit;
}

?>





<?php include("header.php"); ?> 

<?php include("nav.php"); ?> 

<div class="row text-center"> 
<div class="col-xs-12">

<div class="row text-center"> 
<div class="col-xs-12">

<h1 class="text-center">Report an Error</h1> 
<p class="text-center">Thank you for helping us improve Fashioncents.</p> <br> <br> 

<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSf_tD6N0YkQjjr8VOjx4ne8mnvs76HlT8PirQR6okXq3sL11A/viewform?embedded=true" width="100%" height="1050" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>

</div>
</div>

</div>
</div>

<?php include("footer.php"); ?> 