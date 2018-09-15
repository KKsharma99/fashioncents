<?php if(!defined('INCLUDE_CHECK')) header("Location: 404.php");
if (empty($_SESSION['id'])) { ?>
<div class="modal fade" id="guestprompt" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content text-center">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hey There!</h4>
      </div>
      <div class="modal-body">
        <p>Create an account to enjoy all that Fashioncents has to offer.</p>
        <span href="#" data-toggle="modal" data-target="#register-modal">
                <button class="btn join-button smooth-button"><b>JOIN</b>
                </button>
                </span>
      </div>
    </div>

  </div>
</div>
<?php } ?>
