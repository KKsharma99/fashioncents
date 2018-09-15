<!DOCTYPE html>
<!--Add label for user select and email based user search -->
<?php
// "<script> alert('Made it'); </script>";
session_start();
if(!isset($_SESSION['id']))
{
    // If you are logged in, but you don't have the tzRemember cookie (browser restart)
    // and you have not checked the rememberMe checkbox:

  $_SESSION = array();
  $_SESSION['id'] = -1;
  //session_destroy();
  //echo "<script> alert('1'); </script>";
  //header ("Location: index.php");

    // Destroy the session
}
define('INCLUDE_CHECK',true);
require 'yetanotherfunctions.php';
$_SESSION['link'] = $link;
if(isset($_GET['logoff']))
{
  $_SESSION = array();
  session_destroy();
  header("Location: index.php");
  exit;
}
if(isset($_POST['submit'])) {
  if($_FILES['image']['error'] == 0) {
    if ($_POST['submit'] == 1) {
      if (!isset($_POST['selectbasic']) || $_POST['selectbasic'] == -1) {
        echo'<script> alert("Must select an account for Existing post"); </script>';
      } else {
          $uid = $_POST['selectbasic'];
          if ($_FILES['profilePicture']['error'] == 0) {
            $sql = "UPDATE tbl_users SET profilepic = '" . saveProfilePic($uid) . "' WHERE userid = " . $uid;
            mysqli_query($_SESSION['link'], $sql);
          } elseif ($_FILES['profilePicture']['error'] != 4) {
            echo '<script> alert("Profile pic upload error"); </script>';
          }
        createpost($uid);
      }
    } elseif ($_POST['submit'] == 2) {
      if (isset($_POST['searchinput']) && $_POST['searchinput'] != "") {
        $uid = getUserId($_POST['searchinput']);
        if ($uid > 0) {
          if ($_FILES['profilePicture']['error'] == 0) {
            $sql = "UPDATE tbl_users SET profilepic = '" . saveProfilePic($uid) . "' WHERE userid = " . $uid;
            mysqli_query($_SESSION['link'], $sql);    
          } elseif ($_FILES['profilePicture']['error'] != 4) {
            echo '<script> alert("Profile pic upload error"); </script>';
          }
          createpost($uid);
        } else {
          echo'<script> alert("An account with the email ' . $_POST['searchinput'] . ' does not exist"); </script>';
        }
      } else {
        echo'<script> alert("Must fill out an email for account search"); </script>';
      }
    } elseif ($_POST['submit'] == 3) {
      if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && $_POST['first_name'] != "" && $_POST['last_name'] != "" && $_POST['email'] != "" && $_POST['password'] != "") {
        $uid = createAccount();
        if ($uid > 0) {
          if ($_FILES['profilePicture']['error'] == 0) {
            $sql = "UPDATE tbl_users SET profilepic = '" . saveProfilePic($uid) . "' WHERE userid = " . $uid;
            mysqli_query($_SESSION['link'], $sql);   
          } elseif ($_FILES['profilePicture']['error'] != 4) {
            echo '<script> alert("Profile pic upload error"); </script>';
          }
          createpost($uid);
        } else {
          switch ($uid) {
            case -1:
              echo'<script> alert("An account with this email already exists."); </script>';
            break;
            case -2:
              echo'<script> alert("First name must be max 16 characters."); </script>';
            break;            
            case -3:
              echo'<script> alert("Last name must be max 16 characters."); </script>';
            break;          
            case -4:
              echo'<script> alert("Password must be between 8 and 26 characters."); </script>';
            break;
            case -5:
              echo'<script> alert("SQL error."); </script>';
            break;
            case -6:
              echo'<script> alert("Profile picture failed to successfully upload."); </script>';
            break;
            default:
              echo'<script> alert("Unexpected error."); </script>';
          }
          //account creation errors
        }
      } else {
        echo'<script> alert("Must fill out all text fields to create a new account"); </script>';
      }
    } else {
      echo'<script> alert("Unexpected Error"); </script>';
    }

    
  } else {
    echo'<script> alert("Image too large! Max file size 2MB"); </script>';
  }
}
?>

<script>
  var i = 1;
</script>



<?php include("header.php"); ?> 

<?php include("nav.php"); ?> 

<style type="text/css">
  #image-preview {
    width: 100%;
    height: 650px;
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


<div class="row text-center"> 
  <div class="col-xs-12">

    <h1 class="text-center">Post Helper</h1> 
    <br>

  </div>
</div>

<form enctype="multipart/form-data" method = "post" class="form-horizontal">
<fieldset>

<div class="row">
  <div class="col-md-6 col-md-offset-3">

    <ul class="nav nav-tabs">
      <li class="active"><a id = "Aexisting" data-toggle="tab" href="#existing">Existing</a></li>
      <li><a id = "Asearch" data-toggle="tab" href="#search">Search</a></li>
      <li><a id = "Anew" data-toggle="tab" href="#new">New</a></li>
    </ul>

    <div class="tab-content">
      <div id="existing" class="tab-pane fade in active">

        <br> <br> 



            <!-- Select Basic -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="selectbasic">Post to an existing user account ordered by type then age</label>
              <div class="col-md-5">
              <p><strong style = "color:blue">Blue for puppet accounts.</strong><br /><strong style = "color:red">Red for photoshoot accounts.</strong><br /><strong>Black for organic accounts.</strong></p>
                <select id="selectbasic" name="selectbasic" class="form-control">
                  <option selected disabled value = "-1">Email, Name</option>
                  <?php $i = 1;
                    $query = mysqli_query($_SESSION['link'], "SELECT userid, first_name, last_name, email, source FROM tbl_users ORDER BY source DESC, userid DESC");
                    while($user = mysqli_fetch_assoc($query)) { ?>
                      <option style="<?php if($user['source']==2) { echo 'color:blue'; } elseif($user['source']==1) { echo 'color:red'; }?>" value="<?php echo $user['userid']; ?>"><?php echo $user['email'] . ", " . $user['first_name'] . " " . $user['last_name'];?></option>
                    <?php $i++;
                    }

                   ?>
                </select>
              </div>
            </div>

        <br> <br> 

      </div>
      <div id="search" class="tab-pane fade">

        <br> <br> 

            <!-- Select Basic -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="searchinput">Enter the email of the account to post on</label>
              <div class="col-md-5">
                <input id="searchemail" name="searchinput" type="text" placeholder="Email" class="form-control input-md">      
              </div>
            </div>

        <br> <br> 

      </div>
      <div id="new" class="tab-pane fade">

       <br> <br> 

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Account Information</label>  
            <div class="col-md-5">
              <input name="first_name" id="textinput" type="text" placeholder="First Name" class="form-control input-md">
              <input name="last_name" id="textinput" type="text" placeholder="Last Name" class="form-control input-md">
              <input name="email" id="textinput" type="text" placeholder="Email" class="form-control input-md">
              <input name="password" id="textinput" type="text" placeholder="Password" class="form-control input-md">
            </div>
          </div>

          <!-- Multiple Radios -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="gender-radio">Gender</label>
            <div class="col-md-4">
              <div class="radio">
                <label for="gender-radio-0">
                  <input type="radio" name="gender-radio" id="gender-radio-0" value="1" checked="checked">
                  Male
                </label>
              </div>
              <div class="radio">
                <label for="gender-radio-1">
                  <input type="radio" name="gender-radio" id="gender-radio-1" value="2">
                  Female
                </label>
              </div>
            </div>
            <label class="col-md-4 control-label" for="account-radio">Type of Account</label>
            <div class="col-md-4">
              <div class="radio">
                <label for="account-radio-1">
                  <input type="radio" name="account-radio" id="account-radio-1" value="1" checked="checked">
                  Photoshoot Account
                </label>
              </div>
              <div class="radio">
                <label for="account-radio-2">
                  <input type="radio" name="account-radio" id="account-radio-2" value="2">
                    Puppet Account
                </label>
              </div>
              <div class="radio">
                <label for="account-radio-0">
                  <input type="radio" name="account-radio" id="account-radio-0" value="0">
                    Organic Account
                </label>
              </div>
            </div>
            <label class="col-md-4 control-label" for="privacy-radio">Privacy</label>
            <div class="col-md-4">
              <div class="radio">
                <label for="privacy-radio-1">
                  <input type="radio" name="privacy-radio" id="privacy-radio-1" value="1" checked="checked">
                  Public
                </label>
              </div>
              <div class="radio">
                <label for="privacy-radio-0">
                  <input type="radio" name="privacy-radio" id="privacy-radio-0" value="0">
                  Private
                </label>
              </div>
            </div>
          </div>

      <br> <br> 


    </div>
  </div>

</div> <!-- End Columns --> 
</div> <!-- End Row --> 





    <div class="row">
      <div class="col-md-6 col-md-offset-3">
          <label class="col-md-4 control-label" for="source-radio">Type of Photo</label>
            <br>
            <br>
          <!-- File Button --> 
          <div class="form-group">
            <label class="col-md-4 control-label" for="profilePicture">Profile Pic</label>
            <div class="col-md-4">
              <input id="profilePicture" name="profilePicture" class="input-file" type="file">
            </div>
          </div>

            <div class="col-md-4">
              <div class="radio">
                <label for="source-radio-1">
                  <input type="radio" name="source-radio" id="source-radio-1" value="1" checked="checked">
                  Photoshoot Photo
                </label>
              </div>
              <div class="radio">
                <label for="source-radio-0">
                  <input type="radio" name="source-radio" id="source-radio-0" value="0">
                  Standard Photo
                </label>
              </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
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
              <label for="image-upload" id="image-label">Choose Outfit Image</label>
              <input type="file" name="image" id="image-upload"/>
            </div>

            <br> 

            <div class="form-group">
              <div class="col-xs-12"> 
                <textarea class="form-control" id="desc" name="desc" placeholder="Add a description"></textarea>
              </div>
            </div>
          </div> 
        </div> 
        <br> <br> 
        <div class= "items">
          <div class="outfit-item-card outfit-item-height">
            <div class="outfit-item-interior">
              <div class="outfit-item-header">


                <span class="pull-left">
                  <h4><b>Item 1</b></h4>
                </span>

          <!--<a class="pull-right" href="#">
            <img src="vendor/custom-icons/cross1.png" class="outfit-item-cross">
          </a>-->

        </div>
        <div class="outfit-item-body">

          <div class="form-group"> 

            <div class="col-md-6 col-sm-12">

              <input id="item1" name="item1" type="text" placeholder="Clothing Type" class="form-control input-md item-feild-spacing" required="">

            </div>

            <div class="col-md-6 col-sm-12">

              <input id="brand1" name="brand1" type="text" placeholder="Brand" class="form-control input-md item-feild-spacing" required="">

            </div>

            <!--<div class="col-md-3 col-sm-12">

              <input id="price1" name="price1" type="number" step="0.01" placeholder="Price" class="form-control input-md item-feild-spacing" required="">

            </div>-->

            <div class="col-md-12 col-sm-12">

              <input id="link1" name="link1" type="url" placeholder="Link to same/similar item online" class="form-control input-md amazon-link-margin" required="">

            </div>

            <!--<div class="col-md-12 col-sm-12" hidden>-->

            <!--<p class = "warning-response" hidden>
              <span class="glyphicon glyphicon-warning-sign pull-left warning-sign"></span>
              <strong>This item is from a non-affiliated seller. You can post this item but it will not be monetized.</strong>
            </p>
            
            <p class = "error-response" hidden>
              <span class="glyphicon glyphicon-remove pull-left error-cross" ></span> 
              <strong>This is not a valid link.</strong> 
            </p>

            <p class = "success-response" hidden>
              <span class="glyphicon glyphicon-check pull-left success-check"></span>
              <strong>This item can be monetized.</strong>
            </p>-->

            <!--</div>--> 

          </div>

        </div>

      </div> <!-- Close interior --> 
    </div> <!-- Close Card --> 
  </div>

    <!--<div class="outfit-item-card outfit-item-height">
      <div class="outfit-item-interior">
        <div class="outfit-item-header">


          <span class="pull-left">
            <h4><b>Item 2</b></h4>
          </span>

          <a class="pull-right" href="#">
            <img src="vendor/custom-icons/cross1.png" class="outfit-item-cross">
          </a>

        </div>
        <div class="outfit-item-body">

          <div class="form-group"> 

            <div class="col-md-5 col-sm-12">

              <input id="item1" name="item1" type="text" placeholder="Clothing Type" class="form-control input-md item-feild-spacing" required="">

            </div>

            <div class="col-md-4 col-sm-12">

              <input id="item1" name="item1" type="text" placeholder="Brand" class="form-control input-md item-feild-spacing" required="">

            </div>

            <div class="col-md-3 col-sm-12">

              <input id="item1" name="item1" type="text" placeholder="Price" class="form-control input-md item-feild-spacing" required="">

            </div>

            <div class="col-md-12 col-sm-12">

              <input id="item1" name="item1" type="text" placeholder="Amazon Link" class="form-control input-md amazon-link-margin" required="">

            </div>

          </div>

        </div>

      </div>--> <!-- Close interior --> 
      <!--</div>--> <!-- Close Card --> 

    <!--<div class="outfit-item-card outfit-item-height">
      <div class="outfit-item-interior">
        <div class="outfit-item-header">


          <span class="pull-left">
            <h4><b>Item 3</b></h4>
          </span>

          <a class="pull-right" href="#">
            <img src="vendor/custom-icons/cross1.png" class="outfit-item-cross">
          </a>

        </div>
        <div class="outfit-item-body">

          <div class="form-group"> 

            <div class="col-md-5 col-sm-12">

              <input id="item1" name="item1" type="text" placeholder="Clothing Type" class="form-control input-md item-feild-spacing" required="">

            </div>

            <div class="col-md-4 col-sm-12">

              <input id="item1" name="item1" type="text" placeholder="Brand" class="form-control input-md item-feild-spacing" required="">

            </div>

            <div class="col-md-3 col-sm-12">

              <input id="item1" name="item1" type="text" placeholder="Price" class="form-control input-md item-feild-spacing" required="">

            </div>

            <div class="col-md-12 col-sm-12">

              <input id="item1" name="item1" type="text" placeholder="Amazon Link" class="form-control input-md amazon-link-margin" required="">

            </div>

          </div>

        </div>

      </div>  Close interior --> 
      <!--</div> Close Card --> 

      <div class="text-center"> 
        <img id = "add" src="vendor/custom-icons/circle-plus-gray.png" onClick="duplicate()" class="outfit-item-plus">
      </div> 

      <div class="text-center"> 
        <input id="submit" type="image" name="submit" value="1" src="vendor/custom-icons/post-upload.png" class="outfit-item-checked" alt="submit">
      </div>



    </div>

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

  '<input id="link@@" name="link@@" type="url" placeholder="Link to same/similar item online" class="form-control input-md amazon-link-margin" required="" onchange="checklink(@@)">'+

  '</div>'+

  '</div>'+

  '</div>'+

  '</div> <!-- Close interior -->'+
  '</div> <!-- Close Card -->'+
  '</div> <!-- Close Element -->'; 

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
document.getElementById('Aexisting').addEventListener("click", function(){
    document.getElementById('submit').value = 1;
  });
document.getElementById('Asearch').addEventListener("click", function(){
    document.getElementById('submit').value = 2;
  });
document.getElementById('Anew').addEventListener("click", function(){
    document.getElementById('submit').value = 3;
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