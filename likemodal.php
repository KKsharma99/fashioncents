<!-- Likes Modal -->
<div class="modal fade" id="likesmodal<?php print($post['postid']); ?>" role="dialog">
 <div class="modal-dialog modal-sm">

   <!-- Modal content-->
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><b>Likes (<?php echo count($likes) ?>): </b></h4>
   </div>
   <div class="modal-body fourpluscomments">
       <div class="notif"> 
        <ul class="updates-list">
            <?php 
            $query = "SELECT DISTINCT a.userid, a.fctime, b.username, b.profilepic FROM tbl_likes a LEFT JOIN tbl_masterusers b ON a.userid=b.userid WHERE a.postid = " . $post['postid'] . " ORDER BY a.fctime DESC";
            $result = mysqli_query($GLOBALS['sqllink'], $query);
            if($result) {
                while($row=mysqli_fetch_assoc($result)) {
                    ?>
                    <li class="updates">
                        <div class="update-item">
                            <a class="pull-left" href="account.php?userid=<?php print($row['userid']);?>">
                                <img class="img-circle avatar" src="<?php print($row['profilepic']); ?>?<?=Date('U')?>" alt="avatar">
                            </a>
                            <div class="updates-body">
                                <div class="update-heading">
                                    <h5 class="time"><?php echo(nicetime($row['fctime'])) ?></h5>
                                    <a class="pull-left" href="account.php?usr=<?php print($row['username']);?>">

                                        <p><span class="user"><?php print($row['username']);?></span></p>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </li>
                    <?php }
                }?>

            </ul>
        </div> 
    </div>
    <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
</div>

</div>
</div>