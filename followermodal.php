<!-- FOLLOWERS MODAL --> 
<div class="modal fade" id="followersmodal" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Followers (<?php if($followerquery) { echo mysqli_num_rows($followerquery); } else { echo '0'; } ?>): </b></h4>
            </div>
            <div class="modal-body fourpluscomments">
                <div class="notif"> 
                    <ul class="updates-list">

                        <?php foreach($followers as $row) {
                            echo '<li class="updates">
                                <div class="update-item">
                                    <a class="pull-left" href="account.php?usr='.$row['username'].'">
                                        <img class="img-circle avatar" src="'.$row['profilepic'].'" alt="avatar">
                                    </a>
                                    <div class="updates-body">
                                        <div class="update-heading">

                                            <p>
                                                <span class="user">'.$row['username'].'</span>';
                                                if(in_array($row['followerid'], $viewerfollowids)) { 
                                                    echo '<img src="vendor/custom-icons/circle-check.png" class="pull-right" height="25px">';
                                                } else if($row['followerid'] != $_SESSION['id']) {
                                                    echo '<img src="vendor/custom-icons/circle-plus.png" class="pull-right" height="25px">'; 
                                                }
                                            echo '</p>
                                        </div>

                                    </div>
                                </div>
                            </li>';
                        } ?> 

                            </ul>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- FOLLOWING MODAL -->
        <div class="modal fade" id="followingmodal" role="dialog">
            <div class="modal-dialog modal-sm">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Following (1): </b></h4>
                    </div>
                    <div class="modal-body fourpluscomments">
                        <div class="notif"> 
                    <ul class="updates-list">

                        <?php foreach($following as $row) {
                            echo '<li class="updates">
                                <div class="update-item">
                                    <a class="pull-left" href="account.php?usr='.$row['username'].'">
                                        <img class="img-circle avatar" src="'.$row['profilepic'].'" alt="avatar">
                                    </a>
                                    <div class="updates-body">
                                        <div class="update-heading">

                                            <p>
                                                <span class="user">'.$row['username'].'</span>';
                                                if(in_array($row['userid'], $viewerfollowids)) { 
                                                    echo '<img src="vendor/custom-icons/circle-check.png" class="pull-right" height="25px">';
                                                } else if($row['userid'] != $_SESSION['id']) {
                                                    echo '<img src="vendor/custom-icons/circle-plus.png" class="pull-right" height="25px">'; 
                                                }
                                            echo '</p>
                                        </div>

                                    </div>
                                </div>
                            </li>';
                        } ?> 

                            </ul>
                        </div>  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>