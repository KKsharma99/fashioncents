<?php
define('INCLUDE_CHECK',true);
include 'sessionsguest.php';
?> 

<div class="row">

	<h2 style="text-align: center;">Cleaner</h2>
	<br> 
</div>

<div class="row">

	<div class="col-md-5 col-md-offset-1">
		<form class="form-horizontal">
			<fieldset>
				<!-- Text input-->
				<br> <br>
				<div class="form-group">

					<input id="textinput" name="textinput" type="text" placeholder="Enter Post ID" class="form-control input-md" required="">
					<span class="help-block">The Post ID is the number at the end of the URL</span>  
					<button type="submit" class="btn btn-default">Submit</button>	
					<button id="singlebutton" name="singlebutton" class="btn btn-sm btn-danger">Delete Post</button> 
				</div>

			</fieldset>
		</form>
	<div class="text-center">
		<img src="img/blog/blog2.jpg" class ="img-responsive"> <br> 
	</div> <!-- End Column -->

	</div> <!-- End Column -->


	<div class="col-md-3 col-md-offset-1">


				<div class="control-group">
					<h3>Select Outfit Categories</h3>
					<label class="control control--checkbox">Athletic
					<input type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Business
					<input type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Business Casual
					<input type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Casual
					<input type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Chic
					<input type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Classic
					<input type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Cultural/Exotic
					<input type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Formal
					<input type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Romantic
					<input type="checkbox" />
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Swim
						<input type="checkbox"/>
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Streetwear
						<input type="checkbox"/>
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Interview
						<input type="checkbox"/>
						<div class="control__indicator"></div>
					</label>
					<label class="control control--checkbox">Wedding
						<input type="checkbox"/>
						<div class="control__indicator"></div>
					</label>
				</div> <!-- End Control Group -->
	</div> <!-- End Column -->

</div> <!-- Row -->

<br> <br>

<div class="row"> 
	<div class="col-xs-12">


		<h3 style="text-align: center;">Delete Items</h3>
		<br>


		<table class="table table-striped">
			<thead>
				<tr>
					<th>IMG</th>
					<th>Title</th>
					<th>Brand</th>
					<th>Merchant</th>
					<th>Price</th>
					<th>URL</th>
					<th>DELETE ITEM?</th>      
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<img src="img/blog/blog2.jpg" style="height:100px;" class ="img-responsive">
					</td>
					<td>Super Awesome Dress I Should Buy!</td>
					<td>Kenneth Cole</td>
					<td>Macy's</td>
					<td>$15.99</td>
					<td>www.google.com</td>
					<td>
						<button id="singlebutton" name="singlebutton" class="btn btn-sm btn-danger">Delete</button>
					</td>
				</tr>
				<tr>
					<td>
						<img src="img/blog/blog2.jpg" style="height:100px;" class ="img-responsive">
					</td>
					<td>Super Awesome Dress I Should Buy!</td>
					<td>Kenneth Cole</td>
					<td>Macy's</td>
					<td>$15.99</td>
					<td>www.google.com</td>
					<td>
						<button id="singlebutton" name="singlebutton" class="btn btn-sm btn-danger">Delete</button>
					</td>
				</tr>
			</tbody>
		</table>


		<br> 
		<h3 style="text-align: center;">Add Items</h3>
		<br>


		<form enctype="multipart/form-data" method = "post" class="form-horizontal">
			<fieldset>
				<div class="row">
					<div class="col-md-4 col-xs-12">

						<div class="outfit-item-card">
							<div class="outfit-item-interior">

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

								<div id = "taggedItems" class="row tagged-item-list">

								</div> <!-- End Tagged Item List --> 


								<!-- Button modal fullscreen -->
								<div class="text-center">


									<span class="visible-xs">
										<button type="button" class="btn btn-primary btn-md" data-toggle="modal" style="background-color:black; margin-top:8px;" data-target="#modal-fullscreen">
											TAG ITEMS
										</button>
									</span>

								</div> 
								<br>
							</div> <!-- End  Outfit Item Interior --> 
						</div> <!-- End Outfit Item Card --> 
					</div> <!-- End Row --> 



					<?php include("itemsearch.php"); ?> 

					<div class="row">
						<div class="col-xs-12">
							<br> <br> 
							<div class="text-center"> 
								<input id="submit" type="image" name="submit" value="submit" src="vendor/custom-icons/post-upload.png" class="outfit-item-checked" onclick="saveItems();" alt="submit">
							</div>
						</div> <!-- End  Column --> 
					</div> <!-- End Row --> 

				</fieldset>
			</form>

			<script>
				document.getElementById('query').onkeypress = function(e){
					if (!e) e = window.event;
					var keyCode = e.keyCode || e.which;
					if (keyCode == '13'){
						$('#searchbutton').trigger('click');
						return false;
					}
				}
			</script>



		</div> <!-- End Column -->
	</div> <!-- End Row -->
	<?php include("footer.php"); ?> 
