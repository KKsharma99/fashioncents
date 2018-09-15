<?php

if(!defined('INCLUDE_CHECK')) {
	header("Location: 404.php");
	exit();
}


function generalfeed($gender, $utype, $category, $feedtype, $number, $offset) {
  //gender and utype order by recency
  //gender and utype join tbl_masterusers
  //recency order by posttime
  //popular where claus on posttime and order by count of join with tbl_likes and posttime
  //category join category table or get postid and run additional queries
  //featured is just another category
  $sqlstatement = "SELECT";

  if (!empty($category)) {
    
    $categoryidlist = implode(", ", $category);
    $sqlstatement .= " DISTINCT a.postid as postid, b.userid as userid, b.description as description, b.image_small as image_small, b.posttime as posttime, c.username as username, c.utype as utype, c.profilepic as profilepic";
    if ($feedtype >= 5) {
      $sqlstatement .= ", COUNT(d.userid)";
    }
    $sqlstatement .= " FROM tbl_category a INNER JOIN tbl_posts b ON a.postid = b.postid INNER JOIN tbl_masterusers c on b.userid = c.userid";
    if ($feedtype >= 5) {
      $sqlstatement .= " LEFT JOIN tbl_likes d ON b.postid = d.postid";
    }
    $sqlstatement .= " WHERE a.categoryid IN (" . $categoryidlist . ")";
    if ($gender != 0) {
      $sqlstatement .= " AND c.gender = " . $gender;
    }
    if ($utype != 0) {
      $sqlstatement .= " AND c.utype = " . $utype;
    }
    switch ($feedtype) {
      case 3:
        $sqlstatement .= " AND a.categoryid = 0";
      case 1:
        $sqlstatement .= " ORDER BY b.posttime DESC";
        break;
      case 5:
        $sqlstatement .= " AND b.posttime > " . (time() - 604800);
        break;
      case 6:
        $sqlstatement .= " AND b.posttime > " . (time() - 2628000);
        break;
      case 7:
        $sqlstatement .= " AND b.posttime > " . (time() - 31557600);
        break;
    }
    if ($feedtype >= 5) {
      $sqlstatement .= " GROUP BY a.postid, a.categoryid ORDER BY COUNT(d.userid) DESC, b.posttime DESC";
    }
  } else {
    $sqlstatement .= " b.postid as postid, b.userid as userid, b.description as description, b.image_small as image_small, b.posttime as posttime, c.username as username, c.utype as utype, c.profilepic as profilepic";
    if ($feedtype >= 5) {
      $sqlstatement .= ", COUNT(d.userid)";
    }
    if ($feedtype == 3) {
      $sqlstatement .= " FROM tbl_category a INNER JOIN tbl_posts b ON a.postid = b.postid";
    } else {
      $sqlstatement .= " FROM tbl_posts b"; 
    }
    $sqlstatement .= " INNER JOIN tbl_masterusers c on b.userid = c.userid";
    if ($feedtype >= 5) {
      $sqlstatement .= " LEFT JOIN tbl_likes d ON b.postid = d.postid";
    }
    $where = 0;
    if ($gender != 0) {
      $sqlstatement .= " WHERE c.gender = " . $gender;
      $where = 1;
    }
    if ($utype != 0) {
      if ($where) {
        $sqlstatement .= " AND c.utype = " . $utype;
      } else {
        $sqlstatement .= " WHERE c.utype = " . $utype;
        $where = 1;
      }
    }
    switch ($feedtype) {
      case 3:
        $sqlstatement .= " AND a.categoryid = 0";
      case 1:
        $sqlstatement .= " ORDER BY b.posttime DESC";
        break;
      case 5:
        $sqlstatement .= " AND b.posttime > " . (time() - 604800);
        break;
      case 6:
        $sqlstatement .= " AND b.posttime > " . (time() - 2628000);
        break;
      case 7:
        $sqlstatement .= " AND b.posttime > " . (time() - 31557600);
        break;
    }
    if ($feedtype >= 5) {
      $sqlstatement .= " GROUP BY b.postid ORDER BY COUNT(d.userid) DESC, b.posttime DESC";
    }
  }
  if (!empty($number)) {
    $sqlstatement .= " LIMIT " . $number;
  }
  if (!empty($offset)) {
    $sqlstatement .= " OFFSET " . $offset;
  }
  //echo $sqlstatement;
  $sqlresult = mysqli_query($GLOBALS['sqllink'], $sqlstatement);
  parsefeed($sqlresult);
}

function parsefeed($sqlresult) {

	/*$sql = "SELECT postid, userid, description, image_small, posttime FROM tbl_posts ORDER BY posttime DESC LIMIT " . $number;*/
	$rowcounter = 0;
	while ($row = mysqli_fetch_assoc($sqlresult)) {
		if ($rowcounter % 3 == 0) 
			echo '<div class="row">';
		/*$usersql = "SELECT userid, username, utype, profilepic FROM tbl_masterusers WHERE userid = " . $row['userid'];
		$user = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'], $usersql));*/
		$post = $row;
		$details = array();
		$detailsql = "SELECT itemname, brand, merchant, price, image, link FROM tbl_items WHERE postid = " . $post['postid'];
		$detailresult = mysqli_query($GLOBALS['sqllink'], $detailsql);
		while ($detailrow = mysqli_fetch_assoc($detailresult)) {
			array_push($details, $detailrow);
		}
		$commentsql = "SELECT a.commentid as commentid, a.userid as userid, a.fctime as fctime, a.commenttext as commenttext, b.username as username, b.utype as utype FROM tbl_comments a JOIN tbl_masterusers b ON a.userid = b.userid WHERE a.postid = " . $post['postid'] . " LIMIT 3";
		$commentresult = mysqli_query($GLOBALS['sqllink'], $commentsql);
		$comments = array();
		$commentlikes = array();
		$usercommentlikes = array();
		while ($commentrow = mysqli_fetch_assoc($commentresult)) {
			array_push($comments, $commentrow);
      if (!empty($_SESSION['id'])) {
          $usercommentlikesql = "SELECT userid FROM tbl_commentlikes WHERE commentid = " . $commentrow['commentid'] . " AND userid = " . $_SESSION['id'];
          array_push($usercommentlikes, mysqli_num_rows(mysqli_query($GLOBALS['sqllink'], $usercommentlikesql)));
      }
			$sql = "SELECT b.username as username, b.utype as utype, a.userid as userid, a.fctime as fctime FROM tbl_commentlikes a JOIN tbl_masterusers b ON a.userid = b.userid WHERE a.commentid = " . $commentrow['commentid'];
			$commentlikeresult = mysqli_query($GLOBALS['sqllink'], $sql);
			$commentlikearray = array();
			while ($commentlikerow = mysqli_fetch_assoc($commentlikeresult)) {
				array_push($commentlikearray, $commentlikerow);
			}
			array_push($commentlikes, $commentlikearray);
		}
    $commentcountsql = "SELECT commentid FROM tbl_comments WHERE postid = " . $post['postid'];
    $commentcount = mysqli_num_rows(mysqli_query($GLOBALS['sqllink'], $commentcountsql));
		$likes = array();
		$likesql = "SELECT b.username as username, b.utype as utype, a.userid as userid, a.fctime as fctime FROM tbl_likes a JOIN tbl_masterusers b ON a.userid = b.userid WHERE a.postid = " . $post['postid'];
    $likeresult = mysqli_query($GLOBALS['sqllink'], $likesql);
    while ($likerow = mysqli_fetch_assoc($likeresult)) {
      array_push($likes, $likerow);
    }
    if (empty($_SESSION['id'])){
      generateguestpost($post, $details, $comments, $commentlikes, $commentcount, $likes);
    } else {
      $savedsql = "SELECT userid FROM tbl_saved_posts WHERE userid = " . $_SESSION['id'] . " AND postid = " . $row['postid'];
      $saved = mysqli_num_rows(mysqli_query($GLOBALS['sqllink'], $savedsql));
      $userlikesql = "SELECT postid FROM tbl_likes WHERE postid = " . $post['postid'] . " AND userid = " . $_SESSION['id'];
      $userlike = mysqli_num_rows(mysqli_query($GLOBALS['sqllink'], $userlikesql));
      $following = mysqli_num_rows(mysqli_query($GLOBALS['sqllink'], "SELECT followerid FROM tbl_following WHERE followerid = " . $_SESSION['id'] . " AND userid = " . $post['userid']));
      generatepost($post, $details, $following, $comments, $commentlikes, $usercommentlikes, $commentcount, $likes, $userlike, $saved);
    }

		$rowcounter++;
		if ($rowcounter % 3 == 0)
			echo '</div>';
	} 
	if ($rowcounter % 3 != 0)
		echo '</div>';
}

function generatepost($post, $details, $following, $comments, $commentlikes, $usercommentlikes, $commentcount, $likes, $userlike, $saved) {
	?>
	<div id ="post<?php echo($post['postid']) ?>" class="col-lg-4"> 
    <div class="panel panel-white post panel-shadow">

      <div class="post-heading">

        <div class="pull-left image">
          <a href="account.php?username=<?php echo($post['username']) ?>">
            <img src="<?php echo($post['profilepic']) ?>" class="img-circle avatar" alt="img/users/defaultuser.jpg">
          </a>
        </div> <!-- User Avatar --> 

        <div class="pull-left">
          <div class="post-user">
            <a href="account.php?userid=<?php echo($post['username']) ?>"><b><?php echo($post['username']) ?></b></a>
          </div>
        </div> <!-- User Name --> 

        <div class="dropdown">

          <btn name="follow<?php echo($post['userid']) ?>" class="dropdown-toggle" type="button" data-toggle="dropdown"><img data-toggle="tooltip" title="OPTIONS" src="vendor/custom-icons/dots-v.png" class="dots-v pull-right"></btn>

          <ul class="dropdown-menu dropdown-menu-right">
            <li><a onclick='showErrorModal("exp", 405);' data-toggle="modal" data-target="#errorconfim">Share</a></li>
            <li class="dropdown-header">Report</li>
            <li><a onclick='showErrorModal("exp", 405);' data-toggle="modal" data-target="#errorconfim">Explicit Content</a></li>
            <li><a onclick='showErrorModal("har",405);' data-toggle="modal" data-target="#errorconfim">Harassment</a></li>
            <li><a onclick='showErrorModal("copyr",405);' data-toggle="modal" data-target="#errorconfim">Copyright Violation</a></li>
          </ul> <!-- End Dropdown Menu --> 
        </div> <!-- End Dropdown -->
        <?php if ($_SESSION['id'] == $post['userid']) { ?>
              <img data-toggle="tooltip" title="DELETE" id="follow<?php echo($post['postid']) ?>" name="follow<?php echo($post['userid']) ?>" src="vendor/custom-icons/circle-cross.png" class="circle-plus pull-right" onclick = "deletepost(<?php echo($post['postid']); ?>)">
        <?php } else { ?>
        <?php if (!$following) { ?>
        <img data-toggle="tooltip" title="FOLLOW" id="follow<?php echo($post['postid']) ?>" name="follow<?php echo($post['userid']) ?>" src="vendor/custom-icons/circle-plus.png" class="circle-plus pull-right" onclick = "follow(<?php echo($post['userid'] . ", " . $_SESSION['id']); ?>, 1);">
        <?php } else { ?>
        <img data-toggle="tooltip" title="FOLLOW" id="follow<?php echo($post['postid']) ?>" name="follow<?php echo($post['userid']) ?>" src="vendor/custom-icons/circle-check.png" class="circle-plus pull-right" onclick = "follow(<?php echo($post['userid'] . ", " . $_SESSION['id']); ?>, 2);">
        <?php } 
          } ?>
        <!-- nicetime add in -->
        <div class="pull-right">
          <h6 class="text-muted post-time"><?php echo(nicetime($post['posttime'])) ?><!-- nicetime --></h6>
        </div>
      </div> <!-- End Post Heading --> 

      <div class="post-description bottom-padding"> 
        <!--<a href="userpost.php?postid=<?php echo($post['postid']) ?>">
        --><a>
          <?php if($userlike) { ?>
            <img id = "img<?php echo($post['postid'] ) ?>" class="img-responsive text-center" width="100%" src="<?php echo($post['image_small']) ?>" alt="test">
          <?php } else { ?>
            <img id = "img<?php echo($post['postid'] ) ?>"" class="img-responsive text-center" width="100%" src="<?php echo($post['image_small']) ?>" alt="test" ondblclick = "like(<?php echo($post['postid'] . ", 1, " . $_SESSION['id']) ?>)">
          <?php } ?>
          
        </a>

        <div class="new-interact-bar"> 

          <!-- This Script Initializes the Tooltips --> 
          <script> 
            $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip(); 
            });
          </script>
          <!-- End Tooltip Initializing Script -->

 

           <span class="pull-left">
          <?php if($userlike) {?>
              <img  id = "like<?php echo($post['postid']) ?>" data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart2.png" class="emoj-reacts" onclick="like(<?php echo($post['postid'] . ", 2, " . $_SESSION['id']) ?>)">
          <?php } else { ?>
              <img  id = "like<?php echo($post['postid']) ?>" data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart.png" class="emoj-reacts" onclick="like(<?php echo($post['postid'] . ", 1, " . $_SESSION['id']) ?>)">
          <?php } ?>
          
          <div id = "likebox<?php echo($post['postid']) ?>" data-toggle="tooltip" title="<?php echo(count($likes)) ?> Likes" class="btn btn-sm total-reacts-btn"><strong><?php echo(count($likes)) ?></strong></div>

          <!--     <img  data-toggle="tooltip" title="WOW" src="vendor/custom-icons/surprised-inactive.png" class="emoj-reacts">
            <img  data-toggle="tooltip" title="FIRE" src="vendor/custom-icons/fire-active.png" class="emoj-reacts"> -->
          </span> 


          <span class="pull-right"> <!-- Post Option Section -->
            <?php if($saved) { ?>
              <img id = "save<?php echo($post['postid']) ?>" data-toggle="tooltip" title="SAVE OUTFIT" src="vendor/custom-icons/bookmark-active.png" class="post-save-button" onclick = "save(<?php echo($post['postid'] . ", 2, " . $_SESSION['id']) ?>)">
            <?php } else { ?>
              <img id = "save<?php echo($post['postid']) ?>"  data-toggle="tooltip" title="SAVE OUTFIT" src="vendor/custom-icons/bookmark.png" class="post-save-button" onclick = "save(<?php echo($post['postid'] . ", 1, " . $_SESSION['id']) ?>)">
            <?php } ?>
            
          </span> 
        </div>

      </div> <!-- End Post Description --> 

      <div class="post-footer new-post-footer">
        <ul id = "commentlist<?php echo($post['postid']) ?>">

        <?php for ($com = 0; $com < 3 && $com < count($comments); $com++) {
        ?>
          <li>

          <div class="post-likes-box">
              <a href="account.php?username=<?php echo($comments[$com]['username']) ?>">
              <span id = "commentcount<?php echo($comments[$com]['commentid'])?>" data-toggle="tooltip" title="<?php echo(count($commentlikes[$com])) ?> Likes" class="comment-like-count"><?php echo(count($commentlikes[$com])) ?>
              </span>
              </a>
              <?php if ($usercommentlikes[$com]) { ?>
                  <img id = "comment<?php echo($comments[$com]['commentid']) ?>" data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart2.png" class="heart-icon comment-like-heart" onclick = "commentlike(<?php echo($comments[$com]['commentid'] . ', 2, ' . $_SESSION['id']) ?>)">
              <?php } else { ?>
                  <img id = "comment<?php echo($comments[$com]['commentid']) ?>" data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart.png" class="heart-icon comment-like-heart" onclick = "commentlike(<?php echo($comments[$com]['commentid'] . ', 1, ' . $_SESSION['id']) ?>)">
              <?php } ?>
               
          </div>

            <p class="post-comment-text">
              <a href="account.php?username=<?php echo($comments[$com]['username']) ?>"><?php echo($comments[$com]['username']) ?>
              </a> <?php echo($comments[$com]['commenttext']) ?>
            </p>

          <div class="post-time-report-box">

               <span class="pull-right comment-date">5m</span>       
              <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 

          </div>

          </li>
          <?php } ?>
        </ul> 

   
          <input id = "commentbox<?php echo($post['postid']) ?>" type='text' placeholder='Press "Enter" to Comment' onkeydown = "if (event.keyCode==13) { comment(<?php echo($post['postid'] . ', ' . $_SESSION['id']) ?>) }"></input>
        <?php if ($commentcount > 3) { ?>
          <div class="text-center">
            <a href="#">
            <span class="view-previous-comments" style="font-size: 10px;">View Previous Comments(<?php echo($commentcount - 3) ?>) 
            </span>
            </a> 
          </div>
        <?php } ?>

      </div> <!-- End Post Footer --> 
      

      <div class="dflpost">
        <div class="dflpost-footer">
          <ul class="products-list">

         <!-- This Script Initializes the Tooltips --> 
          <script> 
            $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip(); 
            });
          </script>
          <!-- End Tooltip Initializing Script -->

              <?php for($item = 0; $item < count($details) && $item < 4; $item++) { ?>
           	  	<li class="product-item">
                <a class="pull-left" target="_blank" href="<?php echo($details[$item]['link']) ?>">
                  <img class="img-rounded avatar" src="<?php echo($details[$item]['image']) ?>" alt="item">
                </a>
                <a class="pull-right" target="_blank" href="<?php echo($details[$item]['link']) ?>">
                  <button type="button" class="btn btn-sm btn-success buy-button"><?php echo($details[$item]['price']) ?></button>
                </a>
                <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                  <div class="product-item-details">
                    <p class="item-name"><?php echo($details[$item]['itemname']) ?></p>
                    <p class="item-brand"><?php echo($details[$item]['brand']) ?></p>
                    <p class="item-merchant"><?php echo($details[$item]['merchant']) ?></p>
                  </div>
                </div>
              </li>
           	  <?php } 
              if (count($details) > 4) { ?>
            <div class="text-center">
              <img aria-controls="addComment" aria-expanded="false" data-target="#moreItems" data-toggle="collapse"
              data-toggle="tooltip" title="COMMENT" src="vendor/custom-icons/dots-h.png" class="more-items-dots">
            </div> 

            <span class="collapse" id="moreItems"> <!-- Start More Items Hidden Section -->
           	  <?php for($item = 4; $item < count($details); $item++) { ?>
           	  	<li class="product-item">
                <a class="pull-left" target="_blank" href="<?php echo($details[$item]['sqllink']) ?>">
                  <img class="img-rounded avatar" src="<?php echo($details[$item]['image']) ?>" alt="item">
                </a>
                <a class="pull-right" target="_blank" href="<?php echo($details[$item]['sqllink']) ?>">
                  <button type="button" class="btn btn-sm btn-success buy-button"><?php echo($details[$item]['price']) ?></button>
                </a>
                <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                  <div class="product-item-details">
                    <p class="item-name"><?php echo($details[$item]['itemname']) ?></p>
                    <p class="item-brand"><?php echo($details[$item]['brand']) ?></p>
                    <p class="item-merchant"><?php echo($details[$item]['merchant']) ?></p>
                  </div>
                </div>
              </li>
           	  <?php } ?>
            </span> <!-- End More Items Hidden Section -->
            <?php } ?>          
          </ul>
        </div> <!-- End DFL post footer --> 
      </div> <!-- End DFL Post --> 

    </div> <!-- End Post -->
  </div> <!-- End Column --> 
<?php } 

function generateguestpost($post, $details, $comments, $commentlikes, $commentcount, $likes) { ?>

  <div id ="post<?php echo($post['postid']) ?>" class="col-lg-4"> 
    <div class="panel panel-white post panel-shadow">

      <div class="post-heading">

        <div class="pull-left image">
          <a data-toggle="modal" data-target="#guestprompt">
            <img src="<?php echo($post['profilepic']) ?>" class="img-circle avatar" alt="img/users/defaultuser.jpg">
          </a>
        </div> <!-- User Avatar --> 

        <div class="pull-left">
          <div class="post-user">
            <a data-toggle="modal" data-target="#guestprompt"><b><?php echo($post['username']) ?></b></a>
          </div>
        </div> <!-- User Name --> 

        <div class="dropdown">

          <btn name="follow<?php echo($post['userid']) ?>" class="dropdown-toggle" type="button" data-toggle="dropdown"><img data-toggle="tooltip" title="OPTIONS" src="vendor/custom-icons/dots-v.png" class="dots-v pull-right"></btn>

          <ul class="dropdown-menu dropdown-menu-right">
            <li><a onclick='showErrorModal("exp", 405);' data-toggle="modal" data-target="#errorconfim">Share</a></li>
            <li class="dropdown-header">Report</li>
            <li><a onclick='showErrorModal("exp", 405);' data-toggle="modal" data-target="#errorconfim">Explicit Content</a></li>
            <li><a onclick='showErrorModal("har",405);' data-toggle="modal" data-target="#errorconfim">Harassment</a></li>
            <li><a onclick='showErrorModal("copyr",405);' data-toggle="modal" data-target="#errorconfim">Copyright Violation</a></li>
          </ul> <!-- End Dropdown Menu --> 
        </div> <!-- End Dropdown -->
        <a  data-toggle="modal" data-target="#guestprompt">
        <img data-toggle="tooltip" title="FOLLOW" id="follow<?php echo($post['postid']) ?>" name="follow<?php echo($post['userid']) ?>" src="vendor/custom-icons/circle-check.png" class="circle-plus pull-right">
        </a>
        <!-- nicetime add in -->
        <div class="pull-right">
          <h6 class="text-muted post-time"><?php echo(nicetime($post['posttime'])) ?><!-- nicetime --></h6>
        </div>
      </div> <!-- End Post Heading --> 

      <div class="post-description bottom-padding"> 
        <!--<a href="userpost.php?postid=<?php echo($post['postid']) ?>">
        --><a  data-toggle="modal" data-target="#guestprompt">
            <img id = "img<?php echo($post['postid'] ) ?>"" class="img-responsive text-center" width="100%" src="<?php echo($post['image_small']) ?>" alt="test">

          
        </a>

        <div class="new-interact-bar"> 

          <!-- This Script Initializes the Tooltips --> 
          <script> 
            $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip(); 
            });
          </script>
          <!-- End Tooltip Initializing Script -->

 

           <span class="pull-left">
            <a  data-toggle="modal" data-target="#guestprompt">
              <img  id = "like<?php echo($post['postid']) ?>" data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart.png" class="emoj-reacts">
            </a>
          <div id = "likebox<?php echo($post['postid']) ?>" data-toggle="tooltip" title="<?php echo(count($likes)) ?> Likes" class="btn btn-sm total-reacts-btn"><strong><?php echo(count($likes)) ?></strong></div>

          <!--     <img  data-toggle="tooltip" title="WOW" src="vendor/custom-icons/surprised-inactive.png" class="emoj-reacts">
            <img  data-toggle="tooltip" title="FIRE" src="vendor/custom-icons/fire-active.png" class="emoj-reacts"> -->
          </span> 


          <span class="pull-right"> <!-- Post Option Section -->
            <a  data-toggle="modal" data-target="#guestprompt">
              <img id = "save<?php echo($post['postid']) ?>"  data-toggle="tooltip" title="SAVE OUTFIT" src="vendor/custom-icons/bookmark.png" class="post-save-button">
            </a>
          </span> 
        </div>

      </div> <!-- End Post Description --> 

      <div class="post-footer new-post-footer">
        <ul id = "commentlist<?php echo($post['postid']) ?>">

        <?php for ($com = 0; $com < 3 && $com < count($comments); $com++) {
        ?>
          <li>

          <div class="post-likes-box">
              <a  data-toggle="modal" data-target="#guestprompt">
              <span id = "commentcount<?php echo($comments[$com]['commentid'])?>" data-toggle="tooltip" title="<?php echo(count($commentlikes[$com])) ?> Likes" class="comment-like-count"><?php echo(count($commentlikes[$com])) ?>
              </span>
              </a>
              <a  data-toggle="modal" data-target="#guestprompt">
                  <img id = "comment<?php echo($comments[$com]['commentid']) ?>" data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart.png" class="heart-icon comment-like-heart">
              </a>
               
          </div>

            <p class="post-comment-text">
              <a  data-toggle="modal" data-target="#guestprompt"><?php echo($comments[$com]['username']) ?>
              </a> <?php echo($comments[$com]['commenttext']) ?>
            </p>

          <div class="post-time-report-box">

               <span class="pull-right comment-date">5m</span>       
              <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 

          </div>

          </li>
          <?php } ?>
        </ul> 

   
          <a  data-toggle="modal" data-target="#guestprompt"><input id = "commentbox<?php echo($post['postid']) ?>" type='text' placeholder='Press "Enter" to Comment' ></input></a>
        <?php if ($commentcount > 3) { ?>
          <div class="text-center">
            <a  data-toggle="modal" data-target="#guestprompt">
            <span class="view-previous-comments" style="font-size: 10px;">View Previous Comments(<?php echo($commentcount - 3) ?>) 
            </span>
            </a> 
          </div>
        <?php } ?>

      </div> <!-- End Post Footer --> 
      

      <div class="dflpost">
        <div class="dflpost-footer">
          <ul class="products-list">

         <!-- This Script Initializes the Tooltips --> 
          <script> 
            $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip(); 
            });
          </script>
          <!-- End Tooltip Initializing Script -->

              <?php for($item = 0; $item < count($details) && $item < 4; $item++) { ?>
                <li class="product-item">
                <a class="pull-left" target="_blank" href="<?php echo($details[$item]['link']) ?>">
                  <img class="img-rounded avatar" src="<?php echo($details[$item]['image']) ?>" alt="item">
                </a>
                <a class="pull-right" target="_blank" href="<?php echo($details[$item]['link']) ?>">
                  <button type="button" class="btn btn-sm btn-success buy-button"><?php echo($details[$item]['price']) ?></button>
                </a>
                <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                  <div class="product-item-details">
                    <p class="item-name"><?php echo($details[$item]['itemname']) ?></p>
                    <p class="item-brand"><?php echo($details[$item]['brand']) ?></p>
                    <p class="item-merchant"><?php echo($details[$item]['merchant']) ?></p>
                  </div>
                </div>
              </li>
              <?php } 
              if (count($details) > 4) { ?>
            <div class="text-center">
              <img aria-controls="addComment" aria-expanded="false" data-target="#moreItems" data-toggle="collapse"
              data-toggle="tooltip" title="COMMENT" src="vendor/custom-icons/dots-h.png" class="more-items-dots">
            </div> 

            <span class="collapse" id="moreItems"> <!-- Start More Items Hidden Section -->
              <?php for($item = 4; $item < count($details); $item++) { ?>
                <li class="product-item">
                <a class="pull-left" target="_blank" href="<?php echo($details[$item]['link']) ?>">
                  <img class="img-rounded avatar" src="<?php echo($details[$item]['image']) ?>" alt="item">
                </a>
                <a class="pull-right" target="_blank" href="<?php echo($details[$item]['sqllink']) ?>">
                  <button type="button" class="btn btn-sm btn-success buy-button"><?php echo($details[$item]['price']) ?></button>
                </a>
                <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                  <div class="product-item-details">
                    <p class="item-name"><?php echo($details[$item]['itemname']) ?></p>
                    <p class="item-brand"><?php echo($details[$item]['brand']) ?></p>
                    <p class="item-merchant"><?php echo($details[$item]['merchant']) ?></p>
                  </div>
                </div>
              </li>
              <?php } ?>
            </span> <!-- End More Items Hidden Section -->
            <?php } ?>          
          </ul>
        </div> <!-- End DFL post footer --> 
      </div> <!-- End DFL Post --> 

    </div> <!-- End Post -->
  </div> <!-- End Column --> 



<?php } ?>