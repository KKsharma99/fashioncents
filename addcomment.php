<?php
define('INCLUDE_CHECK',true);
include('connect.php');
//ini_set('display_errors','1'); 
//error_reporting(E_ALL);

if ($_POST['postid'] && $_POST['uid'] && $_POST['comment']) {
	$addcommentsql = "INSERT INTO tbl_comments (postid, userid, fctime, commenttext) VALUES (" . $_POST['postid'] . ", " . $_POST['uid'] . ", '" . time() . "', '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['comment']) . "')";
	mysqli_query($GLOBALS['sqllink'], $addcommentsql);
	if (mysqli_error($GLOBALS['sqllink']) == "") {
		$usersql = "SELECT username FROM tbl_masterusers WHERE userid = " . $_POST['uid'];
		$user = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'], $usersql));
		?>
		 <li>
          <div class="post-likes-box">
              <a href="account.php?username=<?php echo($user['username']) ?>">
              <span data-toggle="tooltip" title="0 Likes" class="comment-like-count">0
              </span>
              </a>
              <img data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart.png" class="heart-icon comment-like-heart"> 
          </div>

            <p class="post-comment-text">
              <a href="account.php?username=<?php echo($user['username']) ?>"><?php echo($user['username']) ?>
              </a> <?php echo($_POST['comment']) ?>
            </p>

          <div class="post-time-report-box">

               <span class="pull-right comment-date">5m</span>       
              <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 

          </div>

          </li>

		<?php
	}

}
?>