<?php
if(!defined('INCLUDE_CHECK')) header("Location: 404.php");
//require 'connect.php';
//session_start();
/*$db_host        = 'localhost';
$db_user        = 'root';
$db_pass        = 'g5mGfqMX';
$db_database    = 'fashioncentsbeta'; */
/* Server
$db_host        = 'sql308.byethost22.com';
$db_user        = 'b22_19030898';
$db_pass        = 'F4shion$ents';
$db_database    = 'b22_19030898_fashioncents'; 
*/
/* End config */
//$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
//$_SESSION['link'] = mysqli_connect($db_host,$db_user,$db_pass,$db_database);
// Check connection
//if (mysqli_connect_errno())
//{
//  echo "Failed to connect to MySQL: " . mysqli_connect_error();
//}
if(!empty($_SESSION['id'])) {
    $query = "SELECT notificationid,b.username,locationid,type,checked,fctime,profilepic FROM tbl_notifications a JOIN tbl_masterusers b ON a.username = b.username WHERE a.userid = " . $_SESSION['id'] . " ORDER BY fctime DESC";
    $result = mysqli_query($GLOBALS['sqllink'], $query);
    $_SESSION['noti'] = array();
    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
            $_SESSION['noti'][] = $row;
        }
    }

    $newcount = 0;
    if(isset($_SESSION['noti'])) {
        foreach($_SESSION['noti'] as $notifications) {
            if($notifications['checked'] == "0") {
                $newcount++;
            }
        }
    }

    $_SESSION['newnotis'] = $newcount;
}


function notificationList($number) {
    ?>
    <div class="notif"> 
        <ul class="updates-list">

            <?php if(isset($_SESSION['noti']) && count($_SESSION['noti']) > 0) { 

                for($i = 0; $i < count($_SESSION['noti']) && $i < $number; $i++) {
                    $notification = $_SESSION['noti'][$i]; 
                    mysqli_query($GLOBALS['sqllink'], "UPDATE tbl_notifications SET checked = true WHERE notificationid = ".$notification['notificationid']);
                    ?>

                    <li class="updates">
                        <div class="update-item">
                            <a class="pull-left" href="<?php if($notification['username'] != null) echo 'account.php?usr='.$notification['username'] ?>">
                                <?php if($notification['username'] != null) { ?>
                                <img class="img-circle avatar" src="<?php echo $notification['profilepic']; ?>" onclick="window.location='<?php if($notification['username'] != null) echo 'account.php?usr='.$notification['username']?>';" alt="avatar">
                                <?php } ?>
                            </a>
                            <div class="updates-body">
                                <div class="update-heading">
                                    <h5 class="time"><?php echo(nicetime($notification['fctime'])) ?></h5>
                                    <?php if($notification['type'] == "0") { ?>
                                        <p><a href="account.php?usr=<?php echo $notification['username'] ?>"><span class="user" onclick="window.location='<?php if($notification['username'] != null) echo 'account.php?usr='.$notification['username']?>';"><?php echo $notification['username'] ?></span></a> requested to follow you.                           
                                        &nbsp <img src="vendor/custom-icons/circle-check.png" style="height:17px;"> &nbsp 
                                        <img src="vendor/custom-icons/circle-cross.png" style="height:17px;"> </p>  
                                    <?php } else if($notification['type'] == "1") { ?>
                                        <p><a href="account.php?usr=<?php echo $notification['username'] ?>"><span class="user" onclick="window.location='<?php if($notification['username'] != null) echo 'account.php?usr='.$notification['username']?>';"><?php echo $notification['username'] ?></span></a> is now following you.<p>
                                    <?php } else if($notification['type'] == "2") { ?>
                                        <p><a href="account.php?usr=<?php echo $notification['username'] ?>"><span class="user" onclick="window.location='<?php if($notification['username'] != null) echo 'account.php?usr='.$notification['username']?>';"><?php echo $notification['username'] ?></span></a> is no longer following you.<p>
                                    <?php } else if($notification['type'] == "3") { ?>
                                        <p><a href="account.php?usr=<?php echo $notification['username'] ?>"><span class="user" onclick="window.location='<?php if($notification['username'] != null) echo 'account.php?usr='.$notification['username']?>';"><?php echo $notification['username'] ?></span></a> <a href="<?php if($notification['locationid'] != null) echo 'userpost.php?postid='.$notification['locationid'] ?>" onclick="window.location='<?php if($notification['locationid'] != null) echo 'userpost.php?postid='.$notification['locationid']?>';"> has liked one of your posts!</a><p>
                                    <?php } else if($notification['type'] == "4") { ?>
                                        <p><a href="account.php?usr=<?php echo $notification['username'] ?>"><span class="user" onclick="window.location='<?php if($notification['username'] != null) echo 'account.php?usr='.$notification['username']?>';"><?php echo $notification['username'] ?></span></a> <a href="<?php if($notification['locationid'] != null) echo 'userpost.php?postid='.$notification['locationid'] ?>" onclick="window.location='<?php if($notification['locationid'] != null) echo 'userpost.php?postid='.$notification['locationid']?>';">has liked one of your comments!</a><p>
                                    <?php } else if($notification['type'] == "5") { ?>
                                        <p><a href="account.php?usr=<?php echo $notification['username'] ?>"><span class="user" onclick="window.location='<?php if($notification['username'] != null) echo 'account.php?usr='.$notification['username']?>';"><?php echo $notification['username'] ?></span></a> <a href="<?php if($notification['locationid'] != null) echo 'userpost.php?postid='.$notification['locationid'] ?>" onclick="window.location='<?php if($notification['locationid'] != null) echo 'userpost.php?postid='.$notification['locationid']?>';">has commented on one of your posts!</a><p>
                                    <?php } ?>

                                    <div class="text-center">

                                    </div>

                                </div>

                            </div>
                        </div>
                    </li>
                <?php }
            } else { ?>
                <p> You have no new notifications. </p>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
<!--        

            <li class="updates">
            <div class="update-item">
                <a class="pull-left" href="#">
                    <img class="img-circle avatar" src="img/users/2.jpg" alt="avatar">
                </a>
                <div class="updates-body">
                    <div class="update-heading">
                        <h5 class="time">5m</h5>
                        <p><span class="user">Kimberly Dong</span> commented on your post.</p>
                    </div>
                    
                </div>
            </div>
            </li>



            <li class="updates">
            <div class="update-item">
                <a class="pull-left" href="#">
                    <img class="img-circle avatar" src="img/users/7.jpg" alt="avatar">
                </a>
                <div class="updates-body">
                    <div class="update-heading">
                        <h5 class="time">8m</h5>
                        <p><span class="user">Priyanka Vattury</span> favorited your post.</p>
                    </div>
                </div>
            </div>
            </li> 
            <li class="updates">
            <div class="update-item">
                <a class="pull-left" href="#">
                    <img class="img-circle avatar" src="img/users/3.jpg" alt="avatar">
                </a>
                <div class="updates-body">
                    <div class="update-heading">
                    <div class="update-heading">
                        <h5 class="time">11m</h5>
                        <p><span class="user">Jeremey Perkins</span> requested to follow you.</p>
                    </div>
                </div>
            </div>
            </li>

            <li class="updates">
            <div class="update-item">
                <a class="pull-left" href="#">
                    <img class="img-circle avatar" src="img/users/1.jpg" alt="avatar">
                </a>
                <div class="updates-body">
                    <div class="update-heading">
                        <h5 class="time">5m</h5>
                        <p><span class="user">Gavino Free</span> liked your post.</p>
                    </div>
                    
                </div>
            </div>
            </li>

            <li class="updates">
            <div class="update-item">
                <a class="pull-left" href="#">
                    <img class="img-circle avatar" src="img/users/2.jpg" alt="avatar">
                </a>
                <div class="updates-body">
                    <div class="update-heading">
                        <h5 class="time">5m</h5>
                        <p><span class="user">Kimberly Dong</span> commented on your post.</p>
                    </div>
                    
                </div>
            </div>
            </li>

            <li class="updates">
            <div class="update-item">
                <a class="pull-left" href="#">
                    <img class="img-circle avatar" src="img/users/7.jpg" alt="avatar">
                </a>
                <div class="updates-body">
                    <div class="update-heading">
                        <h5 class="time">8m</h5>
                        <p><span class="user">Priyanka Vattury</span> favorited your post.</p>
                    </div>
                </div>
            </div>
            </li> 
            <li class="updates">
            <div class="update-item">
                <a class="pull-left" href="#">
                    <img class="img-circle avatar" src="img/users/3.jpg" alt="avatar">
                </a>
                <div class="updates-body">
                    <div class="update-heading">
                    <div class="update-heading">
                        <h5 class="time">11m</h5>
                        <p><span class="user">Jeremey Perkins</span> requested to follow you.</p>
                    </div>
                </div>
            </div>
            </li>

           
        </ul>
    </div>
-->
