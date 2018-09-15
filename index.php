<!DOCTYPE html>
<?php
define('INCLUDE_CHECK',true);
include('sessionsguest.php');
include('jsfunctions.php');
//var_dump($_SESSION);

$gender = 0;
if (isset($_GET['gender'])) {
	if ($_GET['gender'] == "Male") {
		$gender = "1";
	}
	if ($_GET['gender'] == "Female") {
		$gender = "2";
	}
}

$utype = 0;
if (isset($_GET['type'])) {
	if ($_GET['type'] == "Community") {
		$utype = 1;
	}
	if ($_GET['type'] == "Celebrity") {
		$utype = 2;
	}
}

$category = array();
$categorygetsql = "SELECT categoryname, categoryid FROM tbl_categories WHERE categoryid != 0";
$catgetresult = mysqli_query($GLOBALS['sqllink'], $categorygetsql);
$catgetcount = 1;
while ($catgetrow = mysqli_fetch_assoc($catgetresult)) {
	if (isset($_GET['category' . $catgetcount]) && $_GET['category' . $catgetcount] == $catgetrow['categoryname']) {
		array_push($category, $catgetrow['categoryid']);
	}
	$catgetcount++;
}
$feedtype = 1;
if (isset($_GET['feed'])) {
	switch ($_GET['feed']) {
		case 'Newest' :
			$feedtype = 1;
			break;
		case 'Featured' :
			$feedtype = 3;
			break;
		case 'PopularWeek' :
			$feedtype = 5;
			break;
		case 'PopularMonth' :
			$feedtype = 6;
			break;
		case 'PopularYear' :
			$feedtype = 7;
			break;
		case 'PopularAll' :
			$feedtype = 8;
			break;
	}
}
if (!isset($_GET['feed']) && empty($_SESSION['id'])) {
	include 'athousanddivs.php';
}
include('functions.php');
//generatefeed(isguest, gender, type, category, feedtype, feedtype2, number);
$number = 9;
$offset = 0;
?>
<div id="postcontainer">
<?php
generalfeed($gender, $utype, $category, $feedtype, $number, $offset);
?>
</div>
<div class="row">
<div class="col-xs-12 text-center">
<br> <br> 
<img height="50px" src="img/circle-loading-gif.gif"> 
<br> 
</div>
</div> 
<script type="text/javascript">
	var flag = false;
	var gender = <?php echo($gender) ?>;
	var utype = <?php echo($utype) ?>;
	var category = [<?php echo(implode(', ', $category)); ?>];
	var feedtype = <?php echo($feedtype) ?>;
	var number = <?php echo($number) ?>;
	var offset = <?php echo($number) ?>;
	$(window).scroll(function() {
		if($(window).scrollTop() + $(window).height() >= $(document).height()-1000) {
			
			if(!flag){
				flag=true;
				setTimeout(function() { flag=false;}, 250);
				$.ajax({
					url: 'feedgenerator.php',
					type: 'post',
					datatype: 'string',
					data: {gender: gender, utype: utype, category: category, feedtype: feedtype, number: number, offset: offset},
					success: function(data) {
						$('#postcontainer').append(data);
					}
        //$('#container').html(current.concat(data,'<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">'));}
    			});
				offset += number;
			}
		}
	});

</script>
<?php include 'footer.php'; ?>