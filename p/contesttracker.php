<?php 
define('INCLUDE_CHECK',true);
include "../connect.php"; ?>
Loading table...
<table style="width:100%">
<tr>
  <th><strong>Link ID</strong></th>
  <th><strong>Total Clicks</strong></th> 
  <th><strong>Number of Signups</strong></th>
</tr>
<?php 
	$query = mysqli_query($link, "SELECT trackerid,totalclicks,signups,creation FROM contest_tracker WHERE 1");
	if($query) {
	while($row = mysqli_fetch_assoc($query)) { 
		//$row2 = mysqli_fetch_assoc(mysqli_query($link, "SELECT hash FROM tbl_outfitcontest WHERE userid = " . $row['userid'])); ?>
  <tr>
    <td><center><?php echo $row['trackerid']; ?></center></td>
    <td><center><?php echo $row['totalclicks']; ?></center></td> 
    <td><center><?php echo $row['signups']; ?></center></td>
  </tr>

	<?php } ?>
</table>
<?php
} else { ?>
No trackers found.
<? }
?>