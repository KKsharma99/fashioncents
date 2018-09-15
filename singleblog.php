<!DOCTYPE html>
<?php
if (empty($_GET['blogid'])) {
	header("Location: index.php");
}
define('INCLUDE_CHECK',true);
include 'sessionsguest.php';
include 'blogconnect.php';
ini_set('display_errors','1'); 
error_reporting(E_ALL);

$blogresult = mysqli_query($GLOBALS['bloglink'], "SELECT blogid, category, subcategory, title, postdate FROM tbl_blogs WHERE blogid = " . $_GET['blogid']);
	$blogheader = array();
	$blogheader = mysqli_fetch_assoc($blogresult);
	if ($blogheader == null) {
		header("Location: 404.php");
	}
	$blogcontent = array();
	$blogresult = mysqli_query($GLOBALS['bloglink'], "SELECT blockid, content FROM tbl_blogcontent WHERE blogid = " . $_GET['blogid']);
	while ($row = mysqli_fetch_assoc($blogresult)) {
		$blogcontent[$row['blockid']] = $row['content'];
	}

//var_dump($_SERVER);


?>

<progress value="0" id="progressBar">
  <div class="progress-container">
    <span class="progress-bar"></span>
  </div>
</progress>

<!-- Progress BAR JS --> 
<script> 
$(document).ready(function(){
    
    var getMax = function(){
        return $(document).height() - $(window).height();
    }
    
    var getValue = function(){
        return $(window).scrollTop();
    }
    
    if('max' in document.createElement('progress')){
        // Browser supports progress element
        var progressBar = $('progress');
        
        // Set the Max attr for the first time
        progressBar.attr({ max: getMax() });

        $(document).on('scroll', function(){
            // On scroll only Value attr needs to be calculated
            progressBar.attr({ value: getValue() });
        });
      
        $(window).resize(function(){
            // On resize, both Max/Value attr needs to be calculated
            progressBar.attr({ max: getMax(), value: getValue() });
        });   
    }
    else {
        var progressBar = $('.progress-bar'), 
            max = getMax(), 
            value, width;
        
        var getWidth = function(){
            // Calculate width in percentage
            value = getValue();            
            width = (value/max) * 100;
            width = width + '%';
            return width;
        }
        
        var setWidth = function(){
            progressBar.css({ width: getWidth() });
        }
        
        $(document).on('scroll', setWidth);
        $(window).on('resize', function(){
            // Need to reset the Max attr
            max = getMax();
            setWidth();
        });
    }
});


$(document).ready(function(){
  
  $('#flat').addClass("active");
  $('#progressBar').addClass('flat');
    
  $('#flat').on('click', function(){
    $('#progressBar').removeClass().addClass('flat');
    $('a').removeClass();
    $(this).addClass('active');
    $(this).preventDefault();
  });

  $('#single').on('click', function(){
    $('#progressBar').removeClass().addClass('single');
    $('a').removeClass();    
    $(this).addClass('active');
    $(this).preventDefault();    
  });

  $('#multiple').on('click', function(){
    $('#progressBar').removeClass().addClass('multiple');
    $('a').removeClass();    
    $(this).addClass('active');
    $(this).preventDefault();    
  });

  $('#semantic').on('click', function(){
    $('#progressBar').removeClass().addClass('semantic');
    $('a').removeClass();    
    $(this).addClass('active');
    $(this).preventDefault();
    alert('hello');
  });

  $(document).on('scroll', function(){

      maxAttr = $('#progressBar').attr('max');
      valueAttr = $('#progressBar').attr('value');
      percentage = (valueAttr/maxAttr) * 100;
      
      if(percentage<49){
        document.styleSheets[0].addRule('.semantic', 'color: red');
        document.styleSheets[0].addRule('.semantic::-webkit-progress-value', 'background-color: red');
        document.styleSheets[0].addRule('.semantic::-moz-progress-bar', 'background-color: red');
      }
      else if(percentage<98){
        document.styleSheets[0].addRule('.semantic', 'color: orange');
        document.styleSheets[0].addRule('.semantic::-webkit-progress-value', 'background-color: orange');
        document.styleSheets[0].addRule('.semantic::-moz-progress-bar', 'background-color: orange');
      }
      else {
        document.styleSheets[0].addRule('.semantic', 'color: green');
        document.styleSheets[0].addRule('.semantic::-webkit-progress-value', 'background-color: green');
        document.styleSheets[0].addRule('.semantic::-moz-progress-bar', 'background-color: green');
      }      
  });
  
});
</script>

<div class="row"> 
	<div class="col-lg-8"> <!-- Start Post --> 
		<div class="blog-panel-white blog-panel-shadow">
			<div class="single-blog-header">
				<h1 class="single-blog-title">
				<?php echo $blogheader['title'] ?></h1>
				<span class="blog-posted-on">
				Posted On </span>
				<span class="blog-preview-date">
				<?php echo date('F j, Y', strtotime($blogheader['postdate']))  ?></span>
			</div>

			<img src="img/blog/<?php echo $blogheader['blogid'] ?>.0.jpg" class="img-responsive"/>

			<div class="single-blog-body">

				<div class ="blog-share-btns"> 
					<!-- AddToAny BEGIN -->
					<style type="text/css">
						.a2a_svg, .a2a_count { border-radius: 0 !important; }
					</style>
					<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
						<a class="a2a_button_facebook"></a>
						<a class="a2a_button_twitter"></a>
						<a class="a2a_button_facebook_messenger"></a>
				  	    <a class="a2a_button_pinterest"></a>
						<a class="a2a_button_email"></a>
						<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
					</div>
					<script async src="https://static.addtoany.com/menu/page.js"></script>
					<!-- AddToAny END -->
				</div> 

				<div class="single-blog-description">

				<?php $imgagecount = 0;
				foreach($blogcontent as $content) {
					if ($content == null) {
						$imgagecount++;?>
						<img src="img/blog/<?php print($blogheader['blogid'] . '.' . $imgagecount); ?>.jpg" class="img-responsive" width="100%" alt="fashion blog image"> 
				 		<br>
					<?php } else {
						echo $content;
					}
				}?>
				<br>
			    

				<div class ="blog-share-btns"> 
					<!-- AddToAny BEGIN -->
					<style type="text/css">
						.a2a_svg, .a2a_count { border-radius: 0 !important; }
					</style>
					<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
						<a class="a2a_button_facebook"></a>
						<a class="a2a_button_twitter"></a>
						<a class="a2a_button_facebook_messenger"></a>
				  	    <a class="a2a_button_pinterest"></a>
						<a class="a2a_button_email"></a>
						<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
					</div>
					<script async src="https://static.addtoany.com/menu/page.js"></script>
					<!-- AddToAny END -->
				</div> <!-- End Blog Share Buttons --> 

 				<h3>Liked the Article? Share it with your Friends!</h3> 


				</div> 

			</div>


		</div> <!-- End Panel --> 
	</div> <!-- End Column --> 
	<div class="col-lg-4 single-blog-sidebar"> <!-- Start Post --> 
<div class="blog-light-panel"> 
<img src="img/fcadv.png" class="img-responsive">
</div> 

<br>  
<?php
/*
if ($blogheader['subcategory'] == null) {
	$sql = "SELECT blogid, category, subcategory, title, postdate, short_desc FROM tbl_blogs WHERE category = '" . $blogheader['category'] . "' AND blogid != " . $blogheader['blogid'] . " ORDER BY postdate DESC LIMIT 5";
} else {
	$sql = "SELECT blogid, category, subcategory, title, postdate, short_desc FROM tbl_blogs WHERE category = '" . $blogheader['category'] . "' AND subcategory = '" . $blogheader['subcategory'] . "' AND blogid != " . $blogheader['blogid'] . " ORDER BY postdate DESC LIMIT 5";
}*/
$sql = "SELECT b1.blogid, b1.title, b1.postdate, b1.short_desc FROM tbl_blogs AS b1 JOIN (SELECT CEIL( RAND()* (SELECT count(blogid) FROM tbl_blogs)) + (SELECT MIN(blogid) FROM tbl_blogs) AS id) AS b2 WHERE b1.blogid >= b2.id ORDER BY b1.blogid LIMIT 2";
$result = mysqli_query($GLOBALS['bloglink'], $sql);
if ($result) {
	?> <h2 class="text-center">Related Articles</h2> <?php
	while ($row = mysqli_fetch_assoc($result)) { ?>
	<figure class="snip1529">
	<img src="img/blog/blog<?php echo $row['blogid'] ?>.0.jpg" alt="Related Article" />
		<div class="date"><span class="day"><?php 
		echo date('j', strtotime($row['postdate']))
		?></span><span class="month"><?php
		echo substr(date('F', strtotime($row['postdate'])), 0, 3)
		?></span></div>
		<figcaption>
			<h3><?php echo $row['title'] ?></h3>
			<p><?php echo $row['short_desc'] ?></p>
		</figcaption>
		<div class="hover">READ</div>
		<a href="./singleblog.php?blogid=<?php echo $row['blogid'] ?>"></a>
	</figure>


	<?php }
}
?>


<br> 

<span class="hidden-xs">   
<img src="img/likeus.png" class="img-responsive" alt="Like Us On Facebook" /> <br> 
<div class="fb-page" data-href="https://www.facebook.com/fashioncents.me/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/fashioncents.me/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/fashioncents.me/">Fashioncents</a></blockquote></div>
</span> 

	</div> <!-- End Column --> 
</div> <!-- End Row -->

<br>

 
	<?php
	//$sql = "SELECT blogid, category, subcategory, title, postdate, long_desc FROM tbl_blogs WHERE category != '" . $blogheader['category'] . "' ORDER BY postdate DESC LIMIT 3";
	//$sql = "SELECT blogid, category, subcategory, title, postdate, long_desc FROM tbl_blogs ORDER BY postdate DESC LIMIT 3";
$sql = "SELECT b1.blogid, b1.title, b1.postdate, b1.long_desc FROM tbl_blogs AS b1 JOIN (SELECT CEIL( RAND()* (SELECT count(blogid) FROM tbl_blogs)) + (SELECT MIN(blogid) FROM tbl_blogs) AS id) AS b2 WHERE b1.blogid >= b2.id ORDER BY b1.blogid LIMIT 3";
	$result = mysqli_query($GLOBALS['bloglink'], $sql);?>
	<div class="row"> 
		<div class="col-xs-12"> <!-- Start Post --> 
			<br> 
			<h1 class="text-center">Other Articles</h1>
			<br> 
		</div>
	</div>


	<div class="row">
	<?php
	while ($row = mysqli_fetch_assoc($result)) { ?>
		<div class="col-lg-4"> <!-- Start Post --> 
		<div class="blog-panel-white blog-panel-shadow">

			<figure class="snip1554">
				<img src="img/blog/<?php echo $row['blogid'] ?>.0.jpg" class="img-responsive" alt="sample104" />
				<figcaption>
					<h3>Read More</h3>
				</figcaption>
				<a href="./singleblog.php?blogid=<?php echo $row['blogid'] ?>"></a>
			</figure>

			<div class="blog-preview-content">
				<h3><?php echo $row['title'] ?></h3>

				<span class="blog-posted-on">Posted on </span>
				<span class="blog-preview-date"><?php echo date('F j, Y', strtotime($row['postdate']))  ?></span>
				<p class="blog-description"><?php echo $row['long_desc'] ?>... 
					<i><u> Read more </u></i>			
				</p>
			</div> <!-- End Blog Content --> 
		</div> <!-- End Panel --> 
	</div> <!-- End Column -->
	<?php }
	?>
	</div> <!-- End row -->



<br> 

<?php include("footer.php"); ?> 