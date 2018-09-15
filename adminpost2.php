<?php
define('INCLUDE_CHECK',true);
include 'sessionsguest.php';
?> 

<div class="row">

	<h2 style="text-align: center;">Admin Post New</h2>
	<br> 
</div>

<div class="row">

	<div class="col-md-5 col-md-offset-1">

		<h3>Basic Information</h3>


		<form class="form-horizontal">
			<fieldset>

				<!-- Form Name -->
				<legend>Form Name</legend>

				<!-- Search input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="searchinput">Search User</label>
					<div class="col-md-4">
						<input id="searchinput" name="searchinput" type="search" placeholder="Enter Username" class="form-control input-md">

					</div>
				</div>

				<!-- File Button --> 
				<div class="form-group">
					<label class="col-md-4 control-label" for="Profile Picture">Profile Picture</label>
					<div class="col-md-4">
						<input id="Profile Picture" name="Profile Picture" class="input-file" type="file">
					</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="textinput">Email</label>  
					<div class="col-md-4">
						<input id="textinput" name="textinput" type="text" placeholder="Email" class="form-control input-md">

					</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="textinput">Username</label>  
					<div class="col-md-4">
						<input id="textinput" name="textinput" type="text" placeholder="Username" class="form-control input-md">

					</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="textinput">First Name</label>  
					<div class="col-md-4">
						<input id="textinput" name="textinput" type="text" placeholder="First Name" class="form-control input-md">

					</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="textinput">Last Name</label>  
					<div class="col-md-4">
						<input id="textinput" name="textinput" type="text" placeholder="Last Name" class="form-control input-md">

					</div>
				</div>

				<!-- Password input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="passwordinput">Password</label>
					<div class="col-md-4">
						<input id="passwordinput" name="passwordinput" type="password" placeholder="Password" class="form-control input-md">

					</div>
				</div>

				<!-- Password input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="passwordinput">Confirm Password</label>
					<div class="col-md-4">
						<input id="passwordinput" name="passwordinput" type="password" placeholder="Confirm Password" class="form-control input-md">

					</div>
				</div>

				<!-- Multiple Radios -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="radios">Gender</label>
					<div class="col-md-4">
						<div class="radio">
							<label for="radios-0">
								<input type="radio" name="radios" id="radios-0" value="1" checked="checked">
								Male
							</label>
						</div>
						<div class="radio">
							<label for="radios-1">
								<input type="radio" name="radios" id="radios-1" value="2">
								Female
							</label>
						</div>
					</div>
				</div>

				<!-- Select Basic -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="selectbasic">Account Source Type</label>
					<div class="col-md-4">
						<select id="selectbasic" name="selectbasic" class="form-control">
							<option value="1">Celeb Account</option>
							<option value="2">Instagram Assisted Account</option>
							<option value="3">Lookbook Assisted Account</option>
							<option value="4">Organic Facebook Account</option>
							<option value="5">Organic Account</option>
							<option value="6">Photoshoot Account</option>
							<option value="7">Friend/Family Account</option>
							<option value="8">Fashion Blogger Assisted Account</option>
							<option value="9">Twitter Assisted Account</option>
							<option value="10">Puppet account</option>
							<option value="11">Admin</option>
						</select>
					</div>
				</div>

			</fieldset>
		</form>


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
