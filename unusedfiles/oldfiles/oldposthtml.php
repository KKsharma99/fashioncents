<p id="<?php echo($post['postid']) ?>"> </p>
<div class="col-lg-10 col-sm-12 smallmargin">

    <div class="panel panel-white post panel-shadow">

        <div class="post-heading">

            <div class="pull-left image">

                <img src="<?php print($user['profilepic']) ?>" class="img-circle avatar" alt="user profile image">

            </div>

            <div class="pull-left meta">

                <div class="titlep h5">

                    <a href="account.php?userid=<?php echo $user['userid'] ?>"><b><?php print($user['first_name'] . " " . $user['last_name']) ?></b></a>

                </div>

                <h6 class="text-muted time"><?php print(nicetime($post['postdate'])) ?></h6>

            </div>

            <div class="pull-right meta">
            <?php if($post['userid'] != $_SESSION['id']) { ?>   
                <button name = "follow<?php print($post['userid'])?>" class="btn btn-sm btn-default stat-item followicon" type="button" onclick = "<?php print("follow(" . $post['userid'] . ");")?>"> <i class="<?php if($following){print("fa fa-check icon");}else{print("fa fa-plus icon");}?>"></i><?php if($following){print(" Following");}else{print(" Follow");}?> </button>
            <?php }
            ?>
            </div>

        </div> 

        <div class="post-description"> 
            <a href="userpost.php?postid=<?php echo $post['postid'] ?>">
            <img class="img-responsive text-center" width="100%" src="img/posts/<?php echo $post['postid'] ?>" alt="test"> </a>

            <h5 class="text-muted time"></h5>

            <div class="stats">
                <!--<a href="home.php?fn=like&id=<?php echo $post[0] ?>" class="btn btn-sm btn-default stat-item">-->
                <a id="like<?php echo $post['postid'] ?>" onclick = 'like(<?php echo $post['postid'] ?>)' class="btn btn-sm btn-default stat-item" style="<?php if(checklike($post['postid'])) echo 'color:blue;'?>">

                    <i class="fa fa-thumbs-up icon "></i><?php print(count($likes)) ?></a>

                    <a id="fav<?php echo $post['postid'] ?>" onclick = 'fav(<?php echo $post['postid'] ?>)' class="btn btn-sm btn-default stat-item" style="<?php if(checkfav($post['postid'])) echo 'color:red;'?>">

                        <i class="fa fa-star icon"></i><?php print(count($favs)) ?></a>

                        <a href="#" class="btn btn-sm btn-default stat-item">

                            <i class="fa fa-share icon"></i>

                        </a>
                        <?php 
                        $detailid = "collapseExample" . $post['postid'];
                        ?>
                        <button aria-controls="collapseExample" aria-expanded=

                        "false" class="btn btn-sm btn-default stat-item" data-target=

                        "#<?php echo $detailid ?>" data-toggle="collapse" type=

                        "button"> <i class="fa fa-info icon"></i>Details</button>

                    </div>

                </div>


                <div class="collapse" id=<?php echo $detailid ?>>

                    <div class="well">

                        <table class="table">

                          <tbody>

                            <?php 
                            foreach($details as $item) {
                                ?>
                                <tr>

                                    <th><?php print($item[1]) ?></th>

                                    <td><?php print($item[2]) ?></td>

                                    <td>$<?php print($item[3]) ?></td>

                                    <th><a href=<?php print($item[4]) ?> target="_blank" >Buy</a></th>

                                </tr>
                                <?php } ?>

                        <!--<tr>
                            <th>Polo</th>
                            <td>Gymboree</td>
                            <td>$12</td>
                            <th><a href="https://amzn.com/B01H5FS9FU" target="_blank">Buy</a></th>
                        </tr>
                        <tr> 
                            <th>Jeans</th>
                            <td>Wallflower</td>
                            <td>$20</td>
                            <th><a href="https://amzn.com/B01H3UREL2" target="_blank" >Buy</a></th>
                        </tr>
                        <tr> 
                            <th>Boots</th>
                            <td>Tuffs</td>
                            <td>$39</td>
                            <th><a href="" target="_blank" >Buy</a></th>
                        </tr> -->

                    </tbody>

                </table>

            </div> 

        </div> 



        <div class="post-footer">

            <div class="input-group"> 

                <input class="form-control" id = "text<?php print($post['postid']) ?>" placeholder="Add a comment" type="text" maxlength="250">

                <span class="input-group-addon">

                    <a onclick='jcomment(<?php print($post['postid']); ?>, <?php print($_SESSION['id']) ?>);'><i class="fa fa-edit"></i></a>
                     

                </span>

            </div>
            <ul class="comments-list <?php if($lastcomment!=-1){print('fourpluscomments');} ?>" id = "commentlist<?php print($post['postid']) ?>">
                <?php
                foreach($comments as $comment){?>
                    <li class="comment" id="<?php print($comment['commentid']) ?>" tag="<?php print($comment['userid'])?>">
                        <a class="pull-left" href="#">
                            <img class="avatar" src="<?php print($comment['profilepic']) ?>" alt="avatar">
                        </a>
                        <div class="comment-body">
                            <div class="comment-heading">
                                <h4 class="user"><?php print($comment['first_name'] . " " . $comment['last_name']) ?></h4>
                                <h5 class="time"><?php print(nicetime($comment['posttime'])) ?></h5>
                            </div>
                            <p><?php print($comment['commenttext']) ?></p>
                        </div>  
                    </li> 
               

                <?php } ?>

            </ul>
            
            <!-- <div class = "text-center"> 
                <button type="button" class="btn btn-sm btn-default">Load More...</button>
            </div> --> 

        </div>

    </div>

</div>