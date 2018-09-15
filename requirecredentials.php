<?php
  if(isset($_POST['submit'])) {
    if(isset($_POST['newpassword']) && isset($_POST['passwordconfirm'])) {
      $_POST['newpassword'] = mysqli_real_escape_string($link, $_POST['newpassword']);
      $cost = 10;
      $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
      $salt = sprintf("$2a$%02d$", $cost) . $salt;
      $hash = crypt($_POST['newpassword'], $salt);
      $query = "UPDATE tbl_users SET pass = '" . $hash . "' WHERE userid = " . $_SESSION['id'];
      mysqli_query($link, $query);
      $query2 = "UPDATE tbl_regcreds SET changed = true WHERE userid = " . $_SESSION['id'];
      mysqli_query($link, $query2);
      $query3 = "UPDATE tbl_outfitcontest SET passchange = 1 WHERE userid = " . $_SESSION['id'];
      mysqli_query($link, $query3);
    }
  }
?>

<div class="modal fade" id="register-creds" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content text-center">
      <div class="modal-header">
        <h4 class="modal-title">Please Create a Username and Password *Required*</h4>
      </div>
      <div class="modal-body">
        <p>In order to access your free photo, please fill in the required boxes below.</p>
        <br>

<div class = "row"> 
   <form enctype="multipart/form-data" class="form-horizontal" method = "post">
    <fieldset>

      <!-- New Password input-->
      <div class="form-group">
        <div class="col-xs-12">
          <input id="newpassword" name="newpassword" type="password" required="" placeholder="Enter New Password" class="form-control input-md">

        </div>
      </div>

      <!-- Repeat New Password input-->
      <div class="form-group">
        <div class="col-xs-12">
          <input name="passwordconfirm" type="password" id="passwordconfirm" required="" ng-required="newpassword" placeholder="Repeat New Password" class="form-control input-md" oninput="check(this)" />
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

<br> 

      <!-- Submit Button --> 
      <div class="text-center"> 

        <input id = "submit" name = "submit" type="submit" value="submit" class="btn btn-default btn-md"> <br> <br> 

      </div>

      </fieldset>
    </form> 

</div> <!-- End Row --> 

<br> 
      </div>
    </div>

  </div>
</div>