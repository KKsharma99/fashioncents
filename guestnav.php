<!DOCTYPE html>
<?php
ob_start();
if(!defined('INCLUDE_CHECK')) header("Location: 404.php");?>

<?php include 'fbjs.php'; ?>
<?php include "notificationcontent.php"; ?>
<?php include "sortpanel.php"; ?>
<?php include "loginmodal.php"; ?>
<?php include "registermodal.php"; ?>
<script type="text/javascript" >
  $(document).ready(function()
  {
    $("#notificationLink").click(function()
    {
      $("#notificationContainer").fadeToggle(300);
      $("#notification_count").fadeOut("slow");
      return false;
    });

//Document Click hiding the popup 
$(document).click(function()
{
  $("#notificationContainer").hide();
});

//Popup on click
$("#notificationContainer").click(function()
{
  return false;
});

});
</script>

<nav class="[ navbar navbar-fixed-top ][ navbar-bootsnipp animate ]" role="navigation">

  <div class="[ container ]">

    <!-- Brand and toggle get grouped for better mobile display -->

    <div class="[ navbar-header ]">

      <button type="button" class="[ navbar-toggle ]" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

        <span class="[ sr-only ]">Toggle navigation</span>

        <span class="[ icon-bar ]"></span>

        <span class="[ icon-bar ]"></span>

        <span class="[ icon-bar ]"></span>

      </button>

      <div class="[ animbrand ]">

        <a class="[ navbar-brand ][ animate ]" href="index.php"><img class="logo" src="img/Fashioncents.png" alt="Fashioncents Logo"></a>

      </div>

    </div>


    <div class="[ collapse navbar-collapse ]" id="bs-example-navbar-collapse-1">

      <!-- LEFT SIDE DESKTOP SECTION STARTS HERE --> 
      <ul class="[ nav navbar-nav navbar-left hidden-xs ]">

        <li><a href="blog.php" style="padding-top:22px">Blog</a></li>
        <li><a href="faq.php" style="padding-top:22px">FAQ</a></li>
      <!--   <li><a href="about.php" style="padding-top:22px">About</a></li> -->
       <!--  <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top:24px; padding-bottom:15px;">
            <img src="vendor/custom-icons/dots-h.png" style="height: 9.5px;"></a>
            <ul class="dropdown-menu">
              <li><a href="outfitcontest.php">Outfit Contest</a></li>
            </ul>
          </li> --> 

        </ul>

        <ul class="[ nav navbar-nav navbar-right ]">

          <!-- RIGHT SIDE DESKTOP SECTION STARTS HERE --> 

          <li class="[ hidden-xs ]">
            <span onclick="openNav()">
              <button style="margin-top:17px" class="btn loginbutton smooth-button"><b>SORT OUTFITS</b>
              </button>
            </span>
          </li>

          <li class="[ hidden-xs ]">
            <span href="#" data-toggle="modal" data-target="#login-modal">
              <button class="btn loginbutton smooth-button">LOGIN</button>
            </span>
          </li>

          <li class="[ hidden-xs ]">
            <span href="#" data-toggle="modal" data-target="#register-modal">
              <button class="btn join-button smooth-button"><b>JOIN</b>
              </button>
            </span>
          </li>

          <!-- MOBILE SECTION STARTS HERE --> 

          <div class="visible-xs navbar-dropped"> 

          <!--  <a class="animate" data-toggle="modal" data-target="#login-modal">
             <div class="panel-heading">
              <p class="panel-title">
                <img class="navbar-dropped-icon" src="vendor/custom-icons/user.png">LOGIN
              </p>
            </div>
          </a>

          <a class="animate" data-toggle="modal" data-target="#register-modal">
           <div class="panel-heading">
            <p class="panel-title">
              <img class="navbar-dropped-icon" src="vendor/custom-icons/circle-plus.png">REGISTER
            </p>
          </div>
        </a>

          <a class="animate" onclick="openNav()" class="[ navbar-toggle ]" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
           <div class="panel-heading">
            <p class="panel-title">
              <img class="navbar-dropped-icon" src="vendor/custom-icons/funnel.png">SORT OUTFITS
            </p>
          </div>
        </a> --> 

            <a class="animate" href="blog.php">
             <div class="panel-heading">
              <p class="panel-title">
                <img class="navbar-dropped-icon" src="vendor/custom-icons/draw.png">BLOG
              </p>
            </div>
          </a>


            <a class="animate" href="faq.php">
             <div class="panel-heading">
              <p class="panel-title">
                <img class="navbar-dropped-icon" src="vendor/custom-icons/draw.png">FAQ
              </p>
            </div>
          </a>


     <!--    <a class="animate" href="about.php">
       <div class="panel-heading">
        <p class="panel-title">
          <img class="navbar-dropped-icon" src="vendor/custom-icons/draw.png">About
        </p>
      </div>
    </a> --> 

    <!--   <a class="smooth-button" data-toggle="collapse" href="#collapse3"> 
       <div class="panel-heading">
        <p class="panel-title">
          <img class="navbar-dropped-icon" src="vendor/custom-icons/down-arrow.png">OTHER
        </p>
      </div>
    </a>
    <div id="collapse3" class="panel-collapse collapse text-center">
      <ul class="list-group">
        <li onclick = "location.href = 'dressforless.php';" class="list-group-item">Blog</li>
      </ul>
    </div> --> 

  </div>
</div> <!-- End Panel Group --> 

</div> <!-- End  Nav Bar Dropped --> 


</ul> <!-- End Unordered List -->


</div> <!-- End Collapse --> 

</div> <!-- End Container --> 

</nav> <!-- End Navbar --> 


<!-- This Code Provides the Space at the Top for All Pages --> 
<div class="container-fluid feedmargin" id="container"> 



  <div class="row">

    <div class="col-lg-12 ">

      <div class="space"> 

      </div>

    </div>

  </div> 
