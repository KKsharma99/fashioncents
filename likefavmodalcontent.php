	<div class="notif"> 
		<ul class="updates-list">
			<?php 
				$query = "SELECT DISTINCT a.userid, a.postdate, b.first_name, b.last_name, b.profilepic FROM " . $table . " a LEFT JOIN tbl_users b ON a.userid=b.userid WHERE a.postid = " . $post['postid'] . " ORDER BY a.postdate DESC";
			$result = mysqli_query($_SESSION['link'], $query);
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
									<h5 class="time"><?php print(nicetime($row['postdate'])); ?></h5>
																<a class="pull-left" href="account.php?userid=<?php print($row['userid']);?>">

									<p><span class="user"><?php print($row['first_name'] . " " . $row['last_name']);?></span></p>
									</a>
								</div>

							</div>
						</div>
					</li>
					<?php }
				}?>

			</ul>
		</div>
