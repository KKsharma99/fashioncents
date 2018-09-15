<?php
define('INCLUDE_CHECK',true);
$disallowguest = true;
require 'sessionsguest.php';
require 'functions.php';
ini_set('display_errors','1'); 
error_reporting(E_ALL);
?>

<?php 
$query = mysqli_query($GLOBALS['sqllink'], "SELECT a.userid as userid,first_name,last_name,username,profilepic,bio,instagram,facebook,blog,twitter,pinterest FROM tbl_masterusers a INNER JOIN tbl_account b ON a.userid = b.userid WHERE a.username = '" . mysqli_escape_string($GLOBALS['sqllink'],$_GET['usr']) . "'");
$info;
if($query) {
    $info = mysqli_fetch_assoc($query);
} else {
    header("Location: index.php");
}

$posts = mysqli_query($GLOBALS['sqllink'],"SELECT postid,description,image_small,posttime,hash,b.userid,username,utype,profilepic FROM tbl_posts a INNER JOIN tbl_masterusers b ON a.userid = b.userid WHERE b.userid = " . $info['userid'] . " ORDER BY posttime DESC");


$saves = mysqli_query($GLOBALS['sqllink'], "SELECT b.postid,description,image_small,posttime,c.userid,username,utype,profilepic FROM tbl_saved_posts a JOIN tbl_posts b ON a.postid = b.postid JOIN tbl_masterusers c ON b.userid = c.userid WHERE a.userid = " . $info['userid'] . " ORDER BY posttime DESC");



$followerquery = mysqli_query($GLOBALS['sqllink'],"SELECT b.userid,followerid,username,profilepic FROM tbl_following a JOIN tbl_masterusers b ON a.followerid = b.userid WHERE a.userid = " . $info['userid']);
$followers = array();
$viewerisfollowing = 1;
if($followerquery) {
    while($row = mysqli_fetch_assoc($followerquery)) {
        if($row['userid'] == $_SESSION['id']) {
            $viewerisfollowing = 2;
        }
        $followers[] = $row;    
    }
}

$followingquery = mysqli_query($GLOBALS['sqllink'],"SELECT b.userid,username,profilepic FROM tbl_following a JOIN tbl_masterusers b ON a.userid = b.userid WHERE a.followerid = " . $info['userid']);
$following = array();
if($followingquery) {
    while($row = mysqli_fetch_assoc($followingquery)) {
        $following[] = $row;    
    }
}

$viewerfollowing = mysqli_query($GLOBALS['sqllink'], "SELECT b.userid FROM tbl_following a JOIN tbl_masterusers b ON a.userid = b.userid WHERE a.followerid = " . $_SESSION['id']);
$viewerfollowids = array();
if($viewerfollowing) {
    while($row = mysqli_fetch_assoc($viewerfollowing)) {
        $viewerfollowids[] = $row['userid'];
    }
}
?>

<div class="row account-card2">
    <div class="col-md-2 col-xs-6 prof-pic-section text-center">
        <img src="<?php echo $info['profilepic']; ?>">
        <br>
        <?php if($_SESSION['id'] != $info['userid']) {
            if($viewerisfollowing == 2) {
                echo '<button type="button" id="followbutton-xs" value=2 class="btn btn-sm btn-default follow-button visible-xs" onclick="follow('.$info['userid'] . ', ' . $_SESSION['id']. ', 2,\''.$_SESSION['username'].'\');">Unfollow
                </button>';
            } else {
                echo '<button type="button" id="followbutton-xs" value=1 class="btn btn-sm btn-default follow-button visible-xs" onclick="follow('.$info['userid'] . ', ' . $_SESSION['id']. ', 1,\''.$_SESSION['username'].'\');">Follow
                </button>';
            }
    } else {
        if(!empty($_SESSION['facebook'])) {
            echo '<fb:login-button scope="public_profile,email,user_friends" data-size="large" data-auto-logout-link="true" onlogin="checkLoginState();">
        </fb:login-button>';
    } else {
     echo '<button type="button" class="btn btn-sm btn-default follow-button visible-xs" onclick = "logout();">Sign Out
 </button>';
} 
} ?>
</div>

<div class="col-md-4 col-xs-6 person-info">
    <a class="gearicon visible-xs text-right" href="accountsettings.php">
        <img src="vendor/custom-icons/settings.png">
    </a> 
    <p class="username"><?php echo $info['username']; ?></p>
    <p class="userbio"><?php echo $info['bio']; ?></p>
    <?php if($_SESSION['id'] != $info['userid']) {
        if($viewerisfollowing == 2) {
            echo '<button type="button" id="followbutton" class="btn btn-sm btn-default follow-button hidden-xs" onclick="follow('.$info['userid'] . ', ' . $_SESSION['id']. ', 2, \''.$_SESSION['username'].'\');">Unfollow
            </button>';
        } else {
            echo '<button type="button" id="followbutton" class="btn btn-sm btn-default follow-button hidden-xs" onclick="follow('.$info['userid'] . ', ' . $_SESSION['id']. ', 1, \''.$_SESSION['username'].'\');">Follow
            </button>';
        }
} else {
    if(!empty($_SESSION['facebook'])) {
        echo '<fb:login-button scope="public_profile,email,user_friends" data-size="large" data-auto-logout-link="true" onlogin="checkLoginState();">
    </fb:login-button>';
} else {
    echo '<button type="button" class="btn btn-sm btn-default follow-button hidden-xs" onclick="logout();">Sign Out
    </button>';
}
} ?>
</div>

<div class="col-md-6 col-xs-12 person-stats">

    <?php if($_SESSION['id'] == $info['userid']) {
        echo '<a class="gearicon hidden-xs" href="accountsettings.php">
        <img src="vendor/custom-icons/settings.png">
    </a>';
} ?> 

<div class="list-section">

    <ul> 

        <li> 
            <a href="account.php?usr=<?php echo $_GET['usr']; ?>">
            <span> 
                <img src="vendor/custom-icons/photo-camera.png" class="stat-icon">
                <span class="stat-count"><b><?php if($posts) { echo mysqli_num_rows($posts); } else { echo '0'; } ?></b></span>
                <span class= "stat-type">Posts</span>
                </span>
                </a>
            </li>

            <li> 
                <span data-toggle="modal" data-target="#followersmodal">
                    <img src="vendor/custom-icons/users.png" class="stat-icon">
                    <span class="stat-count"><b><?php echo count($followers); ?></b></span>
                    <span class= "stat-type">Followers</span>
                </span>
            </li>
            <li>
                <span data-toggle="modal" data-target="#followingmodal">
                    <img src="vendor/custom-icons/users2.png" class="stat-icon">
                    <span class="stat-count"><b><?php echo count($following); ?></b></span>
                    <span class= "stat-type">Following</span>
                </span>
            </li> 

          <?php if($info['instagram'] != null) {
             echo '<li>
             <a target="_blank" href="https://www.instagram.com/'.$info['instagram'].'/"> 
               <img src="vendor/custom-icons/instagram.png" class="stat-icon">
               <span class= "stat-type">'.$info['instagram'].'</span>
           </a>
       </li>';
   } ?>

   <li>
   <a href="account.php?usr=<?php echo $_GET['usr']; ?>&md=saves">
    <span>
        <img src="vendor/custom-icons/bookmark.png" class="stat-icon">
        <span class="stat-count"><b><?php echo mysqli_num_rows($saves); ?></b></span>
        <span class= "stat-type">Saved Posts</span>
    </span>
    </a>
</li> 

<?php if($info['blog'] != null) {
 $blog = $info['blog'];
 if(strlen($blog) > 13) {
    $blog = substr($blog, 0, 13) . "...";
}
echo '<li>
<a target="_blank" href="'.$info['blog'].'"> 
    <img src="vendor/custom-icons/internet.png" class="stat-icon">
    <span class= "stat-type">'.$blog.'</span>
</a>
</li>';
} ?>

<?php if($info['twitter'] != null) {
  echo '<li>
  <a target="_blank" href="https://www.twitter.com/'.$info['twitter'].'"> 
     <img src="vendor/custom-icons/twitter.png" class="stat-icon">
     <span class= "stat-type">'.$info['twitter'].'</span>
 </a>
</li>';
} ?>

<?php if($info['pinterest'] != null) {
    echo '<li>
    <a target="_blank" href="https://www.pinterest.com/'.$info['pinterest'].'"> 
        <img src="vendor/custom-icons/pinterest.png" class="stat-icon">
        <span class= "stat-type">'.$info['pinterest'].'</span>
    </a>
</li>';
} ?>

<?php if($info['facebook'] != null) {
    echo '<li>
    <a target="_blank" href="https://www.facebook.com/'.$info['facebook'].'"> 
        <img src="vendor/custom-icons/facebook.png" class="stat-icon">
        <span class= "stat-type">'.$info['facebook'].'</span>
    </a>
</li>';
} ?> 
</ul>
</div> <!-- End List -->

</div> <!-- End Column -->
</div> <!-- End Row -->

<?php include 'followermodal.php'; ?>
<div id = "posts">
    <?php 
    if(!empty($_GET['md']) && $_GET['md'] == "saves") {
        if($saves) {
            parsefeed($saves);
        }
    } else {
        if($posts) { 
           parsefeed($posts); 
       } 
   }
   ?>
</div>
<!--<div class="row">
    <div class="col-xs-12 text-center">
        <br> <br> 
        <img height="50px" src="https://sharp.ph/wp-content/themes/sharp/images/circle-loading-gif.gif"> 
        <br> 
    </div>
</div>--> 
<?php require 'jsfunctions.php'; 
require 'fbjs.php';?>
<?php include("footer.php"); ?> 