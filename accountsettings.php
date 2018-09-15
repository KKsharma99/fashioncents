<!DOCTYPE html>
<?php 
define('INCLUDE_CHECK',true);
$disallowguest = true;
require 'sessionsguest.php';
ini_set('display_errors','1'); 
error_reporting(E_ALL);
if(isset($_GET['logoff']))
{
  $_SESSION = array();
  session_destroy();
  header("Location: index.php");
  exit;
}

$settings = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'], "SELECT first_name,last_name,username,email,gender,bio,userpass,blog,instagram,twitter,pinterest,facebook FROM tbl_masterusers a JOIN tbl_account b ON a.userid = b.userid WHERE a.userid='" . $_SESSION['id']. "'"));

if(isset($_POST['submit']) && $_POST['submit']=='submit') {

  $query = 'UPDATE tbl_masterusers SET ';
  $query2 = 'UPDATE tbl_account SET ';
  $masterchange = array();
  $accountchange = array();

  if(isset($_POST['firstname']) && $_POST['firstname'] != "") {
    $_POST['firstname'] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['firstname']);
    $accountchange[] = 'first_name = "' . $_POST['firstname'] . '"';
  }

  if(isset($_POST['lastname']) && $_POST['lastname'] != "") {
    $_POST['lastname'] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['lastname']);
    $accountchange[] = 'last_name = "' . $_POST['lastname'] . '"';  
  }

  if(isset($_POST['username']) && $_POST['username'] != "") {
    $_POST['username'] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['username']);
    $masterchange[] = 'username = "' . $_POST['username'] . '"';  
  }

  if(isset($_POST['changeemail']) && $_POST['changeemail'] != "") {
    $_POST['changeemail'] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['changeemail']);
    $accountchange[] = 'email = "' . $_POST['changeemail'] . '"';  
  }

  if(isset($_POST['Gender']) && $_POST['Gender'] != $settings['gender']) {
    $_POST['Gender'] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['Gender']);
    $masterchange[] = 'gender = "' . $_POST['Gender'] . '"';  
  }

  if(isset($_POST['blog']) && $_POST['blog'] != "") {
    $_POST['blog'] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['blog']);
    $accountchange[] = 'blog = "' . $_POST['blog'] . '"';  
  }

  if(isset($_POST['insta']) && $_POST['insta'] != "") {
    $_POST['insta'] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['insta']);
    $accountchange[] = 'instagram = "' . $_POST['insta'] . '"';  
  }

  if(isset($_POST['twitter']) && $_POST['twitter'] != "") {
    $_POST['twitter'] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['twitter']);
    $accountchange[] = 'twitter = "' . $_POST['twitter'] . '"';  
  }

  if(isset($_POST['pinterest']) && $_POST['pinterest'] != "") {
    $_POST['pinterest'] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['pinterest']);
    $accountchange[] = 'pinterest = "' . $_POST['pinterest'] . '"';  
  }

  if(isset($_POST['facebook']) && $_POST['facebook'] != "") {
    $_POST['facebook'] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['facebook']);
    $accountchange[] = 'facebook = "' . $_POST['facebook'] . '"';  
  }

  /*if(isset($_FILES['newProPic'])) {
    $user = array();
    $user['userid'] = $_SESSION['id'];
    $_SESSION['errmsg'] = (newUpload($user));
    if($_SESSION['errmsg'] == "1") {
      $message = "File too large!";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
  }*/

  if(isset($_POST['newpassword']) && isset($_POST['passwordconfirm']) && $_POST['newpassword'] != "" && $_POST['passwordconfirm'] != "") {
    $_POST['newpassword'] = mysqli_real_escape_string($link, $_POST['newpassword']);
    $cost = 10;
    $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
    $salt = sprintf("$2a$%02d$", $cost) . $salt;
    $hash = crypt($_POST['newpassword'], $salt);

    $accountchange[] = 'userpass = "' . $hash . '"';  
  }

  //if(isset($_POST['shortbio']) && $_POST['shortbio'] != "Add a short bio.") {
  //  $_POST['shortbio'] = mysqli_real_escape_string($link, $_POST['shortbio']);
  //  $settingchange[] = 'email = "' . $_POST['changeemail'];  
  //}

  if(count($accountchange) > 0) {
    $query2 .= $accountchange[0];
    for($i = 1; $i < count($accountchange); $i++) {
      $query2 .= "," . $accountchange[$i];
    }
    $query2 .= " WHERE userid = " . $_SESSION['id'];
    //$_SESSION['query2'] = $query;
    mysqli_query($GLOBALS['sqllink'], $query2);
  }

  if(count($masterchange) > 0) {
    $query .= $masterchange[0];
    for($i = 1; $i < count($masterchange); $i++) {
      $query .= "," . $masterchange[$i];
    }
    $query .= " WHERE userid = " . $_SESSION['id'];
    //$_SESSION['query2'] = $query;
    mysqli_query($GLOBALS['sqllink'], $query);
  }

  //var_dump($_SESSION['query']);

  header("Location: account.php?usr=" . $settings['username']);
  exit;
}

?>

<html lang="en">

<div class="row">

 <div class="col-lg-12 col-xs-12 "> 

   <h2 class="text-center">Account Settings</h2> <br> <br> 

   <form enctype="multipart/form-data" class="form-horizontal" method = "post">
    <fieldset>


      <!-- first Name-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="firstname">First Name</label>  
        <div class="col-md-4">
          <input id="firstname" name="firstname" type="text" placeholder="<?php echo $settings['first_name']; ?>" class="form-control input-md">

        </div>
      </div>

      <!-- Last Name-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="lastname">Last Name</label>  
        <div class="col-md-4">
          <input id="lastname" name="lastname" type="text" placeholder="<?php echo $settings['last_name']; ?>" class="form-control input-md">

        </div>
      </div>

      <!-- Username -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="username">Username</label>  
        <div class="col-md-4">
          <input id="username" name="username" type="text" placeholder="<?php echo $settings['username']; ?>" class="form-control input-md">

        </div>
      </div>

      <!-- Email -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="changeemail">Email</label>  
        <div class="col-md-4">
          <input id="changeemail" name="changeemail" type="text" placeholder="<?php echo $settings['email']; ?>" class="form-control input-md">

        </div>
      </div>

      <!-- Textarea -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="textarea">Bio</label>
        <div class="col-md-4">                     
        <textarea class="form-control" id="textarea" name="textarea" placeholder="Edit Your Bio"></textarea>
        </div>
      </div>

      <!-- Blog Handle -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="blog">Blog</label>  
        <div class="col-md-4">
          <input id="blog" name="blog" type="text" placeholder="<?php if($settings['blog'] != null) { echo $settings['blog']; } else { echo 'Enter URL'; } ?>" class="form-control input-md">
        </div>
      </div>


      <!-- Instagram Handle -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="insta">Instagram @</label>  
        <div class="col-md-4">
          <input id="insta" name="insta" type="text" placeholder="<?php if($settings['instagram'] != null) { echo $settings['instagram']; } else { echo 'Enter Handle'; } ?>" class="form-control input-md">
        </div>
      </div>

      <!-- Twitter Handle -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="twitter">Twitter</label>  
        <div class="col-md-4">
          <input id="twitter" name="twitter" type="text" placeholder="<?php if($settings['twitter'] != null) { echo $settings['twitter']; } else { echo 'Enter Username'; } ?>" class="form-control input-md">
        </div>
      </div>

      <!-- Pinterest Handle -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="pinterest">Pinterest</label>  
        <div class="col-md-4">
          <input id="pinterest" name="pinterest" type="text" placeholder="<?php if($settings['pinterest'] != null) { echo $settings['pinterest']; } else { echo 'Enter Handle'; } ?>" class="form-control input-md">
        </div>
      </div>

      <!-- Facebook Handle -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="facebook">Facebook</label>  
        <div class="col-md-4">
          <input id="facebook" name="facebook" type="text" placeholder="<?php if($settings['facebook'] != null) { echo $settings['facebook']; } else { echo 'Enter Username'; } ?>" class="form-control input-md">
        </div>
      </div>

      <!-- Short Bio 
      <div class="form-group">
        <label class="col-md-4 control-label" for="shortbio">Short Bio</label>
        <div class="col-md-4">                     
          <textarea class="form-control" id="shortbio" name="shortbio">Add a short bio.
          </textarea>
        </div>
      </div>-->

      <!-- Select Gender -->

      <div class="form-group">
        <label class="col-md-4 control-label" for="Gender">Select Gender</label>
        <div class="col-md-4">
          <div class="radio">
            <label for="Gender-0">
              <input type="radio" name="Gender" id="Gender-0" value=1 <?php if($settings['gender'] == 1)  echo 'checked = checked'; ?>>
              Male
            </label>
          </div>
          <div class="radio">
            <label for="Gender-1">
              <input type="radio" name="Gender" id="Gender-1" value=2 <?php if($settings['gender'] == 2)  echo 'checked = checked'; ?>>
              Female
            </label>
          </div>
        </div>
      </div>

      <!-- Avatar --> 
      <div class="form-group">
        <label class="col-md-4 control-label" for="newProPic">Avatar</label>
        <div class="col-md-4">
          <input id="newProPic" name="newProPic" class="input-file" type="file">
        </div>
      </div>

      <!-- Old Password input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="oldpassword">Change Password</label>
        <div class="col-md-4">
          <input id="oldpassword" name="oldpassword" type="password" placeholder="Enter Old Password" class="form-control input-md" oninput="verify(this)" /> 
          <script language='javascript' type='text/javascript'>
            function verify(input) {
              if (document.getElementById('oldpassword').value != "") {
                input.setCustomValidity('Password Is Incorrect.');
                $('newpassword').removeAttr('required');
                $('oldpassword').removeAttr('required');
              } else {
                // input is valid -- reset the error message
                input.setCustomValidity('');
                $('newpassword').attr('required');
                $('oldpassword').attr('required');
              }
            }
          </script>

        </div>
      </div>

      <!-- New Password input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="newpassword"></label>
        <div class="col-md-4">
          <input id="newpassword" name="newpassword" type="password" ng-required="oldpassword" placeholder="Enter New Password" class="form-control input-md">

        </div>
      </div>

      <!-- Repeat New Password input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="passwordinput"></label>
        <div class="col-md-4">
          <input name="passwordconfirm" type="password" id="passwordconfirm" ng-required="newpassword" placeholder="Repeat New Password" class="form-control input-md" oninput="check(this)" />
          <script language='javascript' type='text/javascript'>
            function check(input) {
              if (input.value != document.getElementById('newpassword').value) {
                input.setCustomValidity('Password Must be Matching.');
              } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
          }
        }
      </script>

    </div>
  </div>

  <!-- Submit Button --> 
  <div class="text-center"> 

    <input id = "submit" name = "submit" type="submit" value="submit" class="btn btn-default"> <br> <br> 

  </div>


</fieldset>
</form>

</div> <!-- End Column Classes -->

</div> <!-- End Row --> 


<?php include("footer.php"); ?>