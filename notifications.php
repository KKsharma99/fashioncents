<?php
define('INCLUDE_CHECK',true);
$disallowguest = true;
include 'sessionsguest.php';
?>
<div class="row text-center"> 
<div class="col-xs-12">

<h2>Notifications</h2> <br> 

</div>
</div>


<div class="row text-center"> 
<div class="col-lg-6 col-lg-offset-3 col-md-4 col-md-offset-4">

<?php if(!isset($_GET['page'])) {
  $_GET['page'] = 1;
}
?>

<?php notificationList(10, 10 * ($_GET['page']-1)); ?> 


</div>
</div>

<div class="row text-center"> 
<div class="col-xs-12">

<ul class="pagination">
  <li <?php if($_GET['page'] == 1) { echo 'class="active"'; }?>><a href="notifications.php?page=1">1</a></li>
  <?php if(count($_SESSION['noti']) > 10) { 
    if($_GET['page'] == 2) {
      echo '<li class="active"><a href="notifications.php?page=2">2</a></li>';
    } else {
      echo '<li><a href="notifications.php?page=2">2</a></li>';
    }
  }
  if(count($_SESSION['noti']) > 20) {
    if($_GET['page'] == 3) {
      echo '<li class="active"><a href="notifications.php?page=3">3</a></li>';
    } else {
      echo '<li><a href="notifications.php?page=3">3</a></li>';
    }
  }
  if(count($_SESSION['noti']) > 30) {
  if($_GET['page'] == 4) {
      echo '<li class="active"><a href="notifications.php?page=4">4</a></li>';
    } else {
      echo '<li><a href="notifications.php?page=4">4</a></li>';
    }
  }
  if(count($_SESSION['noti']) > 40) {
    if($_GET['page'] == 5) {
      echo '<li class="active"><a href="notifications.php?page=5">5</a></li>';
    } else {
      echo '<li><a href="notifications.php?page=5">5</a></li>';
    }
    } ?>
</ul>

</div>
</div>

<?php include("footer.php"); ?> 