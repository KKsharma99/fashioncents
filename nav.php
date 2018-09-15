<!DOCTYPE html>
<?php
if(!defined('INCLUDE_CHECK')) header("Location: 404.php");
if(strpos($_SERVER['PHP_SELF'],'index.php') !== false) {
  include('sortpanel.php');
}
?>

<?php include "notificationcontent.php"; ?>

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

        <li class="[ hidden-xs ]"><a href="blog.php" style="padding-top:22px">Blog</a></li>
        <li class="[ hidden-xs ]"><a href="faq.php" style="padding-top:22px">FAQ</a></li>
       <!-- <li class="[ hidden-xs ]"><a href="about.php" style="padding-top:22px">About</a></li> --> 
      <!--   <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top:24px; padding-bottom:15px;">
            <img src="vendor/custom-icons/dots-h.png" style="height: 9.5px;"></a>
            <ul class="dropdown-menu">
              <li><a href="outfitcontest.php">Outfit Contest</a></li>
            </ul>
          </li> --> 

        </ul>

        <ul class="[ nav navbar-nav navbar-right ]">

          <!-- RIGHT SIDE DESKTOP SECTION STARTS HERE --> 
          <?php if(strpos($_SERVER['PHP_SELF'],'index.php') !== false) { ?>
          <li class="[ hidden-xs ]">
            <span onclick="openNav()">
              <button style="margin-top:12px" class="btn join-button smooth-button"><b>SORT OUTFITS</b>
              </button>
            </span>
          </li>
          <?php } ?>
          
         <!-- <li class="[ hidden-xs ]"><a href="post.php" style="padding-top:22px">Post Outfit</a></li> --> 

          <!--  <li class="[ hidden-xs ]"><a class="animate" href="post.php"><img height="32px" src="vendor/custom-icons/add.png"></a></li> --> 

          <!--  <li class="[ hidden-xs ]"><a class="animate" href="earnings.php"><img height="32px" src="vendor/custom-icons/money.png"></a></li> --> 


          <li class="[ hidden-xs ]" id="notification_li">

            <a class="animate makerelative" id="notificationLink" href="notifications.php">    <img height="30px" src="vendor/custom-icons/music-1.png"><span id="notification_count" class="badge overlay"><?php if(isset($_SESSION['newnotis']) && $_SESSION['newnotis'] > 0) echo $_SESSION['newnotis'] ?></span></a>

            <div id="notificationContainer">
              <div id="notificationsBody" class="notifications">

                <?php echo notificationList(15); ?> 

              </div>
              <a href="notifications.php"><div id="notificationFooter" onclick="window.location='notifications.php';">See All</div></a>
            </div>

          </li>
          <li class="[ hidden-xs ]"><a class="animate" href="account.php?usr=<?php echo $_SESSION['username'] ?>"><img height="30px" src="vendor/custom-icons/user.png"></a></li>

          <!-- MOBILE SECTION STARTS HERE --> 

          <div class="visible-xs navbar-dropped"> 

            <div class="panel-group">
              <div class="panel panel-default">

              <!--   <a class="animate" href="post.php">
                 <div class="panel-heading">
                  <p class="panel-title">
                    <img class="navbar-dropped-icon" src="vendor/custom-icons/add.png">POST AN OUTFIT
                  </p>
                </div>
              </a> --> 

              <a class="animate" href="notifications.php">
               <div class="panel-heading">
                <p class="panel-title">
                  <img class="navbar-dropped-icon" src="vendor/custom-icons/music-1.png">NOTIFICATIONS
                </p>
              </div>
            </a>

            <a class="animate" href="account.php?usr=<?php echo $_SESSION['username']?>">
             <div class="panel-heading">
              <p class="panel-title">
                <img class="navbar-dropped-icon" src="vendor/custom-icons/user.png">ACCOUNT
              </p>
            </div>
          </a>

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

    <!--   <a class="animate" href="faq.php">
       <div class="panel-heading">
        <p class="panel-title">
          <img class="navbar-dropped-icon" src="vendor/custom-icons/draw.png">About
        </p>
      </div>
    </a> --> 

   <!--  <a class="smooth-button" data-toggle="collapse" href="#collapse3"> 
     <div class="panel-heading">
      <p class="panel-title">
        <img class="navbar-dropped-icon" src="vendor/custom-icons/down-arrow.png">OTHER
      </p>
    </div>
  </a>
  <div id="collapse3" class="panel-collapse collapse text-center">
    <ul class="list-group">
      <li onclick = "location.href = 'dressforless.php';" class="list-group-item">Blog</li>
      <li onclick = "location.href = 'dressforless.php?gender=Male';" class="list-group-item">Outfit Contest</li>
    </ul>
  </div> --> 

</div>
</div> <!-- End Panel Group --> 

</div> <!-- End Navbar Dropped --> 

</ul> <!-- End Unordered List -->


</div> <!-- End Collapse --> 

</div> <!-- End Container --> 

</nav> <!-- End Navbar --> 


<!-- This Code Provides the Space at the Top for All Pages --> 
<div class="container-fluid feedmargin" id="container" id="feedmargin"> 



  <div class="row">

    <div class="col-lg-12 ">

      <div class="space"> 

      </div>

    </div>

  </div> 
