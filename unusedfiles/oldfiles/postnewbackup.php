<!DOCTYPE html>
<?php
define('INCLUDE_CHECK',true);
require 'functions.php';
if(!isset($_SESSION['id']))
{
    // If you are logged in, but you don't have the tzRemember cookie (browser restart)
    // and you have not checked the rememberMe checkbox:
	$_SESSION = array();
	session_destroy();

	header ("Location: index.php");

    // Destroy the session
}
if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();

	header("Location: index.php");
	exit;
}
if(isset($_POST['submit'])) {
	if($_FILES['image']['error'] == 1) {
		echo'<script> alert("Image too large! Max file size 2MB"); </script>';
	} else {
    //var_dump($_FILES);
		createpost();
		header("Location: index.php");
	}
}

//print(time());
?>

<script>
	var i = 1;
</script>



<?php include("header.php"); ?> 

<?php include("nav.php"); ?> 

<style type="text/css">

	#item-photo-container {
		width: 100%;
		height: 160px;
		padding: 10px;
	}

	#item-photo-container img {
		width: 100%;
	}

	.search-main-card {
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
		transition: 0.3s;
		width: 105%;
		border-radius: 5px;
		background-color: #fafafa;
		color:  rgb(104, 104, 104);
		display: block;
		position:relative;
		height: 690px;
		margin-left: 6%;
	}
	
	#image-preview {
		width: 100%;
		height: 400px;
		position: relative;
		overflow: hidden;
		background-color: #fafafa;
		color: #ecf0f1;
	}

	#image-preview input {
		line-height: 200px;
		font-size: 200px;
		position: absolute;
		opacity: 0;
		z-index: 10;
	}
	#image-preview label {
		position: absolute;
		z-index: 5;
		opacity: 0.75;
		cursor: pointer;
		background-color: #a8a8a8;
		width: 160px;
		height: 40px;
		line-height: 40px;
		font-size: 15px;
		text-transform: uppercase;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		margin: auto;
		text-align: center;
		border-radius: 20px;

	}

	.outfit-item-card {
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
		transition: 0.3s;
		width: 100%;
		border-radius: 5px;
		background-color: #fafafa;
		display: block;
		position:relative;

	}

	.outfit-item-card:hover {
		box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
	}

	.outfit-item-interior {

		padding: 10px;
	}

	.outfit-item-header {

		height: 30px;
		padding-top: 3px;
		padding-left: 3px;
		padding-right: 3px;
		margin-bottom: 4px;
	}

	.outfit-item-body {
		padding-top: 15px;
		padding-left: 3px;
		padding-right: 3px;
	}

	.outfit-item-cross {

		height:20px;
	}

	.outfit-item-plus {

		height:35px;
		margin-top:5px;
		margin-bottom:30px;
	}

	.outfit-item-checked {

		height:70px;
		margin-top:30px;
		margin-bottom:20px;
	}

	.outfit-item-height {
		height: 170px;
		margin-bottom: 30px;
	}

	.amazon-link-margin {

		margin-top:12px;
	}

	@media (max-width: 768px) {

		#image-preview {
			height: 300px;
		}


		.outfit-item-plus {

			height:25px;
			margin-top:5px;
			margin-bottom:20px;
		}

		.outfit-item-checked {

			height:55px;
			margin-top:20px;
			margin-bottom:10px;
		}

		.outfit-item-height {
			height: 250px;
			margin-bottom: 20px;
		}

		.item-feild-spacing{
			margin-top:7px;
		}
		.amazon-link-margin {

			margin-top:7px;
		}

	}

</style>

<script type="text/javascript">
	(function() {

		var img = document.getElementById('itemcontainer').firstChild;
		img.onload = function() {
			if(img.height > img.width) {
				img.height = '100%';
				img.width = 'auto';
			}
		};

	}());
</script>

<div class="row text-center"> 
	<div class="col-xs-12">

		<h1 class="text-center">Post an Outfit</h1> 
		<br>

	</div>
</div>

<form enctype="multipart/form-data" method = "post" class="form-horizontal">
	<fieldset>
		<div class="row">
			<div class="col-md-4 col-xs-12">

				<div class="outfit-item-card">
					<div class="outfit-item-interior">
						<input type="hidden" name = "itemcount" id = "itemcount" value = "1"/>

						<script type="text/javascript">
							$(document).ready(function() {
								$.uploadPreview({
									input_field: "#image-upload",
									preview_box: "#image-preview",
									label_field: "#image-label"
								});
							});
						</script>

						<div id="image-preview">
							<label for="image-upload" id="image-label">Upload Outfit</label>
							<input type="file" name="image" id="image-upload" required=""/>
						</div>

						<br> 

						<div class="form-group">
							<div class="col-xs-12"> 
								<textarea class="form-control" id="styled" name="desc" placeholder="Description..."></textarea>
							</div>
						</div>

						<br> 

						<h4 class="text-center">Tagged Items</h4>

						<div class="row tagged-item-list">

							<div class="col-xs-12 tagged-item">

									<img src="img/testitems/4.jpg" class="img-responsive item-image">
									<div class="tagged-item-name-container"> 
									<p class="tagged-item-name">Invisible Blue Dress</p>
									</div> 
									<div class="tagged-item-price-container"> 
									<p class="tagged-item-price">$8.55</p>
									</div>
									<div class="tagged-item-remove-container"> 
									<img src="vendor/custom-icons/circle-cross.png" class="img-responsive tagged-item-remove">
									</div>
							</div> 

							<div class="col-xs-12 tagged-item">

									<img src="img/testitems/3.jpg" class="img-responsive item-image">
									<div class="tagged-item-name-container"> 
									<p class="tagged-item-name">Super Swagger Boots </p>
									</div> 
									<div class="tagged-item-price-container"> 
									<p class="tagged-item-price">$18.54</p>
									</div>
									<div class="tagged-item-remove-container"> 
									<img src="vendor/custom-icons/circle-cross.png" class="img-responsive tagged-item-remove">
									</div>
							</div> 


							<div class="col-xs-12 tagged-item">

									<img src="img/testitems/2.jpg" class="img-responsive item-image">
									<div class="tagged-item-name-container"> 
									<p class="tagged-item-name">Black Wizard Hat</p>
									</div> 
									<div class="tagged-item-price-container"> 
									<p class="tagged-item-price">$40.33</p>
									</div>
									<div class="tagged-item-remove-container"> 
									<img src="vendor/custom-icons/circle-cross.png" class="img-responsive tagged-item-remove">
									</div>
							</div> 

								<div class="col-xs-12 tagged-item">

									<img src="img/testitems/1.jpg" class="img-responsive item-image">
									<div class="tagged-item-name-container"> 
									<p class="tagged-item-name">Party Black Dress</p>
									</div> 
									<div class="tagged-item-price-container"> 
									<p class="tagged-item-price">$99.32</p>
									</div>
									<div class="tagged-item-remove-container"> 
									<img src="vendor/custom-icons/circle-cross.png" class="img-responsive tagged-item-remove">
									</div>
							</div> 

						</div> <!-- End Tagged Item List --> 
						
					</div> <!-- End  Outfit Item Interior --> 
				</div> <!-- End Outfit Item Card --> 
			</div>


			<div class="row">
				<div class="col-md-7">
					<div class="search-main-card">
						<br> 

						<div id="custom-search-input">
							<div class="input-group col-md-12">
								<input type="text" class="form-control input-lg" placeholder="Search for a Similar Clothing Item..." />
								<span class="input-group-btn">
									<button class="btn btn-info btn-lg" type="button">
										<i class="glyphicon glyphicon-search"></i>
									</button>
								</span>
							</div>
						</div>

						<br>

						<div class="productsarea">

							<div class="row"> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/1.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Ripped Mini Bootcut Wash Jeans</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Gucci</div>

												<div class="productmerchant pull-right">Overstock</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$8.99</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/2.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Black Harry Potter Hat</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Nike</div>

												<div class="productmerchant pull-right">Target</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$21.32</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/3.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Wizard Boots</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Hufflepuff</div>

												<div class="productmerchant pull-right">Hogwarts</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$45.80</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/4.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Invisibility Blue Dress</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Ron</div>

												<div class="productmerchant pull-right">Voldemort</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$99.40</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

						</div> <!-- End Products Row --> 

							<div class="row"> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/1.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Ripped Mini Bootcut Wash Jeans</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Gucci</div>

												<div class="productmerchant pull-right">Overstock</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$8.99</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/2.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Black Harry Potter Hat</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Nike</div>

												<div class="productmerchant pull-right">Target</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$21.32</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/3.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Wizard Boots</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Hufflepuff</div>

												<div class="productmerchant pull-right">Hogwarts</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$45.80</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/4.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Invisibility Blue Dress</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Ron</div>

												<div class="productmerchant pull-right">Voldemort</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$99.40</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

						</div> <!-- End Products Row --> 
							<div class="row"> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/1.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Ripped Mini Bootcut Wash Jeans</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Gucci</div>

												<div class="productmerchant pull-right">Overstock</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$8.99</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/2.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Black Harry Potter Hat</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Nike</div>

												<div class="productmerchant pull-right">Target</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$21.32</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/3.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Wizard Boots</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Hufflepuff</div>

												<div class="productmerchant pull-right">Hogwarts</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$45.80</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/4.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Invisibility Blue Dress</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Ron</div>

												<div class="productmerchant pull-right">Voldemort</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$99.40</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

						</div> <!-- End Products Row --> 
							<div class="row"> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/1.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Ripped Mini Bootcut Wash Jeans</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Gucci</div>

												<div class="productmerchant pull-right">Overstock</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$8.99</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/2.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Black Harry Potter Hat</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Nike</div>

												<div class="productmerchant pull-right">Target</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$21.32</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/3.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Wizard Boots</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Hufflepuff</div>

												<div class="productmerchant pull-right">Hogwarts</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$45.80</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/4.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Invisibility Blue Dress</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Ron</div>

												<div class="productmerchant pull-right">Voldemort</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$99.40</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

						</div> <!-- End Products Row --> 
							<div class="row"> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/1.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Ripped Mini Bootcut Wash Jeans</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Gucci</div>

												<div class="productmerchant pull-right">Overstock</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$8.99</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/2.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Black Harry Potter Hat</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Nike</div>

												<div class="productmerchant pull-right">Target</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$21.32</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/3.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Wizard Boots</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Hufflepuff</div>

												<div class="productmerchant pull-right">Hogwarts</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$45.80</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/4.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Invisibility Blue Dress</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Ron</div>

												<div class="productmerchant pull-right">Voldemort</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$99.40</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

						</div> <!-- End Products Row --> 
							<div class="row"> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/1.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Ripped Mini Bootcut Wash Jeans</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Gucci</div>

												<div class="productmerchant pull-right">Overstock</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$8.99</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/2.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Black Harry Potter Hat</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Nike</div>

												<div class="productmerchant pull-right">Target</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$21.32</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/3.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Wizard Boots</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Hufflepuff</div>

												<div class="productmerchant pull-right">Hogwarts</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$45.80</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/4.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Invisibility Blue Dress</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Ron</div>

												<div class="productmerchant pull-right">Voldemort</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$99.40</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

						</div> <!-- End Products Row --> 
							<div class="row"> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/1.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Ripped Mini Bootcut Wash Jeans</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Gucci</div>

												<div class="productmerchant pull-right">Overstock</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$8.99</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/2.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Black Harry Potter Hat</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Nike</div>

												<div class="productmerchant pull-right">Target</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$21.32</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/3.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Wizard Boots</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Hufflepuff</div>

												<div class="productmerchant pull-right">Hogwarts</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$45.80</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/4.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Invisibility Blue Dress</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Ron</div>

												<div class="productmerchant pull-right">Voldemort</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$99.40</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

						</div> <!-- End Products Row --> 
							<div class="row"> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/1.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Ripped Mini Bootcut Wash Jeans</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Gucci</div>

												<div class="productmerchant pull-right">Overstock</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$8.99</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/2.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Black Harry Potter Hat</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Nike</div>

												<div class="productmerchant pull-right">Target</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$21.32</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/3.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Wizard Boots</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Hufflepuff</div>

												<div class="productmerchant pull-right">Hogwarts</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$45.80</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/4.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Invisibility Blue Dress</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Ron</div>

												<div class="productmerchant pull-right">Voldemort</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$99.40</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

						</div> <!-- End Products Row --> 
							<div class="row"> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/1.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Ripped Mini Bootcut Wash Jeans</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Gucci</div>

												<div class="productmerchant pull-right">Overstock</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$8.99</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/2.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Black Harry Potter Hat</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Nike</div>

												<div class="productmerchant pull-right">Target</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$21.32</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 


								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/3.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Wizard Boots</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Hufflepuff</div>

												<div class="productmerchant pull-right">Hogwarts</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$45.80</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

								<div class="col-md-3 column inner-search-columns">
									<div class="productbox"> 
										<div id="item-photo-container">
											<img src="img/testitems/4.jpg" class="img-responsive">
										</div>

										<div class="product-description"> 
										<div class="producttitle">Invisibility Blue Dress</div>

											<div class="productinfo"> 
												<div class="productbrand pull-left">Ron</div>

												<div class="productmerchant pull-right">Voldemort</div>
											</div> 

											<br> <br>

											<div class="product-price-tag"> 
												<div class="pull-left">
												<p class="productprice"><strong>$99.40</strong></p>
												</div>
												
												<div class="pull-right">
												<a  href="#" class="btn btn-primary tag-item-btn">TAG</a> 
												</div>

											</div> 
										</div> <!-- End Product Description --> 

									</div> <!-- End (Inner) Product Box --> 
								</div> <!-- End Product Item --> 

						</div> <!-- End Products Row --> 


					</div> <!-- End Products Area --> 

				</div> <!-- End Search Main Card --> 


			</div> <!-- End  Column --> 
		</div> <!-- End Row --> 

		<div class="row">
			<div class="col-xs-12">
				<br> <br> 
				<div class="text-center"> 
					<input id="submit" type="image" name="submit" value="submit" src="vendor/custom-icons/post-upload.png" class="outfit-item-checked" alt="submit">
				</div>
			</div> <!-- End  Column --> 
		</div> <!-- End Row --> 



	</fieldset>
</form>



<?php include("footer.php"); ?> 

<script type="text/javascript">
	var elementcopy = '<div id = "elements@@">' +
	'<div class="outfit-item-card outfit-item-height">' +
	'<div class="outfit-item-interior">'+
	'<div class="outfit-item-header">'+
	'<span class="pull-left">'+
	'<h4><b>Item @@</b></h4>'+
	'</span>'+
	'<a class="pull-right" onClick="remove()">'+
	'<img src="vendor/custom-icons/cross1.png" class="outfit-item-cross">'+
	'</a>'+
	'</div>'+
	'<div class="outfit-item-body">'+

	'<div class="form-group">'+

	'<div class="col-md-6 col-sm-12">'+

	'<input id="item@@" name="item@@" type="text" placeholder="Clothing Type" class="form-control input-md item-feild-spacing" required="">'+

	'</div>'+

	'<div class="col-md-6 col-sm-12">'+

	'<input id="brand@@" name="brand@@" type="text" placeholder="Brand" class="form-control input-md item-feild-spacing" required="">'+

	'</div>'+

	'<div class="col-md-12 col-sm-12">'+

	'<input id="amazon@@" name="amazon@@" type="url" placeholder="Link to same/similar item online" class="form-control input-md amazon-link-margin" required="">'+

	'</div>'+

	'</div>'+

	'</div>'+

	'</div> <!-- Close interior -->'+
	'</div> <!-- Close Card -->';

	function duplicate() {
		i++;
		document.getElementById("itemcount").value = "" + i;
    var clone = elementcopy.replace(/\@\@/g, i);  // "deep" clone
    //clone.id = "duplicate" + ++i;
    // or clone.id = ""; if the divs don't need an ID
    $('.items').append(clone);
} 

function remove() {
	document.getElementById("elements" + i).parentElement.removeChild(document.getElementById("elements" + i));
	i--; 
	document.getElementById("itemcount").value = "" + i;
}

function ValidURL(str) {
  var pattern = new RegExp('^(https?:\/\/)?'+ // protocol
    '((([a-z\d]([a-z\d-]*[a-z\d])*)\.)+[a-z]{2,}|'+ // domain name
    '((\d{1,3}\.){3}\d{1,3}))'+ // OR ip (v4) address
    '(\:\d+)?(\/[-a-z\d%_.~+]*)*'+ // port and path
    '(\?[;&a-z\d%_.~+=-]*)?'+ // query string
    '(\#[-a-z\d_]*)?$','i'); // fragment locater
  if(!pattern.test(str)) {
  	alert("Please enter a valid URL.");
  	return false;
  } else {
  	return true;
  }
}

window.btn_clicked = false;
document.getElementById('submit').addEventListener("click", function(){
    window.btn_clicked = true;      //set btn_clicked to true
});

window.onbeforeunload = function(){
	if(!window.btn_clicked){
		return 'Are you sure you want to navigate away from this page?';
	}
};

document.getElementById('add').onclick = duplicate;
duplicate();
duplicate();
</script>