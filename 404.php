<?php
define('INCLUDE_CHECK',true);
require 'functions.php';
ini_set('display_errors','1'); 
error_reporting(E_ALL);
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


<div class="row">

  <div class="col-md-4 col-md-offset-4">

    <div class="panel panel-default">

      <div class="panel-body">

        <div class="text-center">

          <h3><i class="fa fa-warning fa-4x"></i></h3>

          <h2 class="text-center">404 Error</h2>

          <p>Sorry this page does not exist.<a href="index.php"> Click here</a> to go back to the home page.</p>

        </div>

      </div>

    </div>

  </div>

</div>

<?php include("footer.php"); ?> 