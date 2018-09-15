<?php
//if(isset($_GET("err")) && isset($_GET("postid"))) {
?>
<script>

var $postid = -1;
var $errtype = "";

function showErrorModal(err_type, post_id) {
  $postid = post_id;
  $errtype = err_type;
  $('#errorconfirm').modal('show');
}

function hideErrorModal() {
  $('#errorconfirm').modal('hide');
}


function report() {
  //var con = confirm("If you continue, this post will be reported and necessary action will be taken. False reporting may result in the suspension or termination of your account.");
  if($errtype != "" && $postid != -1) {
    $.ajax({
      url: 'errorhandler.php',
      type: 'post',
      data: { err: errtype, postid: postid},
      success: function(data) {
        if(data){
          hideErrorModal();
        }
      }
    })  
  } else {
    return false;
  }
}

</script>
<div class="modal fade" id="errorconfirm" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content text-center">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notice</h4>
      </div>
      <div class="modal-body">
        <p> If you continue, this post will be reported and necessary action will be taken. False reporting may result in the suspension or termination of your account..</p>
      </div>
      <a href="#">
        <button type="button" class="btn btn-primary btn-md" onclick="report();">Report</button> 
      </a>
      <a href="#">
        <button type="button" class="btn btn-default btn-md" onclick="hideErrorModal();">Cancel</button> 
      </a>
      <br><br>
    </div>

  </div>
</div>

<?php //} else {
  //header("Location: 404.php");
//}?>