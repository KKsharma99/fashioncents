<?php 
define('INCLUDE_CHECK',true);
include "../connect.php"; ?>
Loading table...
<?php
$query = mysqli_query($link, "SELECT DISTINCT userid FROM tbl_outfitcontest WHERE 1");
$ids = array();
while($row = mysqli_fetch_assoc($query)) {
	$ids[] = $row['userid'];
}

if($ids) { ?>
	<table style="width:100%">
  <tr>
    <th><strong>First Name</strong></th>
    <th><strong>Last Name</strong></th> 
    <th><strong>Email</strong></th>
    <th><strong>Link</strong></th>
  </tr>
<?php 
	$query = mysqli_query($link, "SELECT userid,first_name,last_name,email FROM tbl_users WHERE userid IN ('" . implode("','", $ids) . "')");
	
	while($row = mysqli_fetch_assoc($query)) { 
		$row2 = mysqli_fetch_assoc(mysqli_query($link, "SELECT hash FROM tbl_outfitcontest WHERE userid = " . $row['userid'])); ?>
  <tr>
    <td><?php echo $row['first_name']; ?></td>
    <td><?php echo $row['last_name']; ?></td> 
    <td><?php echo $row['email']; ?></td>
    <td>www.fashioncents.me/index.php?temp=<?php echo $row2['hash']; ?></td>
  </tr>

	<?php } ?>
</table>
<?php
} else { ?>
No remaining emails found.
<? }
?>