<?php
define('INCLUDE_CHECK',true);
include 'sessionsguest.php';
echo "<script> alert('test'); </script>";
if (isset($_POST['submit1']) || isset($_POST['submit2'])) {
	$postidsql = "SELECT postid FROM tbl_posts WHERE hash = '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['textinput']) . "'";
	$result = mysqli_query($GLOBALS['sqllink'], $postidsql);
	if (!$result) {
		echo "<script> alert('No post with that hash found'); </script>";
	} else {
		$row = mysqli_fetch_assoc($result);
		$postid = $row['postid'];
		echo "<script> alert('$postid'); </script>";
		if (isset($_POST['submit2'])) {
			$deletesql = "DELETE FROM tbl_posts WHERE postid = " . $postid;
			mysqli_query($GLOBALS['sqllink'], $deletesql);
			echo "<script> alert('1'); </script>";
		}
		if (isset($_POST['submit1'])) {
			echo "<script> alert('2'); </script>";
			for ($i = 1; $i < 13; $i++) {
				if (isset($_POST['check' . $i])) {
					$sql = "INSERT INTO tbl_category (categoryid, postid) VALUES (" . $i . ", " . $postid . ")";
					mysqli_query($GLOBALS['sqllink'], $sql);
				}
			}
		}
		echo "<script> alert('3'); </script>";
	}
}

?> 

<div class="row">

	<h2 style="text-align: center;">Cleaner 2</h2>
	<br> 
</div>

<div class="row">

	<div class="col-md-4 col-md-offset-4">
		<form method = "post" class="form-horizontal">
			<fieldset>
				<!-- Text input-->
				<br> <br>
				<div class="form-group">

					<input id="textinput" name="textinput" type="text" placeholder="Enter Post Hash In URL" class="form-control input-md" required="">
					<span class="help-block">The Post Hash is the number at the end of the URL</span>  
					<button type="submit" name = "submit1" class="btn btn-default" value="cat">Submit</button>	
					<button type="submit" name = "submit2" class="btn btn-sm btn-danger" value="delete">Delete Post</button> 
				</div>


				<div class="control-group">
					<h3>Select Outfit Categories</h3>
					<label class="control control--checkbox">Athletic
					<input name="check1" type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Business
					<input name = "check2" type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Business Casual
					<input name="check3" type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Casual
					<input name="check4" type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Chic
					<input name="check5" type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Classic
					<input name="check6" type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Cultural/Exotic
					<input name="check7" type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Formal
					<input name="check8" type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Swim
					<input name="check9" type="checkbox"/>
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Streetwear
						<input name="check10" type="checkbox"/>
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Interview
						<input name="check11" type="checkbox"/>
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Wedding
						<input name="check12" type="checkbox"/>
						<div class="control__indicator"></div>
					</label>
				</div> <!-- End Control Group -->


			</fieldset>
		</form>

	</div> <!-- End Column -->

</div> <!-- Row -->

	<?php include("footer.php"); ?> 
