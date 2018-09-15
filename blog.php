<!DOCTYPE html>
<?php
define('INCLUDE_CHECK',true);
include 'sessionsguest.php';
include("blogconnect.php");

$category = null;
$subcategory = null;
if (isset($_GET['category'])) {
	$category = $_GET['category'];
	if (isset($_GET['subcategory'])) {
		$subcategory = $_GET['subcategory'];
	}
}

if ($category != null && $subcategory != null) {
	$sql = "SELECT blogid, title, postdate, long_desc FROM tbl_blogs WHERE category = '" . $category . "' AND subcategory = '" . $subcategory . "' ORDER BY postdate DESC LIMIT 6";
} elseif ($category != null) {
	$sql = "SELECT blogid, title, postdate, long_desc FROM tbl_blogs WHERE category = '" . $category . "' ORDER BY postdate DESC LIMIT 6";
} else {
	$sql = "SELECT blogid, title, postdate, long_desc FROM tbl_blogs ORDER BY postdate DESC";
}
$result = mysqli_query($GLOBALS['bloglink'], $sql); ?>
<div class="row">

<?php $i=0;
while ($row = mysqli_fetch_assoc($result)) { 
	if ($i % 3 == 0) {
		echo '<div class="row">';
	}?>
	<div class="col-lg-4"> <!-- Start Post --> 
		<div class="blog-panel-white blog-panel-shadow">

			<figure class="snip1554">
				<img src="img/blog/<?php echo $row['blogid'] ?>.0.jpg" class="img-responsive" alt="sample104" />
				<figcaption>
					<h3>Read More</h3>
				</figcaption>
				<a href="singleblog.php?blogid=<?php echo $row['blogid'] ?>"></a>
			</figure>

			<div class="blog-preview-content">
				<a href="singleblog.php?blogid=<?php echo $row['blogid'] ?>"><h3><?php echo $row['title'] ?></h3></a>

				<span class="blog-posted-on">Posted on </span>
				<span class="blog-preview-date"><?php echo date('F j, Y', strtotime($row['postdate']))  ?></span>
				<p class="blog-description"><?php echo $row['long_desc'] ?>... 
					<a href="singleblog.php?blogid=<?php echo $row['blogid'] ?>"><i><u> Read more </u></i></a>			
				</p>
			</div> <!-- End Blog Content --> 
		</div> <!-- End Panel --> 
	</div> <!-- End Column --> 
<?php
$i++; 
if ($i % 3 == 0) {
	echo '</div>';
}
}

?>
	

<br>

<?php include("footer.php"); ?>